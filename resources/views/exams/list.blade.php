@extends('layout.layout')

@section('title', 'Assignments')

@section('container')
@if(isset($exam))
<div class="bg-white shadow">
    <div class="p-5">
        
        <h1 class="text-2xl text-gray-900 font-bold">examens</h1>
    </div>
    <nav class="flex px-5 items-center gap-3 mb-4">
        </nav>
</div>

<div class="px-7">
    <div class="inline-flex items-center gap-x-3 text-slate-800 px-3 py-2 rounded-full text-xs bg-white shadow-sm border font-medium mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"/>
        </svg>
         {{ $exam->count() }}
     </div>
   
    @forelse ($exam as $examen)
 
        <a class="block transition duration-200 hover:shadow-md ease-in-out bg-white px-4 py-4 rounded-md border mb-3" href="{{ route('exam.show',['id' =>$examen->id_mod]) }}">
            <div class="flex justify-between">
                <div>
                    <h5 class="font-bold text-sm mb-1.5">{{ $examen->names->name}}<span class="font-medium italic ml-4">({{$examen->session}})</span></h5>
                    <div class="text-xs flex items-center font-light text-gray-600 gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
              
              
                        <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                        </svg>
                        il va commencer le {{$examen->deb}}
                     </div>
                 
                </div>
               
            </div>
        </a> 
        @empty
        <div class="text-center py-5">
        {{-- <img class="w-36" src="{{ asset('assets/img/illustrations/not_found.svg') }}" alt=""> --}}
        <h1 class="text-2xl font-bold mb-2">Pas de exam</h1>
        <p class="text-gray-600 text-sm">Il n'existe aucun examen en ce moment</p>
    </div>
   @endforelse
   
</div> 
@else
<div class="bg-white shadow">
    <div class="p-5">
        
        <h1 class="text-2xl text-gray-900 font-bold">notes</h1>
    </div>
    <nav class="flex px-5 items-center gap-3 mb-4">
        </nav>
</div>

<div class="px-7">
    <div class="inline-flex items-center gap-x-3 text-slate-800 px-3 py-2 rounded-full text-xs bg-white shadow-sm border font-medium mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z"/>
        </svg>
         {{ $mod->count() }}
     </div>
   
    @forelse ($mod as $module)
 
        <div class="block transition duration-200 hover:shadow-md ease-in-out bg-white px-4 py-4 rounded-md border mb-3" >
            <div class="flex justify-between">
                <div>
                    <h5 class="font-medium text-sm mb-1.5">{{ $module->module->name }}</h5>
                    <div class="text-xs flex items-center font-light text-gray-600 gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
              
              
                        <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                        </svg>
                        vous avez obtenu la note : {{$module->note}}
                     </div>
                 
                </div>
               
            </div>
</div> 
        @empty
        <div class="text-center py-5">
        {{-- <img class="w-36" src="{{ asset('assets/img/illustrations/not_found.svg') }}" alt=""> --}}
        <h1 class="text-2xl font-bold mb-2">Pas de note</h1>
        <p class="text-gray-600 text-sm">Il n'existe aucune note en ce moment</p>
    </div>
   @endforelse
   
</div> 

@endif
@endsection