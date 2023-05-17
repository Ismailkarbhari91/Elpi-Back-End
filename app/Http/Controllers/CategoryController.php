<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function importCsv()
    {

        $csvData = file_get_contents(public_path('storage/categorycsv/sheet1.csv'));

        // Convert the CSV data to a collection
        $csvCollection = Collection::make(str_getcsv($csvData, "\n"));
        
        // Split the category and subcategory and concatenate the slugs
        $csvCollection = $csvCollection->map(function ($row) {
            $category = trim(strstr($row, '>', true));
            $subcategory = trim(strstr($row, '>'));
            $parentCategorySlug = Str::slug($category);
            $subCategorySlug = Str::slug($subcategory);
            $row = [$category, $subcategory, $parentCategorySlug . '-' . $subCategorySlug];
            return $row;
        });
        
        // Convert the modified collection back to CSV
        $outputCsvData = $csvCollection->map(function ($row) {
            return implode(',', $row);
        })->implode("\n");
        
        // Save the modified CSV data to a new file
        file_put_contents(public_path('storage/categorycsv/newfile.csv'), $outputCsvData);

     }
    }