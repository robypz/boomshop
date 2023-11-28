<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{


    public function store($image)
    {
        $path = $image->store('images');

        return $path;
    }

    public function show($image)
    {
        $file= Storage::disk('images')->get($image);

        return Response($file,200);
    }



    public function destroy($id)
    {
        //
    }

    public function update($oldImage,$newImage)
    {
        Storage::disk('images')->delete($oldImage);
        return $this->store($newImage);
    }
}
