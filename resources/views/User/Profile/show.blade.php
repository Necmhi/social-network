<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="slot">
        <br><br>
        <div class="container-fluid gedf-wrapper">
            <div class="row gutters-sm">
                <div class="col-md-3 mb-3">
                    <div class="bg-white shadow rounded overflow-hidden">
                        <div class="px-3 pt-0 pb-3 cover">
                            <div class="media align-items-end profile-head">
                                <div class="profile mr-3"><img src="{{ $profile->profile_photo_url }}"
                                        class="img-fluid rounded shadow-sm myImg" id="myImg" alt="..."
                                        class="w-40 rounded mb-2 img-thumbnail">
                                    @if($profile->id == Auth::user()->id)
                                    <a href="{{ route('profile.show') }}" class="mt-2 btn btn-outline-secondary btn-sm btn-block">Düzenle</a> 
                                    
                                    @endif
                                </div>
                                <div class="media-body mb-5 mt-3 text-white">
                                    <h4 class="mt-0 mb-1">{{$profile->name}}
                                        </h4>
                                    <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>Bursa Teknik
                                        Üniversitesi</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light p-4 d-flex justify-content-end text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">

                                    <h5 class="font-weight-bold mb-0 d-block">
                                        {{$profile->postAndEventPhoto($profile)->count()}}</h5><small
                                        class="text-muted"> <i class="fas fa-image mr-1"></i>Fotoğraflar</small>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="font-weight-bold mb-0 d-block">
                                        {{$profile->postAndEventCounter($profile)->count()}}</h5><small
                                        class="text-muted"> <i class="fa fa-file" aria-hidden="true"></i>
                                        Gönderiler</small>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="font-weight-bold mb-0 d-block">{{$profile->friends()->count()}}</h5>
                                    <small class="text-muted"> <i class="fas fa-user mr-1"></i>Arkadaşlar</small>
                                </li>
                                <br><span style="float: right; margin-top:2px;">@if($profile->id != Auth::user()->id)                        
                                            @livewire('friendship',['profile' => $profile])
                                        @endif  </span>
                            </ul>
                            
                        </div>
                   
                        <div class="px-4 py-3">
                            <h5 class="mb-0 font-semibold">Hakkında</h5>
                            <div class="p-4 rounded shadow-sm bg-light">
                                <p class="font-italic mb-1"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    {{$profile->branch}}</p>
                                <p class="font-italic mb-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                    {{$profile->grade}}</p>
                                <p class="font-italic mb-1"><i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                    {{\Carbon\Carbon::parse($profile->birthday)->format('d.m.Y')}}</p>
                            </div>
                        </div>
                        
                        <div class="py-4 px-4">
                        @if(Auth::user()->isFriendWith($profile) || Auth::user()->id==$profile->id)
                            <div class="d-flex align-items-center justify-content-between mb-3 font-semibold">
                                <h5 class="mb-0">Fotoğraflar</h5>
                            </div>
                            <div class="row">

                                @foreach($profile->postAndEventPhoto($profile) as $photo)
                                @if($profile->postAndEventPhoto($profile)->count()%2==0)
                                <div class="col-lg-6 mb-2 pr-lg-1">
                                    <img src="{{asset('storage/' . $photo->post_photo_path)}}" alt="" id="myImg"
                                        class="img-fluid rounded shadow-sm myImg">
                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="img01">
                                        <div id="caption"></div>
                                    </div>
                                </div>
                                @else
                                <div class="col-lg-6 mb-2 pl-lg-1"><img
                                        src="{{asset('storage/' . $photo->post_photo_path)}}" alt="" id="myImg"
                                        class="img-fluid rounded shadow-sm myImg">

                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="img01">
                                        <div id="caption"></div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                        @endif
                        </div>
                    </div>
                    @if($profile->id == Auth::user()->id)
                    <div class="card rounded-xl mt-3 p-2 sp-bg">
                        @livewire('friendship',['profile' => $profile])

                        @if($profile->id == Auth::user()->id)
                            <div class="card-header sp-bg">
                                <h2 class="mt-4 text-xl leading-tight">Arkadaşların</h2>
                            </div>
                            <div class="card-body sp-bg">
                                @if(!$profile->friends()->count())
                                <p>Henüz hiç arkadaşın yok.</p>
                                @else
                                    @if($profile->friends()->count()>9)
                                        <div class="overflow-auto" style="height: 430px;width:%100">
                                    @else 
                                        <div class="overflow-auto">
                                    @endif
                                        <ul class="list-group list-group-flush">
                                            @foreach(Auth::user()->friends() as $profile)
                                            <li class="sp-bg list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                <a href="{{route('profiles.show', $profile->username)}}">
                                                    <div class="flex flex-shrink-2">
                                                        <img src="{{ $profile->profile_photo_url }}" alt="{{ $profile->name }}"
                                                            class="h-8 w-8 rounded-full object-cover img-thumbnail">
                                                        <span class="text-lg ml-3">
                                                            {{$profile->name}}
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
                @if(Auth::user()->isFriendWith($profile) || Auth::user()->id == $profile->id)
                <div class="col-md-6">
                    <!-- Eğer Arkadaşlarsa -->
                    
                    <!-- Postları Görüntüleme -->
                    @if(!$posts->count() && !$events->count())
                    <div class="col md-9">
                        <div class="text-black" style="max-width: 80rem; height:7rem; background-color:#F9FFF9; border-radius: 0.75rem;">
                        <div class="card-header"  style="text-align: center;"><i class="fa fa-files-o" aria-hidden="true"></i> BİLGİLENDİRME</div>
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title"> Profilinizde Henüz Hiç Gönderi Bulunmuyor.</h5>
                        </div>
                        </div>
                    </div>
                    @else
                    @foreach($postAndEvents as $post)
                    <div class="shadow-md rounded-xl sp-bg">
                        <div class="px-4 pt-4 sp-bg rounded-xl">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{route('profiles.show', $post->user->username)}}">
                                        <button
                                            class="mr-2 flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            <img class="h-12 w-12 rounded-circle object-cover"
                                                src="{{$post->user->profile_photo_url}}" alt="{{$post->user->username}}">&nbsp;
                                            <label class="pt-1">
                                                <p class="align-self-center text-lg">{{$post->user->name}}</p>
                                                <p class="text-muted text-xs text-left mb-2"> <i class="fa fa-clock-o"></i>
                                                    @if(\Carbon\Carbon::parse($post->created_at)->diffInMinutes()<59)
                                                        {{\Carbon\Carbon::parse($post->created_at)->diffInMinutes()}} dk önce
                                                                        
                                                    @elseif(\Carbon\Carbon::parse($post->created_at)->diffInMinutes()>60 && \Carbon\Carbon::parse($post->created_at)->diffInHours()<24)
                                                        {{\Carbon\Carbon::parse($post->created_at)->diffInHours()}} saat önce
                                                                    
                                                    @elseif(\Carbon\Carbon::parse($post->created_at)->diffInHours()>24)
                                                        {{\Carbon\Carbon::parse($post->created_at)->diffInDays()}} gün önce

                                                    @else {{$post->created_at}}
                                                    @endif
                                                </p>
                                            </label>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Mekan paylaşımı olan gönderi -->
                            @if(!$post->title)
                            @if($post->location)
                            <p class="pl-6">{{$post->user->name}} <a href="https://www.google.com/maps/place/{{$post->location}}" target="_blank" style="color:blue;">{{$post->location}}</a> mekanındaydı.
                            </p>
                            @endif

                            @if($post->location && $post->content)
                            <br><label class="pl-6" for=""><b>"{{$post->content}}"</b></label><br>
                            @endif

                            @if($post->content)
                            <br><label class="pl-6" for="">{{$post->content}}</label><br>
                            @endif

                            @if($post->post_photo_path)
                            <img class="rounded-xl img-fluid mx-auto shadow-sm myImage" src="{{ asset('storage/' . $post->post_photo_path) }}" alt=""><br>
                            @endif
                            <br><hr>
                        </div>
                        @else
                        <!-- Eğer post etkinlik ise-->

                        <label class="pl-4" for="">
                        <i class="far fa-calendar-alt"></i>
                            </label> 
                            <!--Etkinlik online ise-->
                        @if($post->online=="1")
                            <label class="pl-4 pr-2 font-semibold" for="">{{$post->title}}</label>
                            <label class="text-red-500" for="">(Online Etkinlik)</label>
                            <br><br>
                        @else
                            <label class="pl-4" for="">{{$post->title}}</label><br><br>
                        @endif

                        <label class="pl-4" for=""><i class="far fa-clock"></i></label> 
                        <label class="pl-4 pr-2 font-semibold" for="">Başlangıç Tarihi: </label> {{$post->start_date}}
                        <br><br>

                        <label class="pl-4" for=""><i class="fas fa-history"></i></label> 
                        <label class="pl-4 pr-2 font-semibold" for="">Bitiş Tarihi:</label> {{$post->end_date}}
                        <br><br>

                        <label class="pl-4" for=""> {{$post->description}}</label>
                        <br>

                        @if($post->event_photo_path)
                        <img class="rounded-xl img-fluid mx-auto shadow-sm myImage" src="{{ asset('storage/' . $post->event_photo_path) }}" alt="">
                        @endif
                        <br><hr>
                    </div>
                    @endif
                    <div class="p-2 px-4">
                        <!-- LIKE SAYISI -->
                        @if(!$post->title)
                        <span>
                            <p class="btn btn-danger">
                                {{$post->likeCounterPost($post)->count()}} Beğeni
                            </p>
                        </span>
                        @else
                        <span>
                            <p class="btn btn-danger">
                                {{$post->likeCounterEvent($post)->count()}} Beğeni
                            </p>
                        </span>
                        @endif
                    </div>

                    <span>
                        <!-- YORUMLARI GÖSTER -->
                        @if($post->comments($post))
                        <ul class="list-group list-group-flush">
                            @foreach($post->comments($post) as $action)
                                <li class="list-group-item justify-content-between align-items-center flex-wrap bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('profiles.show', $action->user->username)}}">
                                            <div class="flex items-center px-2 py-2">
                                                <div class="flex flex-shrink-2">
                                                    <img src="{{$action->user->profile_photo_url}}" alt="{{$action->user->username}}" class="h-10 w-10 rounded-full object-cover">&nbsp;
                                                    <label class="align-self-center">
                                                        <p class="h6">{{$action->user->name}}</p>
                                                        <p class="text-muted text-xs mb-2"> <i class="fa fa-clock-o"></i>
                                                            @if(\Carbon\Carbon::parse($action->created_at)->diffInMinutes()<59)
                                                                {{\Carbon\Carbon::parse($action->created_at)->diffInMinutes()}} dk önce
                                                                                
                                                            @elseif(\Carbon\Carbon::parse($action->created_at)->diffInMinutes()>60 && \Carbon\Carbon::parse($action->created_at)->diffInHours()<24)
                                                                {{\Carbon\Carbon::parse($action->created_at)->diffInHours()}} saat önce
                                                                            
                                                            @elseif(\Carbon\Carbon::parse($action->created_at)->diffInHours()>24)
                                                                {{\Carbon\Carbon::parse($action->created_at)->diffInDays()}} gün önce

                                                            @else {{$action->created_at}}
                                                            @endif
                                                        </p>
                                                    </label>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                        
                                    <div class="w-100 flex flex-grow">
                                        <span class="card border-none ml-3 py-1 px-4 sp-cm rounded-pill overflow-auto">
                                            {{$action->content}}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul><br>
                        @endif
                    </span>
                </div>
                <br><br>
                @endforeach
                @endif
            </div>

            <div class="col md-3">
                     <span class="text-success ml-12" id="spanB">DÜZENLENEN ETKİNLİKLER</span>
                @foreach($eventSort as $eventS)
                @if(\Carbon\Carbon::parse($eventS->start_date)->format('d/m/Y')>=\Carbon\Carbon::now()->format('d/m/Y'))
                <div class="card px-4 pt-4 pb-4 mx-auto mt-3 divB b" id="div">

                    <button
                        class="btn btn-outline-danger alertt">@if(\Carbon\Carbon::parse($eventS->start_date)->format('d/m/Y')==\Carbon\Carbon::now()->format('d/m/Y'))
                        {{\Carbon\Carbon::parse($eventS->start_date)->diffInDays(\Carbon\Carbon::now())}}
                        @else
                        {{\Carbon\Carbon::parse($eventS->start_date)->diffInDays(\Carbon\Carbon::now())+1}}
                        @endif GÜN KALDI</button>

                    <div class="row a ">
                        @if($eventS->event_photo_path)
                        <img src="{{ asset('storage/' . $eventS->event_photo_path) }}" alt="" class="object-cover foto pt-4"
                            id="foto">
                        @endif
                        <div class="flex items-center divB mt-2">

                            <h5 class="align-self-center font-semibold" id="baslikBes">{{$eventS->title}} </h5>
                        </div>
                    </div>
                    <p class="mt-1 mb-2 parag" id="parag">
                        {{ \Carbon\Carbon::parse($eventS->start_date)->format('d/m/Y')}} /
                        {{ \Carbon\Carbon::parse($eventS->end_date)->format('d/m/Y')}}
                        @if($eventS->online) -- Online @endif</p>

                    <h5 class="mt-2">{{$eventS->description}}</h5>
                    <p class="mt-2 mb-2 parag" id="parag">Düzenleyen</p>
                    <div class="usersFoto">
                        <a href="{{route('profiles.show', $eventS->user->username)}}">
                            <img class="h-12 w-12 rounded-circle object-cover"
                                src="{{$eventS->user->profile_photo_url}}" alt="{{$eventS->user->username}}">
                        </a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            @endif

            @if(!Auth::user()->isFriendWith($profile) && Auth::user()->id != $profile->id)
            <div class="col md-9 ml-24 mr-24 mt-32">
                <div class="text-white mb-3" style="max-width: 78rem; height:12rem; background-color:#0d5421; border-radius: 20px;">
                <div class="card-header"  style="text-align: center;"><i class="fas fa-users-slash"></i> UYARI</div>
                <div class="card-body" style="text-align: center;">
                    <h5 class="card-title"> Bu Kullanıcı İle Arkadaş Değilsiniz</h5>
                    <p class="card-text">Profili görüntülemek için <br>@livewire('friendship',['profile' => $profile])</p>
                </div>
                </div>
            </div>
            @endif
        </div>
        </div>

    </x-slot>
</x-app-layout>

<style>
    .profile-head {
        transform: translateY(3rem)
    }

    .cover {
        background-color: black;
        background-size: cover;
        background-repeat: no-repeat
    }

    img {
        transition: transform 0.25s ease;
    }

    img:hover {
        -webkit-transform: scale(0.5);
        /* or some other value */
        transform: scale(1.1);
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    .modal-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    .divB {
        max-width: 300px;
        border: none;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif
    }

    .usersFoto {
        border: none;
        margin-right: -15px;
    }

    .text-success {
        background-color: #D7FCDD;
        font-size: 16px;
        font-weight: 500;
        padding: 5px 18px;
        border-radius: 20px 0px 0px 20px;


    }

    .alertt {
        border: 2px dotted #dea4a4;
        font-size: 12px;
        font-weight: 500;
        padding: 5px 18px;
        border-radius: 20px;
        display: inline;

    }

    .parag {
        font-size: 14px;
        color: #91a2c2 !important
    }

    .btnBir {
        border-radius: 22px;
        border: none;
        height: 40px;
        width: 100%
    }


    .btn span {
        font-size: 14px;
        font-weight: 500
    }

    .btn-dark span {
        color: #E0DFE7
    }

    .btn.info {
        background: #E4E4E4
    }

    .btn.info span {
        color: #26252B !important
    }

    .btn.info:hover {
        background: #CDCED0 !important
    }

    .a {
        text-align: center;
        line-height: 3;
        display: flex;
        justify-content: center
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {

        font-family: 'Poppins', sans-serif
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementsByClassName("img-fluid rounded shadow-sm myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    for (var i = 0; i < img.length; i++) {
        var imgg = img[i];
        // and attach our click listener for this image.
        imgg.onclick = function (evt) {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
</script>