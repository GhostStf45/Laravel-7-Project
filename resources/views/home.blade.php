@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach($images as $image)
            <!--Tarjeta de una imagen-->
                @include('includes.image', ['image'=>$image])
            @endforeach
            <div class="clearfix"></div>
            <!--Paginacion-->
            <div id="pagination" class="mt-3 d-flex justify-content-md-center">{{$images->links()}}</div>
        </div>
    </div>
</div>
    @endsection

