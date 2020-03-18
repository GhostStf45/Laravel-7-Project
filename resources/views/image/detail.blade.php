@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card pub_image">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar mb-2">
                    </div>
                    @endif
                    <div class="data-user  ">
                        {{$image->user->name. ' '. $image->user->surname}}                       
                        <span class="nick-name text-muted">
                            {{' | @'.$image->user->nick}}
                        </span>


                    </div>

                </div>
                <!--Detalle de la imagen-->
                @if($image->image_path)
                <div class="card-body p-0">
                    <div class="image-container w-100 image-detail">
                        <img src="{{ route('image.file', ['filename'=> $image->image_path])}}" class="w-100">                        
                    </div>

                    <div class="description ">
                        <span class="nickname">{{'@'.$image->user->nick}}</span>
                        @include('includes.date_update')
                        <p>{{$image->description}}</p>

                    </div>
                </div>

                @endif
                <!--Seccion me gusta-->
                <div class="likes-comments col-md-12  justify-content-md-start">
                    <div class="likes d-flex align-items-center ml-2 mb-3">

                        <!--Comprobar si el usuario dio like a la imagen-->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                        @if ($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif

                        @endforeach
                        @if($user_like)
                        <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                        @else
                        <img src="{{asset('img/hearts-gray.png')}}" data-id="{{$image->id}}" class="btn-like">
                        @endif
                        {{count($image->likes)}}
                        <!--Botones para las imagenes-->
                        @if(Auth::user() && Auth::user()->id == $image->user->id )
                        <div class="actions ml-3">
                            <a href="{{route('image.edit', ['id' =>$image->id])}}" class="btn btn-sm btn-primary">Actualizar</a>
                            <!--<a href="{{ route('image.delete',['id' => $image->id ] )}}" class="btn btn-sm btn-danger">Borrar</a>-->

                            <!--------------------Inicio boton modal--------------------------------------------------------------->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btm-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                                Eliminar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Borrar publicacion</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Si borras esta publicacion, se eliminará para siempre. ¿Estas seguro?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                           
                                            <a href="{{ route('image.delete',['id' => $image->id ] )}}" class="btn btn-danger">Borrar definitivamente</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!--------------------Fin boton modal--------------------------------------------------------------->
                            @endif
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <!--Seccion comentarios-->
                    <div class="comment-section  p-3">
                        <strong>Agregue un comentario:</strong>

                        <form method="post" action="{{ route('comment.save') }}" class="mb-3 mt-2">
                            @csrf

                            <input type="hidden" name="image_id" value="{{$image->id}}">

                            <div class="form-group">
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid': ''}}" name="content"></textarea>
                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif

                            </div>

                            <input type="submit" class="btn btn-md btn-primary" value="Enviar">
                        </form>
                        <!--LISTADO DE COMENTARIOS-->
                        <div class="title-comment border-bottom border-primary">
                            <h4>Comentarios ({{count($image->comments)}})</h4>
                        </div>

                        @foreach($image->comments as $comment)
                        <div class="comment  ">
                            <span class="nickname">{{'@'.$comment->user->nick}}</span>
                            <span class="nickname date">{{\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                            <p>{{$comment->content}}</p>
                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                            <a href="{{ route('comment.delete', ['id'=>$comment->id]) }}" class="btn btn-sm btn-danger">Eliminar comentario</a>
                            @endif
                        </div>

                        @endforeach

                    </div>



                </div>
            </div>




        </div>
    </div>
    @endsection