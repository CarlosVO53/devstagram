<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $image = $request->file('file');

        $nombreImagen = Str::uuid() . '.' . $image->extension();

        $imagenServidor = $manager->read($image);
        $imagenServidor->cover(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagePath);


        return response()->json(['imagen' => $nombreImagen]);
    }
}
