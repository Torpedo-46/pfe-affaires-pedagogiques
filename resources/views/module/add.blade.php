@extends('layout.layout')

@section('title', 'Rejoidre un cours')

@section('container')
<div class="px-10 pt-10">
    <div class="text-center mb-7">
    @if (session('success'))   
    <div class="rounded flex items-center gap-x-4 border mb-3 shadow-sm text-sm py-3 px-4 bg-green-50 text-green-600 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
        </svg>
        <div>
            {!! session('success') !!}
        </div>
    </div>
    @endif
        <h4 class="text-3xl font-bold mb-2">gestion d'un module</h4>
    </div>
    <form action="{{ route('module.store') }}" method="POST">
        @csrf
        @if (session('info'))   
        <div class="rounded flex items-center justify-between gap-x-4 border mb-3 shadow-sm text-sm py-3 px-4 bg-sky-50 text-sky-600 font-medium">
            <div class="flex items-center gap-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </svg>
                <div>
                    {!! session('info') !!}
                </div>
            </div>
            <button class="cursor-pointer text-slate-600 hover:text-slate-800" onclick="this.parentNode.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                </svg>
            </button>
        </div>
        @endif
        @if(request()->routeIs('module.add'))

        <label for="name_mod">nom du module</label>
        <input name="name_mod" class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full @error('name_mod') border border-red-600 @enderror" type="text">
        @error('name_mod')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

        <label for="ap">le nom complet du prof</label>
        <select name="id_prof" class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full @error('id_prof') border border-red-600 @enderror" id="nomComplet">
        <option value="" @if(!old('id_prof')) selected @endif></option>
        @forelse($profs as $pr)
                  <option value="{{$pr->id}}" @selected(old('id_prof'))>{{$pr->full_name}}</option>
        @empty
        <option  disabled>Aucun prof n'est enregistré</option>
    @endforelse
                    </select>
                    @error('id_prof')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

 @else


        <select name="id_mod" class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full @error('id_mod') border border-red-600 @enderror" id="id_mod">
        <option value="" disabled selected>Choisissez un module</option>
                @forelse($mods as $md)
                  <option value="{{$md->id}}" @selected(old('id_mod'))>{{$md->name}}</option>
        @empty
        <option  disabled>Aucun module n'est enregistré</option>
    @endforelse
                    </select>
                    
                    @error('id_mod')
        <p class="text-red-600">{{ $message }}</p>
        @enderror


        <label for="id_etd">l'etudiant(s) (total:{{$etds->count()}})</label>
        <input class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full" type="text" id="filterInput" oninput="filterOptions()" placeholder="filtrer par apogee">
        <select size="3" multiple name="id_etd[]" class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full @error('id_prof') border border-red-600 @enderror" id="id_etd">
        @forelse($etds as $et)
                  <option class="text-s italic  text-blue-600" value="{{$et->id}}" @selected(old('id_etd'))>{{$et->apogee}}&nbsp;&nbsp;&nbsp;&nbsp;{{$et->full_name}}</option>
        @empty
        <option  disabled>Aucun etudiant n'est enregistré</option>
    @endforelse
      </select>
                    
<script>
  function filterOptions() {
    var input = document.getElementById("filterInput");
    var filterValue = input.value.toLowerCase();
    var select = document.getElementById("id_etd");
    var options = select.options;

    for (var i = 0; i < options.length; i++) {
      var optionText = options[i].text.toLowerCase();
      options[i].style.display = optionText.startsWith(filterValue) ? "block" : "none";
    }
  }
</script>                    
                    @error('id_etd')
        <p class="text-red-600">{{ $message }}</p>
        @enderror


        
@endif

        <div class="flex justify-end">
            <button type="submit" class="rounded md:w-auto w-full px-5 py-2 text-white bg-blue-600 hover:bg-blue-800">ajouter</button>
        </div>

    </form>
</div>



@endsection