@extends('layouts.app')
@section('titulo')
    Inicia sesión en Devstagram
@endsection

@section('contenido')
    <div class='md:flex md:justify-center md:gap-10 md:items-center'>
        <div class='md:w-6/12 p-5'>
            <img src="{{ asset('img/login.jpg')}}" alt="Imagen registro">
        </div>
        
        <div class='md:w-4/12 bg-white p-6 rounded-lg shadow-lg'>
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                @if (session('mensaje'))
                    <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> 
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class='mb-5'>
                    <label for='email' class='mb-2 block uppercase text-gray-500 font-bold'> Email </label>
                    <input type='email' id='email' name='email' placeholder='Tu email' class='border p-3 w-full rounded @error('email') border-red-500 @enderror' value='{{old('email')}}'>
                    @error('email')
                        <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                    @enderror
                </div>
                <div class='mb-5'>
                    <label for='password' class='mb-2 block uppercase text-gray-500 font-bold'> Password </label>
                    <input type='password' id='password' name='password' placeholder='Tu password' class='border p-3 w-full rounded @error('password') border-red-500 @enderror'>
                    @error('password')
                        <p class='mt-2 bg-red-500 text-white rounded-lg text-sm p-2 text-center'> {{$message}} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> <label for="remember" class='text-gray-500 text-sm'>Mantener mi sesion abierta</label>
                </div>
                <input type="submit" value="Inicia sesión" class='bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg'>
            </form>
        </div>
    </div>
@endsection