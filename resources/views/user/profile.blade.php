@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="info-user row justify-content-start align-items-center p-3">
             
                     @if($user->image)
                    <div class="container-avatar col-md-4">
                        <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar mb-2 rounded-circle">
                    </div>
                    @endif
                    <div class="user-info col-md-4">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name. ' '. $user->surname}}</h2>
                    <p> {{'Se unió: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    </div>
                   
                
            </div>
            @foreach($user->images as $image)
            <!--Tarjeta de una imagen-->
            @include('includes.image', ['image'=>$image])
            @endforeach
        </div>
    </div>
</div>
@endsection

