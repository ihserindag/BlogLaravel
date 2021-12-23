@extends('back.layouts.master');
@section('title','Makale Ekle');
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('admin.makaleler.store')}}" enctype="multipart/form-data">
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
                <input type="text" name="title" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="">Makale Kategori</label>
                <select name="category" class="form-control" id="" required>
                    <option value="">Seçim Yapınız</option>
                    @foreach ($categories as $category )
                    <option value="{{$category->id}}">{{$category->name}} </option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Makale Fotografı</label>
                <input type="file" name="image" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="">Makale Metni</label>
                <textarea name="content" class="form-control editor" id="" rows="4"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Makaleyi Oluştur</button>
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
