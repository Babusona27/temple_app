<?php
namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Customers;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Core\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Kyslik\ColumnSortable\Sortable;

class CustomersController extends Controller
{
    //
    public function __construct(Customers $customers, Setting $setting)
    {
        $this->Customers = $customers;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
    }

    public function display()
    {
        $title = array('pageTitle' => Lang::get("labels.ListingCustomers"));
        $language_id = '1';

        $customers = $this->Customers->paginator();

        $result = array();
        

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['result'] = $customers;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.customers.index", $title)->with('customers', $customerData)->with('result', $result);
    }

    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddCustomer"));
        $images = new Images;
        $allimage = $images->getimages();
        $language_id = '1';
        $customerData = array();
        $message = array();
        $errorMessage = array();
        $customerData['countries'] = $this->Customers->countries();
        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.customers.add", $title)->with('customers', $customerData)->with('allimage',$allimage)->with('result', $result);
    }


    //add addcustomers data and redirect to address
    public function insert(Request $request)
    {
        $language_id = '1';
        //get function from other controller
        $images = new Images;
        $allimage = $images->getimages();

        $customerData = array();
        $message = array();
        $errorMessage = array();

        //check email already exists
        $existEmail = $this->Customers->email($request);
        $existPhone = $this->Customers->phone($request);
        $this->validate($request, [
          'user_type' => 'required',
            'customers_firstname' => 'required',
            'customers_lastname' => 'required',
           
            'customers_telephone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'isActive' => 'required',
        ]);


        if (count($existEmail)> 0 ) {
            $messages = Lang::get("labels.Email address already exist");
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }else if (count($existPhone)> 0 ) {
            $messages = "Phone number already exist.";
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        } else {
            $customers_id = $this->Customers->insert($request);
            return redirect('admin/customers/display')->with('update', 'User has been created successfully!');
        }
    }

    public function diplayaddress(Request $request){

        $title = array('pageTitle' => Lang::get("labels.AddAddress"));

        $language_id   				=   $request->language_id;
        $id            				=   $request->id;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customer_addresses = $this->Customers->addresses($id);
        $countries = $this->Customers->country();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['customer_addresses'] = $customer_addresses;
        $customerData['countries'] = $countries;
        $customerData['user_id'] = $id;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.customers.address.index",$title)->with('data', $customerData)->with('result', $result);
    }


    //add Customer address
    public function addcustomeraddress(Request $request){
      $customer_addresses = $this->Customers->addcustomeraddress($request);
      return $customer_addresses;
    }

    public function editaddress(Request $request){

      $user_id                 =   $request->user_id;
      $address_book_id         =   $request->address_book_id;

      $customer_addresses = $this->Customers->addressBook($address_book_id);
      $countries = $this->Customers->countries();;
      $zones = $this->Customers->zones($customer_addresses);
      $customers = $this->Customers->checkdefualtaddress($address_book_id);

      $customerData['user_id'] = $user_id;
      $customerData['customer_addresses'] = $customer_addresses;
      $customerData['countries'] = $countries;
      $customerData['zones'] = $zones;
      $customerData['customers'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin/customers/address/editaddress")->with('data', $customerData)->with('result', $result);
    }

    //update Customers address
    public function updateaddress(Request $request){
      $customer_addresses = $this->Customers->updateaddress($request);
      return ($customer_addresses);
    }

    public function deleteAddress(Request $request){
      $customer_addresses = $this->Customers->deleteAddresses($request);
      return redirect()->back()->withErrors([Lang::get("labels.Delete Address Text")]);
    }

    //editcustomers data and redirect to address
    public function edit(Request $request){

      $images           = new Images;
      $allimage         = $images->getimages();
      $title            = array('pageTitle' => Lang::get("labels.EditCustomer"));
      $language_id      =   '1';
      $id               =   $request->id;

      $customerData = array();
      $message = array();
      $errorMessage = array();
      $customers = $this->Customers->edit($id);

      $customerData['message'] = $message;
      $customerData['errorMessage'] = $errorMessage;
      $customerData['customers'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin.customers.edit",$title)->with('data', $customerData)->with('result', $result)->with('allimage', $allimage);
    }

    //add addcustomers data and redirect to address
    public function update(Request $request){
        $language_id  =   '1';
        $user_id				  =	$request->customers_id;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        //get function from other controller

        $existEmail = $this->Customers->editemail($request);
        $existPhone = $this->Customers->editphone($request);

        if (count($existEmail)> 0 ) {
            $messages = Lang::get("labels.Email address already exist");
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }else if (count($existPhone)> 0 ) {
            $messages = "Phone number already exist.";
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        } else {
            $user_data = array(
              'user_type' => $request->user_type,
              'first_name'    =>   $request->first_name,
              'last_name'     =>   $request->last_name,
              'phone'         =>   $request->phone,
              'email' => $request->email,
              'status'        =>   $request->status,
              'updated_at'    => date('Y-m-d H:i:s'),
            );
            DB::table('users')->where('id', '=', $user_id)->update($user_data);


            $user_data1 = array(
              'entry_street_address'  =>   $request->entry_street_address,
              'entry_postcode'    =>   $request->entry_postcode,
              'entry_city'        =>   $request->entry_city
            );
            DB::table('address_book')->where('user_id', '=', $user_id)->update($user_data1);

            if($request->changePassword == 'yes'){
                $user_data['password'] = Hash::make($request->password);
            }

            return redirect()->back()->with('update', 'User has been updated successfully!');
        }
        
    }

    public function delete(Request $request){
      $this->Customers->destroyrecord($request->users_id);
      return redirect()->back()->withErrors("User has been deleted successfully");
    }

    public function filter(Request $request){
      $filter    = $request->FilterBy;
      $parameter = $request->parameter;

      $title = array('pageTitle' => Lang::get("labels.ListingCustomers"));
      $customers  = $this->Customers->filter($request);

      $result = array();

      $customerData = array();
      $message = array();
      $errorMessage = array();

      $customerData['message'] = $message;
      $customerData['errorMessage'] = $errorMessage;
      $customerData['result'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin.customers.index",$title)->with('result', $result)->with('customers', $customerData)->with('filter',$filter)->with('parameter',$parameter);
    }
}
