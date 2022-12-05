<?php
namespace App\Http\Services;
use App\Models\Product;
class UploadService {
    function store($request){
        if ($request->hasFile('file')) {
            try {
                $file= $request->file('file');
                $ext= $request->file('file')->extension();
                $filename = time().'-'.'product.'.$ext;
                $pathFull = 'uploads/' . date("Y/m/d");

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $filename
                );
                return '/storage/' . $pathFull . '/' . $filename;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}