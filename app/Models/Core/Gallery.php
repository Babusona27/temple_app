<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;
// use Image;

class Gallery extends Model
{
    //
use Sortable;
public $sortable =['id','name'];

// eventList

public function galleryList(){

    $galleryList = DB::table('gallery')
    ->leftJoin('gallery_items', 'gallery.gallery_id', '=', 'gallery_items.gallery_id')
    ->leftJoin('images', 'gallery_items.image_id', '=', 'images.id')
    ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
    ->select('gallery.gallery_id','gallery.gallery_dec','gallery.gallery_name','image_categories.path','gallery_items.image_id')
    ->groupBy('gallery.gallery_id')
    ->get();

    return $galleryList;
}

// getAllimages

public function getAllimages($gallery_id){

    $allimages = DB::table('gallery_items')
            ->leftJoin('images', 'gallery_items.image_id', '=', 'images.id')
            ->leftJoin('image_categories', function($join)
            {
                $join->on('image_categories.image_id', '=', 'images.id')
                ->where('image_categories.image_type', '=', 'THUMBNAIL');
            })
            ->select('path','images.id','image_type','gallery_items.gallery_items_id','gallery_items.video_link','gallery_items.gallery_items_dec')
            ->where('gallery_items.gallery_id',$gallery_id)
            ->orderby('images.id','DESC')
            ->get();
   

    return $allimages;
}
    
}
