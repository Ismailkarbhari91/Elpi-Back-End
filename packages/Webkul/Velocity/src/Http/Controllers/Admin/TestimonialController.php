<?php

namespace Webkul\Velocity\Http\Controllers\Admin;

use Webkul\Velocity\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller {

    // public function index() {
    //     return redirect()->route('cmspage.admin.index');
	// }

    public function fetchAll() {
		$emps = testimonial::all();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Images</th>
                <th>Customer Name</th>
                <th>Description</th>
                <th class="sub_heading">Arabic Description</th>
				<th class="">Locale</th>
                <th class="th_action">Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="http://151.80.237.29/public/storage/public/images/' . $emp->image_url . '" class="img-thumbnail"></td>
                <td class="customer_name">' . $emp->customer_name . '</td>
                <td class="td_decription">' . $emp->description . '</td>
                <td class="td_arabic_decription">' . $emp->description_arabic . '</td>
				<td class="">' . $emp->locale . '</td>
                <td class="btnwidth">
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}


    public function store(Request $request) {

		if($request->hasfile('avatar'))
		{
		foreach($request->file('avatar') as $file)
		{

		// $file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);
		$images=$fileName;
		}
	
		$empData = ['customer_name' => $request->customer_name, 'description' => $request->description, 'description_arabic' => $request->arabic_description, 'image_url' => $images,'locale'=>$request->locale];
        testimonial::create($empData);
        return back();
        // return redirect()->route($this->_config['redirect']);

	}

	}


    public function delete(Request $request) {
		$id = $request->id;
		$emp = testimonial::find($id);
		if (Storage::delete('public/images/' . $emp->image_url)) {
			testimonial::destroy($id);
		}
        return back();
	}

    public function edit(Request $request) {
		$id = $request->id;
		$emp = testimonial::find($id);
		return response()->json($emp);
	}


    public function update(Request $request) {
		$fileName = '';
		$emp = testimonial::find($request->emp_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->image_url) {
				Storage::delete('public/images/' . $emp->images);
			}
		} else {
			$fileName = $emp->image_url;
		}	

		$empData = ['customer_name' => $request->customer_name, 'description' => $request->description, 'description_arabic' => $request->arabic_description, 'image_url' => $fileName,'locale'=>$request->locales];

		$emp->update($empData);
        return redirect()->route($this->_config['redirect']);
	}

}