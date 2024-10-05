<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PerfilController extends Controller
{
    public function index(User $user) {
        return view('perfil.index');
    }

    public function store(Request $request) {
        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'username' => [
                'required',
                'unique:users,username,'.$request->user()->id,
                'min:3',
                'max:20',
                'not_in:editar_perfil,something else'],
            'email' => [
                'required',
                'unique:users,email,'.$request->user()->id,
                'email'],
        ]);

        if ($request->password)
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6'
            ]);
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->current_password]))
            {
                return back()->with('mensaje', 'Credenciales incorrectas');
            }
        }

        if($request->imagen)
        {
            $manager = new ImageManager(new Driver());
            $image = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $image->extension();

            $imagenServidor = $manager->read($image);
            $imagenServidor->cover(1000, 1000);

            $imagePath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagePath);

        }

        $usuario = User::find($request->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = $request->password ?? $request->user()->password;
        $usuario->imagen = $nombreImagen ?? $request->user()->imagen ?? NULL;
        $usuario->save();

        return redirect()->route('post.index', $usuario->username);

    }
}
