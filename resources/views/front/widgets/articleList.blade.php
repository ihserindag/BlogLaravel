@if(count($articles)>0)

    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                <h2 class="post-title">
                    {{$article->title}}
                </h2>
                <img class="img-fluid" src="{{$article->image}}" alt="">
                <h3 class="post-subtitle">
                    {!!Str::limit($article->content,50,'...')!!}
                </h3>
            </a>
            <p class="post-meta">Kategori :
                <a href="#">{{$article->getCategory->name}}</a>
                <span class="float-right"> Oluşturma Tarihi : {{$article->created_at->diffForHumans()}}</span></p>
        </div>
        @if (!$loop->last)
            <hr>

        @endif

    @endforeach
    <div class="mr-auto ml-auto">
        {{$articles->links()}}

    </div>
@else
    <div class="alert alert-danger"> Bu Kategoriye ait yazı bulunamadı.</div>
@endif
