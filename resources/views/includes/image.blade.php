<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
        <div class="container-avatar">
            <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar mb-2">
        </div>
        @endif
        <div class="data-user  ">
            <a href="{{route('profile', ['id' => $image->user->id])}}">
                {{$image->user->name. ' '. $image->user->surname}}                       
                <span class="nick-name text-muted">
                    {{' | @'.$image->user->nick}}
                </span>
            </a>

        </div>

    </div>
    @if($image->image_path)
    <div class="card-body p-0">
        <div class="image-container w-100">
            <img src="{{ route('image.file', ['filename'=> $image->image_path])}}" class="w-100">                        
        </div>

        <div class="description mb-1 ">

            <span class="nickname">{{'@'.$image->user->nick.'|'}}</span>
            @include('includes.date_update')
            <p>{{$image->description}}</p>
        </div>
    </div>

    @endif
    <!--Likes-->
    <div class="likes-comments d-flex justify-content-md-start">
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

        </div>
        <a href="{{route('image.detail', ['id' => $image->id])}}" class="btn btn-sm btn-warning btn-coments mb-4">
            Comentarios ({{count($image->comments)}})
        </a>
    </div>
</div>