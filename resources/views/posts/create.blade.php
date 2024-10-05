@extends('layouts.app')
@section('titulo')
    Crea una nueva publicacion
@endsection

@section('contenido')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
<div class=" md:flex md:items-center">
    <div class=" md:w-1/2 px-10">
        <form 
        id="dropzone"
        class=" dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"
        action="{{route('imagenes.store')}}"
        method="POST"
        enctype="multipart/form-data"
        >@csrf</form>
    </div>
    <div class=" md:w-1/2 bg-white rounded-lg shadow-xl p-10 mt-10 md:mt-0">
        <form action={{ route('posts.store') }} method="POST">
            @csrf
            <div class='mb-5'>
                <label for='titulo' class='mb-2 block uppercase text-gray-500 font-bold'> Titulo </label>
                <input 
                    type='text' 
                    id='titulo' 
                    name='titulo' 
                    placeholder='Titulo de la publicacion' 
                    class='border p-3 w-full rounded @error('name') border-red-500 @enderror' 
                    value='{{old('titulo')}}'>
                @error('titulo')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>
            <div class='mb-5'>
                <label for='descripcion' class='mb-2 block uppercase text-gray-500 font-bold'> Descripción </label>
                <textarea 
                    type='text' 
                    id='descripcion' 
                    name='descripcion' 
                    placeholder='descripcion de la publicacion' 
                    class='border p-3 w-full rounded @error('name') border-red-500 @enderror'>{{old('descripcion')}}</textarea>
                @error('descripcion')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>

            <div class=" mb-5">
                <input name="imagen" type="hidden" value="{{old('imagen')}}">
                @error('imagen')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>
            
            <input type="submit" value="Crear publicacion" class='bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg'>
        </form>
    </div>
</div>
    
@endsection