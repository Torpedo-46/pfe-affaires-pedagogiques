@extends('layout.layout')

@section('title', 'Assignments')

@section('container')
<div class="bg-white shadow">
    <div class="p-5">
    <a class="text-sm mb-3 font-medium flex items-center gap-2 text-blue-600 hover:text-blue-800 transition" href="{{ route('module.show') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
            Back
        </a>
        <h1 class="text-2xl text-gray-900 font-bold">Cours {{$mod->name}}</h1>
    </div>
    <nav class="flex px-5 items-center gap-3 mb-4">
        <a class="px-1 py-3 text-sm transition font-medium border-b-2 @unless(request()->category) text-blue-600 border-current @else border-transparent hover:border-current text-slate-500 @endunless" href="{{ route('group.index',['id' =>$mod->id]) }}">Attribué</a>
        <a class="px-1 py-3 text-sm transition font-medium border-b-2 @if(request()->category == 'sheduled') text-blue-600 border-current @else border-transparent hover:border-current text-slate-500 @endunless" href="{{ request()->fullUrlWithQuery(['category' => 'sheduled','id' =>$mod->id]) }}">Programmé</a>
        @if(auth()->user()->role!=0)
        <a class="py-3 px-2 text-sm font-medium border-b-2 @if(request()->category == 'membre') border-current text-blue-600 border-b-2 @else border-transparent transition text-slate-500 hover:text-slate-700 @endif" href="{{ request()->fullUrlWithQuery(['category' => 'membre','id' =>$mod->id]) }}">Membres et notes</a>
        @endif
    </nav>
</div>
<div class="md:px-10 px-1">
    @yield('content')
</div>
@endsection