@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="people-title"><a href="{{route('user.index')}}" >Gente</a></h1>
            <div class="search-container col-md-12 my-3 border-bottom border-gray ">
                <form method="GET" action="{{route('user.index')}}" id="form-search"  class="d-flex align-content-center mb-3 " >
                <input type="search" id="search" class="form-control col-md-8">
                <input type="submit" value="Buscar" class="btn btn-sm btn-success ml-2">
                </form>
            </div>
                
            
            
            @foreach($users as $user)
            <div class="info-user row justify-content-start align-items-center p-3">

                @if($user->image)
                <div class="container-avatar col-md-4">
                    <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar mb-2 rounded-circle">
                </div>
                @endif
                <div class="user-info col-md-4">
                    <h2>{{'@'.$user->nick}}</h2>
                    <h3>{{$user->name. ' '. $user->surname}}</h3>
                    <p> {{'Se unió: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-success">Ver perfil</a>
                </div>


            </div>
            @endforeach
            <div class="clearfix"></div>
            <!--Paginacion-->
            <div id="pagination" class="mt-3 d-flex justify-content-md-center">{{$users->links()}}</div>
        </div>
    </div>
</div>
@endsection

