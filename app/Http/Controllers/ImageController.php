<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validar la imagen
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,bmp|max:2048',
            ]);

            // Generar un nombre único para la imagen
            $imageName = Str::uuid() . '-' . $request->file->extension();

            // Procesar la imagen
            $serverImage = Image::make($request->file);
            $serverImage->fit(1000, 1000);
            $pathImage = public_path('uploads') . '/' . $imageName;
            $serverImage->save($pathImage);

            // Devolver una respuesta JSON con el nombre de la imagen
            return response()->json(['image' => $imageName]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
