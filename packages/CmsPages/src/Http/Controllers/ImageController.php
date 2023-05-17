<?php

namespace CmsPages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CmsPages\Models\Image;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasfile('image'))
		{
		foreach($request->file('image') as $file)
		{

		// $file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);
		$images=$fileName;
		}
	
		$empData = ['images' => $images];
		Image::create($empData);
        return redirect()->route('cmspage.admin.index');
	}
    }
}
