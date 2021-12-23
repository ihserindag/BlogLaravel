@extends('back.layouts.master');
@section('title',$article->title.' makalesini güncelle');
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('admin.makaleler.update',$article->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach

                    </div>

                @endif

            <div class="form-group">
                <label for="">Makale Başlığı</label>

                <input type="text" name="title" value="{{$article->title}}" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="">Makale Kategori</label>
                <select name="category" class="form-control" id="" required>

                    <option value="">Seçim Yapınız</option>
                    @foreach ($categories as $category )
                    <option @if ($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}} </option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Makale Fotografı</label>
                <br>
                <img src="{{asset($article->image)}}" alt="" class="img-thumbnail rounded img-fluid" width="300">
                <input type="file" name="image" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="">Makale Fotografı</label>
                <textarea name="content" class="form-control editor" id="" rows="4">{!! $article->content!!}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Makaleyi Güncelle</button>
            </div>


        </form>
    </div>

</div>

@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
    $('.editor').summernote(
        {
            'height':300
        }

    );
});
</script>
@endsection
