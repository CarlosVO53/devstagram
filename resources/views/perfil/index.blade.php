@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
<div class=" md:flex md:justify-center">
    <div class=" md:w-1/2 bg-white shadow p-6">
        @if (session('mensaje'))
        <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> 
            {{session('mensaje')}}
        </p>
    @endif
        <form action="{{route('perfil.store')}}" enctype="multipart/form-data" method="post" class=" mt-10 md:mt-0">
            @csrf
            <div class='mb-5'>
                <label for='username' class='mb-2 block uppercase text-gray-500 font-bold'> Username </label>
                <input 
                    type='text' 
                    id='username' 
                    name='username' 
                    placeholder='Tu username' 
                    class='border p-3 w-full rounded @error('username') border-red-500 @enderror' 
                    value='{{auth()->user()->username}}'>
                @error('username')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>
            <div class='mb-5'>
                <label for='email' class='mb-2 block uppercase text-gray-500 font-bold'> Email </label>
                <input 
                    type='text' 
                    id='email' 
                    name='email' 
                    placeholder='Tu email' 
                    class='border p-3 w-full rounded @error('email') border-red-500 @enderror' 
                    value='{{auth()->user()->email}}'>
                @error('email')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>
            <div class='mb-5'>
                <label for='current_password' class='mb-2 block uppercase text-gray-500 font-bold'> Password actual </label>
                <input type='password' id='current_password' name='current_password' placeholder='Tu current_password' class='border p-3 w-full rounded @error('current_password') border-red-500 @enderror'>
                @error('current_password')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>
            <div class='mb-5'>
                <label for='password' class='mb-2 block uppercase text-gray-500 font-bold'> Nueva Password </label>
                <input type='password' id='password' name='password' placeholder='Tu password' class='border p-3 w-full rounded @error('password') border-red-500 @enderror'>
                @error('password')
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                @enderror
            </div>
            <div class='mb-5'>
                <label for='password_confirmation' class='mb-2 block uppercase text-gray-500 font-bold'> Repite tu nueva password</label>
                <input type='password' id='password_confirmation' name='password_confirmation' placeholder='Tu password' class='border p-3 w-full rounded'>
            </div>

            <div class='mb-5'>
                <label for='imagen' class='mb-2 block uppercase text-gray-500 font-bold'> Imagen perfil </label>
                <input 
                    type='file' 
                    id='imagen' 
                    name='imagen' 
                    class='border p-3 w-full rounded' 
                    accept=".jpg, .jpeg, .png">
            </div>
            <input type="submit" value="Guardar" class='bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg'>

        </form>
    </div>

</div>
@endsection
