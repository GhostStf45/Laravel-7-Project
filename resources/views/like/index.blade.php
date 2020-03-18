@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="d-block mb-3 p-2 border-bottom">Mis imagenes favoritas</h1>
            
            @foreach($likes as $like)
               <!--Tarjeta de una imagen-->
               @include('includes.image', ['image'=>$like->image])
            @endforeach
            <div class="clearfix"></div>
            <!--Paginacion-->
            <div class="mt-3 d-flex justify-content-md-center">
                {{$likes->links()}}
            </div>
        </div>
    </div>
</div>
@endsection