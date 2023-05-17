<?php

namespace CmsPages\Http\Controllers;

use CmsPages\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller {

    public function index() {
        return redirect()->route('cmspage.admin.index');
	}

    public function fetchAll() {
		$emps = About::all();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Section</th>
                <th>Heading</th>
                <th class="sub_heading">Content</th>
                <th class="locale">Locale</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->section . '</td>
                <td>' . $emp->heading . '</td>
                <td>' . $emp->content . '</td>
				<td>' . $emp->locale . '</td>

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

		if($request->hasfile('avatars'))
		{
		foreach($request->file('avatars') as $file)
		{

		// $file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);
		$images=$fileName;
		}
	
		// $empData = ['section' => $request->section, 'heading' => $request->heading, 'sub_heading' => $request->sub_heading, 'content' => $request->content,  'images' => $images];

	}

	$empData = ['section' => $request->section, 'heading' => $request->heading, 'content' => $request->content,'locale'=>$request->locale];

		About::create($empData);
        return back();
	}


    public function delete(Request $request) {
		$id = $request->id;
		$emp = About::find($id);
		// if (Storage::delete('public/images/' . $emp->images)) {
			About::destroy($id);
		// }
        return back();
	}

    public function edit(Request $request) {
		$id = $request->id;
		$emp = About::find($id);
		return response()->json($emp);
	}


    public function update(Request $request) {
		$fileName = '';
		$emp = About::find($request->emp_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->images) {
				Storage::delete('public/images/' . $emp->images);
			}
		} else {
			$fileName = $emp->images;
		}	

		$empData = ['section' => $request->section, 'heading' => $request->heading, 'sub_heading' => $request->sub_heading, 'content' => $request->content, 'images' => $fileName,'locale'=>$request->locales];

		$emp->update($empData);
        return back();
	}

}