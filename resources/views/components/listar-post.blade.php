{{-- <p>{{$titulo}}</p>
<p>{{$slot}}</p> --}}
<div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($posts as $post)

        <div>
            <a href=" {{route('post.show', [$post->user, $post])}} ">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen de post {{$post->titulo}}">
            </a>
        </div>            
        
    @empty
        <p class=" text-gray-600 uppercase text-sm text-center">No hay posts</p>
    @endforelse
</div>
<div class=" my-10">
    {{ $posts->links('pagination::tailwind') }}
</div>