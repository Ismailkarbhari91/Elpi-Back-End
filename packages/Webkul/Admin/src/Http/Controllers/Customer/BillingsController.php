<?php

namespace Webkul\Admin\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Webkul\Customer\Rules\VatIdRule;
use Webkul\Admin\DataGrids\AddressDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Customer\Repositories\CustomerAddressRepository;
use DB;
use App\Billing;

class BillingsController extends Controller
{

    protected $_config;

    // protected $contactdata;

   

    public function __construct(
        protected CustomerRepository $customerRepository,
        protected CustomerAddressRepository $customerAddressRepository
    )
    {
        $this->_config = request('_config');
    }


    public function show($id)
    {
        $customer = $this->customerRepository->find($id);
        $customerId = request()->segment(3);

        $user = Billing::where('customer_id', $customerId)->first();


        return view($this->_config['view'], compact('customer','customerId','user'));
    }


    public function index()
    {
        $contactdata  = $this->contactDataRepository->all();
        return view($this->_config['view'],[
            'data' => $contactdata
        ]);
    }


    public function view($id)
    {

        $contact = $this->contact->findOrFail($id);

        return view($this->_config['view'], compact('contact'));
    }

    public function store(Request $request, $id)
    {

        $fname=$request->first_name;
        $lname=$request->last_name;
        $company_name=$request->company_name;
        $country=$request->country;
        $address1=$request->address1;
        $address2=$request->address2;
        $city=$request->city;
        $state=$request->state;
        $zipcode=$request->zipcode;
        $email=$request->email;
        $phone=$request->phone;
        $customer_id=$request->customer_id;
        $customerId = request()->segment(3);
        // $customer = $this->customerRepository->find($id);
        // $user = Billing::where('customer_id', $customerId)->first();
        DB::table('billing')
            ->where('customer_id', $customer_id )
            ->update(['first_name' =>$fname,'last_name'=>$lname,'company_name'=>$company_name,'country'=>$country,'address1'=>$address1,'address2'=>$address2,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'email'=>$email,'phone'=>$phone,'customer_id'=>$customer_id]);

            // return view($this->_config['view'], compact('customer','user','customerId'));
            return redirect()->route($this->_config['redirect']);

    }


    public function destroy($id=null)
    {
        
        $contact = $this->contact->findorFail($id);

        try {
            $this->contact->delete($id);

            session()->flash('success', trans('contact_lang::app.response.delete-success', ['name' => 'Message']));

        } catch(\Exception $e) {
            session()->flash('error', trans('contact_lang::app.response.delete-failed', ['name' => 'Message']));
        }


        return response()->json(['message' => false], 400);
    
    }




    // Shop Section
    public function sendMessage()
    {
        $this->validate(request(), [
            'name'              => 'required',
            'email'             => 'required',
            'message_body'      => 'required'
        ]);

        $data = request()->all();

        

        try {
            $contact = $this->contact->create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'message_body'  => $data['message_body']
            ]);

            if ($contact) {
                session()->flash('success', trans('contact_lang::app.response.message-send-success'));
                return redirect()->route($this->_config['redirect']);
            }
        }catch (\Exception $e) {

        }

            
    }

    


}
