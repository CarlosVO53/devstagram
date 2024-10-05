<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(User $user)
    {
        // Dos formas de obtener los registros
        // $posts = Post::where('user_id', $user->id)->paginate(8);
        $posts = $user->posts()->latest()->paginate(8);
        return view('dashboard', [
            'user'  => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'        => 'required|max:255',
            'descripcion'   => 'required',
            'imagen'        => 'required'
        ]);


        // Una forma de guardar datos
        // Post::create([
        //     'titulo'        => $request->titulo,
        //     'descripcion'   => $request->descripcion,
        //     'imagen'        => $request->imagen,
        //     'user_id'       => $request->user()->id;
        // ]);

        // Otra forma
        // $post = new Post;
        // $post->titulo       = $request->titulo;
        // $post->descripcion  = $request->descripcion;
        // $post->imagen       = $request->imagen;
        // $post->user_id      = $request->user()->id;
        // $post->save();

        // Otra forma Haciendo referencia a las relaciones de los modelos
        $request->user()->posts()->create([
             'titulo'        => $request->titulo,
             'descripcion'   => $request->descripcion,
             'imagen'        => $request->imagen,
             'user_id'       => $request->user()->id,
         ]);

        return redirect()->route('post.index', $request->user()->username);
    }

    public function show(User $user, Post $post) {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }
    
    public function destroy(Post $post, Request $request)
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }

        $post->delete();

        //Eliminar la imagen del servidor
        $image_path = public_path('uploads/' . $post->imagen);

        if (File::exists($image_path)) {
            unlink($image_path);
            // o
            // File::delete($image_path);
        }

        return redirect()->route('post.index', $request->user()->username)->with('mensaje', 'Se ha eliminado el post: '.$post->titulo);
    }
}
