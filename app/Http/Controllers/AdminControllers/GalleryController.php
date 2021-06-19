<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Core\Gallery;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Lang;

class GalleryController extends Controller
{
    //
    public function __construct(Images $images, Setting $setting, Gallery $gallery)
    {
        $this->Images = $images;
        $this->Setting = $setting;
        $this->Gallery = $gallery;

    }

    public function refresh()
    {
        $Images = new Images();
        $allimage = $Images->getimages();
        return view("admin.media.loadimages")->with('allimage', $allimage);
    }

    public function display()
    {
        $result['commonContent'] = $this->Setting->commonContent();
        $result['galleryData'] = $this->Gallery->galleryList();
        // echo "<pre>";print_r($result['galleryData']);exit;
        return view("admin.gallery.index")->with('result', $result);
    }
    // addGallery
    public function addGallery()
    {
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.gallery.add")->with('result', $result);
    }
    public function insert(Request $request)
    {
        $this->validate($request, [
            'gallery_name' => 'required',
              'gallery_dec' => 'required',
              
          ]);
        DB::table('gallery')->insert([
            ['gallery_name' => $request->gallery_name, 'gallery_dec' => $request->gallery_dec]
        ]);
        // $result['commonContent'] = $this->Setting->commonContent();
        return redirect('admin/gallery/addGallery')->with('update', 'Gallery has been created successfully!');
    }
    // editGallery
    public function editGallery(Request $request)
    {
        $result['gallery_details'] = DB::table('gallery')->where('gallery_id',$request->id)->first();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.gallery.editGallery")->with('result', $result);
    }
    // updateGallery
    public function updateGallery(Request $request)
    {
        // print_r($request->all());exit;
        $this->validate($request, [
            'gallery_name' => 'required',
            'gallery_dec' => 'required',
            'gallery_id' => 'required',
          ]);
        DB::table('gallery')->where('gallery_id','=', $request->gallery_id)->update([
            'gallery_name' => $request->gallery_name,    
            'gallery_dec' => $request->gallery_dec
        ]);
        return redirect('admin/gallery/editGallery/'.$request->gallery_id)->with('update', 'Gallery has been updated successfully!');
    }
    // deleteGallery
    public function deleteGallery(Request $request)
    {
        // gallery_id
        
        DB::table('gallery')->where('gallery_id',$request->gallery_id)->delete();
        DB::table('gallery_items')->where('gallery_id',$request->gallery_id)->delete();
        return redirect('admin/gallery/display')->with('success', 'Gallery has been deleted successfully!');
    }
    public function add(Request $request)
    {
        // echo $request->id;exit;
        $result['allimages'] = $this->Gallery->getAllimages($request->id);
        // echo "<pre>";print_r($result['allimages']);exit;
        $result['galleryId'] = $request->id;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.gallery.addimages")->with('result', $result);
    }

    
    public function uploadItemVideo(Request $request)
    {
        // echo $request->id;exit;

        DB::table('gallery_items')->insert([
            [
                'gallery_id' => $request->gallery_id, 
                'video_link' => $request->video_link
            ]
        ]);
        $result['allimages'] = $this->Gallery->getAllimages($request->id);
        return redirect('admin/gallery/add/'.$request->gallery_id)->with('success', 'Video has been added successfully!');
    }
    // deleteGalleryItem
    public function deleteGalleryItem(Request $request)
    {
        
        DB::table('gallery_items')->where('gallery_items_id',$request->gallery_item_id)->delete();
        return redirect('admin/gallery/add/'.$request->gallery_id)->with('success', 'Gallery has been deleted successfully!');
        
    }
    public function updateGalleryItemDec(Request $request)
    {
        // print_r($request->all());exit;
        DB::table('gallery_items')->where('gallery_items_id','=', $request->gallery_items_id)->update([
            'gallery_items_dec' => $request->gallery_items_dec
        ]);
        return redirect('admin/gallery/add/'.$request->gallery_id);
        
    }


    public function fileUpload(Request $request)
    {

        // Creating a new time instance, we'll use it to name our file and declare the path
        $time = Carbon::now();
        // Requesting the file from the form
        $image = $request->file('file');
        $extensions = Setting::imageType();
        if ($request->hasFile('file') and in_array($request->file->extension(), $extensions)) {

            // getting size
            $size = getimagesize($image);
            list($width, $height, $type, $attr) = $size;
            // Getting the extension of the file
            $extension = $image->getClientOriginalExtension();
            // Creating the directory, for example, if the date = 18/10/2017, the directory will be 2017/10/
            $directory = date_format($time, 'Y') . '/' . date_format($time, 'm');
            // Creating the file name: random string followed by the day, random number and the hour
            $filename = str_random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
            // This is our upload main function, storing the image in the storage that named 'public'
            $upload_success = $image->storeAs($directory, $filename, 'public');

            //store DB
            $Path = 'images/media/' . $directory . '/' . $filename;
            $Images = new Images();
            $imagedata = $Images->imagedata($filename, $Path, $width, $height);
            if(isset($request->gallery_id)){
                DB::table('gallery_items')->insert([
                    ['gallery_id' => $request->gallery_id, 'image_id' => $imagedata]
                ]);
            }
            $AllImagesSettingData = $Images->AllimagesHeightWidth();

            switch (true) {
                case ($width >= $AllImagesSettingData[5]->value || $height >= $AllImagesSettingData[4]->value):
                    $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename);
                    $mediumimage = $this->storeMedium($Path, $filename, $directory, $filename);
                    $largeimage = $this->storeLarge($Path, $filename, $directory, $filename);
                    break;
                case ($width >= $AllImagesSettingData[3]->value || $height >= $AllImagesSettingData[2]->value):
                    $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename);
                    $mediumimage = $this->storeMedium($Path, $filename, $directory, $filename);
                    //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                    break;
                case ($width >= $AllImagesSettingData[0]->value || $height >= $AllImagesSettingData[1]->value):
                    $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename);
                    //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                    //                $storeMediumImage = $Images->Mediumrecord($filename,$Path,$width,$height);

                    break;
                    //            default:
                    //                $tuhmbnail = $this->storeThumbnial($Path,$filename,$directory,$filename);
                    //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                    //                $storeMediumImage = $Images->Mediumrecord($filename,$Path,$width,$height);
            }

        } else {
            return "Invalid Image";
        }

    }

    public function storeThumbnial($Path, $filename, $directory, $input)
    {
        $Images = new Images();
        $thumbnail_values = $Images->thumbnailHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $thumbnail_values[1]->value,

            'height' => $thumbnail_values[0]->value,

            'grayscale' => false));
        $namethumbnail = $thumbnailImage->save($destinationPath . 'thumbnail' . time() . $filename);

        $Path = 'images/media/' . $directory . '/' . 'thumbnail' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;
        $Images = new Images();
        $storethumbnail = $Images->thumbnailrecord($input, $Path, $width, $height);

        return $namethumbnail;
    }

    public function storeMedium($Path, $filename, $directory, $input)
    {
        $Images = new Images();
        $Medium_values = $Images->MediumHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Medium_values[1]->value,

            'height' => $Medium_values[0]->value,

            'grayscale' => false));
        $namemedium = $thumbnailImage->save($destinationPath . 'medium' . time() . $filename);
        $Path = 'images/media/' . $directory . '/' . 'medium' . time() . $filename;

        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $storeMediumImage = $Images->Mediumrecord($input, $Path, $width, $height);

        return $namemedium;
    }

    public function storeLarge($Path, $filename, $directory, $input)
    {
        $Images = new Images();
        $Large_values = $Images->LargeHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Large_values[1]->value,

            'height' => $Large_values[0]->value,

            'grayscale' => false));
//        $upload_success = $thumbnailImage->save($directory, $filename, 'public');
        $namelarge = $thumbnailImage->save($destinationPath . 'large' . time() . $filename);

        $Path = 'images/media/' . $directory . '/' . 'large' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $storeLargeImage = $Images->Largerecord($input, $Path, $width, $height);

        return $namelarge;
    }

    public function deleteimage(Request $request)
    {
        $images = explode(",", $request->images);
        foreach ($images as $image) {
            $Images = new Images();
            $imagedelete = $Images->imagedelete($image);
        }
        return 'success';

    }
}
