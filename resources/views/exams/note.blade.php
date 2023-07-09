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
        <h4 class="text-3xl font-bold mb-2">Gestion des notes ({{$nom_mod}})</h4>
    </div>
    <form action="{{ route('module.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_mod" value="{{ $id_mod }}">

        <label for="id_etd">les etudiants ({{$etds->count()}})</label>
        <input class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full" type="text" id="filterInput" oninput="filterOptions()" placeholder="filtrage par apogee">
        <select size="3" multiple name="id_etd[]" class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full @error('id_prof') border border-red-600 @enderror" id="id_etd">
        @forelse($etds as $et)
                  <option class="text-s italic  text-blue-600" value="{{$et->user->id}}" @selected(old('id_etd'))> {{$et->user->apogee}}&nbsp;&nbsp;&nbsp;{{$et->user->full_name}}&nbsp;&nbsp;&nbsp;{{$et->note}}</option>
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
        <label for="note">la note</label>
        <input name="note" class="rounded outline-none text-xl mb-2 py-2 px-3 bg-white focus:bg-white border focus:ring-2 ring-blue-500 block w-full @error('note') border border-red-600 @enderror" type="number" step="0.01" min="0">
        @error('note')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

        

        <div class="flex justify-end">
            <button type="submit" class="rounded md:w-auto w-full px-5 py-2 text-white bg-blue-600 hover:bg-blue-800">ajouter</button>
        </div>

    </form>
</div>



@endsection