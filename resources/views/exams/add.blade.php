@extends('layout.layout')

@section('title', 'Login')

@section('container')

<div class="grid md:grid-cols-2 grid-cols-1 min-h-screen ">
    <div class=" h-full bg-white md:flex items-center flex-col gap-3 justify-center">
    <img class="h-24 mb-4" src="{{ asset('assets/img/fstbm.png') }}" alt="Faculté des Sciences et Techniques - Beni Mellal">
    <h2 class="text-3xl font-bold ml-12 ">plagnifier un examen pour le module de <span class="text-blue-500">{{$nom_mod}}</span> enseigné par: <br><span class="text-blue-500">Pr.{{$nom_prof}}</span></h2>
   
       
            @error('deb_date')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
           </div>
    <div class="h-full flex bg-white items-center justify-center">
        <div class="md:w-12/12 px-5 py-5 md:py-0">
        <br>
            <form action="{{ route('exam.store') }}" method="post">
                @csrf
                <input type="hidden" name="id_mod" value="{{ $id_mod }}">

                <div class="grid grid-cols-2 gap-x-4">
                    <div class="form-exam mb-3">
                        <label for="deb">date_debut</label>
                        <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('deb') border-red-600 @enderror" type="datetime-local" name="deb" value="{{ old('deb') }}" id="deb">
                        @error('deb')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-exam mb-3">
                        <label for="duree">duree</label>
                        <input class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('duree') border-red-600 @enderror" type="time" name="duree" value="{{ old('duree') }}" id="duree">
                        @error('duree')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>    
                </div>
                <div class="form-exam mb-3">
                        <label for="s">Surveillant</label>
                        <select class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('s') border-red-600 @enderror"  name="s" id="s">
                        <option value="" @if(!old('s')) selected @endif></option>
                        @forelse($users as $u)
                                <option value="{{$u->id}}" @selected(old('s'))>{{$u->full_name}}</option>
                        @empty
                        <option  disabled>Aucun prof n'est enregistré</option>
                        @endforelse
                       </select>
                        @error('s')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>    
               
                <div class="form-exam mb-5">
                    <label for="session">session</label>
                    <select class="rounded focus:ring ring-blue-600 transition block w-full border outline-none py-2 px-2.5 @error('session') border-red-600 @enderror" name="session" id="session">
                    <option value="0">ordinaire </option>
                        <option value="1">rattrapage</option>
                    </select>
                    @error('session')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-800 py-2.5 text-sm font-bold rounded w-full transition text-white px-6">plagnifier l'examen</button>
            </form>
        </div>
    </div>
</div>

 
      
@endsection














