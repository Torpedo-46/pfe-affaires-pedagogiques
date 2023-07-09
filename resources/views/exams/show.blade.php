@extends('layout.layout')

@section('title', 'Login')

@section('container')
<div class="bg-white shadow px-10 mb-5">
    <div class="py-5">
        <a class="text-sm mb-3 font-medium flex items-center gap-2 text-blue-600 hover:text-blue-800 transition" href="{{request()->routeIs('exam.show') ? route('exam.show'):route('module.show')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
            Back
        </a>
       <div class="md:flex md:justify-between md:items-start">
             <div>
               <h1 class="text-lg mb-2 text-center text-blue-600 font-bold">Session {{$exam->session}}</h1>        
                <p class="text-zinc-500 font-light text-sm mb-2 italic">examen planifié </p>        
            </div> 
          @if (auth()->user()->role==2)  
            <div class="flex items-center gap-x-1 mt-3 md:mt-0">
                <a class="rounded-full py-2 px-3 transition bg-red-600 justify-center border flex items-center gap-x-2 text-white hover:bg-red-700 text-xs font-bold" href="{{route('exam.delete',['id_mod'=>$exam->id_mod])}}">Supprimer</a>
            </div>
            @endif 
        </div>
    </div>
    <nav class="flex items-center justify-center md:justify-start gap-x-2">
    @if (session('success'))    
            <div class="rounded flex items-center gap-x-4 border mb-3 shadow-sm text-sm py-3.5 px-4 bg-green-50 text-green-600 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif
    </nav>
</div>

<div class="grid gap-x-6 md:grid-cols-11 grid-cols-1">
    <div class="md:col-span-7 ">
           
            <div class="rounded-lg border mb-5 bg-white-50 text-blue-600 font-medium">
                <h6 class="text-sm pt-4 pb-3 px-5 font-bold flex justify-center items-center">examen  {{ $nom_mod }}</h6>
            </div>
           
            <div class="bg-white-50 font-medium rounded-lg py-6 px-5 border mb-5 text-center">
                <h6 class="font-bold mb-1 text-lg text-blue-600">l'examen est le {{ $exam->deb}} </h6>
                <p class="text-sm italic">pour une duree de {{$exam->duree}}</p>
            </div>
    </div>
    @if (auth()->user()->role!=1)  
    <div class="md:col-span-4">
        <div class="p-4 px-5 rounded-lg border mb-5 bg-white-50  font-medium">
            <h5 class="mb-1 font-bold text-sm text-blue-600">realisé par:</h5>
            <p class=" text-md italic">Pr.{{$nom_prof}} </p>
        </div>
    
    @endif
    @if (auth()->user()->role==2)  
        <div class="p-4 px-5 rounded-lg border mb-5 bg-white-50  font-medium">
            <h5 class="mb-1 font-bold text-sm text-blue-600">surveillé par:</h5>
            <p class=" text-md italic">Pr.{{$exam->name->full_name}} </p>
        </div>
         @endif
    </div>
   
</div>
</div>
</div>
@endsection