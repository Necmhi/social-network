<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <a href="{{ route('members.index') }}">
                            {{ __('Üyeler') }}
                        </a>
                    </h2>
                </div>
                <div class="col md-6">
                
                </div>


                <div class="col-md-2">
                    <a href="#">
                        <label value="">Arkadaşlarını Ziyaret Et</label>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>
    @foreach($users as $user)
        <div class="sm:flex sm:flex-wrap" style="margin-left:10%">
            <a href="{{route('profiles.show', $user->username)}}">
                <div
                    class="flex items-center bg-gray-50 px-2 py-3 border-1 border-gray-500 mt-5 hover:bg-gray-400 hover:text-blue:800">
                    <div class="flex flex-shrink-0">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            class="h-8 w-8 rounde-full object-cover">
                    </div>
                    <div class="flex flex-grow overflow-hidden">
                        <span class="text-lg ml-3">
                            {{$user->name}}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
</x-app-layout>

