@extends('group.show')

@section('title', $group->title)

@section('content')
<div class="grid gap-x-6 md:grid-cols-11 grid-cols-1">
    <div class="md:col-span-7">
        @if (now()->addHour()->gte($group->start_at))   
           
            <div class="bg-white rounded-lg border mb-5">
                <h6 class="text-sm pt-4 pb-3 px-5 font-bold">Reference materials</h6>
                @forelse ($group->files as $file)
                <a class="flex px-5 py-2.5 gap-x-4 border-b last:border-0 items-center hover:bg-slate-50 transition" href="{{ route('group.attachment.download', ['id' => $group->id, 'attachment' => $file->id]) }}" target="_blank">
                    <img class="w-5 h-5" src="{{ asset('assets/img/extensions/' . $file->extension . '.png') }}" alt="">
                    <div>
                        <h6 class="truncate text-xs font-medium">{{ $file->file_name }}</h6>
                        <p class="text-gray-600 text-xs">{{ 'PDF document' }}</p>
                    </div>
                </a>
                @empty
                <p class="text-sm text-center text-gray-600 px-5 py-2.5">Aucune référence a été ajouté</p>
                @endforelse
            </div>
            @if (session('success'))    
            <div class="rounded flex items-center gap-x-4 border mb-3 shadow-sm text-sm py-3.5 px-4 bg-green-50 text-green-600 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif
        @else
            <div class="bg-white rounded-lg py-6 px-5 border mb-5 text-center">
                <h6 class="font-bold mb-1 text-lg">Pas encore envoyé</h6>
                <p class="text-sm text-gray-600">Le cours sera envoyé le {{ $group->start_at->format('d M Y H:i') }}</p>
            </div>
        @endif
    </div>
    <!--<div class="md:col-span-4">
        @if (auth()->id() == $group->user_id)
           <div class="bg-white p-4 px-5 rounded-lg border mb-5">
          <h5 class="mb-1 font-bold text-sm">Code d'cours</h5>
            <p class="text-blue-600 text-md">{{ $group->code }}</p>
        </div> 
        @endif-->
    </div>
</div>
@endsection