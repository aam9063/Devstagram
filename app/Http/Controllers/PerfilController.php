<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
{
    // Modificar el Request
    $request->request->add(['username' => Str::slug($request->username)]);

    // Validar el Request
    $this->validate($request, [
        'username' => ['required', 'unique:users,username,' . Auth::user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        // Validar la imagen
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,bmp|max:2048',
        ]);

        // Generar un nombre único para la imagen
        $imageName = Str::uuid() . '.' . $request->file('image')->extension();

        // Procesar la imagen
        $serverImage = Image::make($request->file('image'));
        $serverImage->fit(1000, 1000);
        $pathImage = public_path('perfiles') . '/' . $imageName;
        $serverImage->save($pathImage);

        // Eliminar la imagen anterior si existe
        $usuario = Auth::user();
        if ($usuario->image) {
            $oldImagePath = public_path('perfiles') . '/' . $usuario->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }
    }

    // Guardar cambios
    $usuario = User::find(Auth::user()->id);
    $usuario->username = $request->username;
    if ($imageName) {
        $usuario->image = $imageName ?? Auth::user()->image ?? null;
    }
    $usuario->save();

    // Redireccionar al usuario
    return redirect()->route('posts.index', $usuario->username);
}
}
