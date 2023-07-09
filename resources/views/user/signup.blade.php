@extends('layout.layout')

@section('title', 'Login')

@section('container')
<div class="grid md:grid-cols-2 grid-cols-1 min-h-screen">
    
    <div class="hidden h-full bg-white md:flex items-center flex-col gap-3 justify-center">
    <img class="h-24 mb-4" src="{{ asset('assets/img/fstbm.png') }}" alt="Faculté des Sciences et Techniques - Beni Mellal">
        <h2 class="text-3xl font-bold">Créer un compte sur la platforme</h2>
        @if (session('success'))    
            <div class="rounded flex items-center gap-x-4 border mb-3 shadow-sm text-sm py-3.5 px-4 bg-green-50 text-green-600 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif
    </div>
    <div class="h-full flex bg-white items-center justify-center">
        <div class="md:w-12/12 px-5 py-5 md:py-0">
          
            <form action="{{ route('user.create') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                        <label for="ap">Apogee</label>
                        <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('ap') border-red-600 @enderror" type="text" name="ap" value="{{ old('ap') }}" id="ap">
                        @error('ap')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>  
                <div class="grid grid-cols-2 gap-x-4">
                    <div class="form-group mb-3">
                        <label for="first_name">Prénom</label>
                        <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('first_name') border-red-600 @enderror" type="text" name="first_name" value="{{ old('first_name') }}" id="first_name">
                        @error('first_name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="last_name">Nom</label>
                        <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('last_name') border-red-600 @enderror" type="text" name="last_name" value="{{ old('last_name') }}" id="last_name">
                        @error('last_name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>    
                </div>
                <div class="form-group mb-3">
                    <label for="email">Adresse email</label>
                    <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('email') border-red-600 @enderror" type="email" name="email" value="{{ old('email') }}" id="email">
                    @error('email')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password">Mot de passe</label>
                    <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('password') border-red-600 @enderror" type="password" name="password" id="password">
                    @error('password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password">Confirmation de mot de passe</label>
                    <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>           
                <div class="form-group mb-5">
                    <label for="role">le role</label>
                    <select class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('role') border-red-600 @enderror" name="role" id="role">
                        <option value="0" @selected(!old('role'))>Etudiant</option>
                        <option value="1" @selected(old('role'))>Professeur</option>
                        <option value="2" @selected(old('role'))>administrateur</option>

                    </select>
                    @error('role')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-800 py-2.5 text-sm font-bold rounded w-full transition text-white px-6">Crée un compte</button>
            </form>
        </div>
    </div>
</div>
@endsection














