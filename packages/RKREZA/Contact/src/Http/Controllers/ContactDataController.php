<?php

namespace RKREZA\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use RKREZA\Contact\Repositories\ContactDataRepository;
use RKREZA\Contact\Repositories\ContactusdatafrechRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ContactDataController extends Controller
{

    protected $_config;

    protected $contactdata;

    protected $contactdatafrech;
   

    public function __construct(
        protected ContactDataRepository $contactDataRepository,
        protected ContactusdatafrechRepository $contactusdatafrechRepository
        )
    {
        
        // $this->contactdata              = $contactdata;
        $this->_config              = request('_config');
    }


    public function show()
    {
        return view($this->_config['view']);
    }


    public function index()
    {

        

        $contactdatafrench  = $this->contactusdatafrechRepository->all();
        $contactdata  = $this->contactDataRepository->all();
        return view($this->_config['view'],[
            'data' => $contactdata,'datas'=>$contactdatafrench
        ]);
    }


    public function view($id)
    {

        $contact = $this->contact->findOrFail($id);

        return view($this->_config['view'], compact('contact'));
    }

    public function store($id)
    {


        // 


        // 

        // $contactdata = $this->contactdata->findOrFail($id);

        $velocityMetaData = $this->contactDataRepository->findOneWhere([
            'id' => $id,
        ]);

        $params = request()->all();
        // $params['contact_us_heading'] = $params['contact_us_heading']; 

        // 


        if(request()->hasFile('map')) {
            $images = [];
    
            foreach(request()->file('map') as $file) {
                $fileName = time() . '.' . $file->getClientOriginalExtension();
		        $file->storeAs('public/images', $fileName);
		        $images=$fileName;
            }
    
            $params['image_url'] = $images;
        }

        // 

        $this->contactDataRepository->update($params,$id);

        $this->contactusdatafrechRepository->update($params,$id);

        session()->flash('success', trans('Data Updated Successfully'));

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
