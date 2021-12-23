@extends('back.layouts.master')
@section('title','Sllinen Makaleler')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0  font-weight-bold text-primary">
            @yield('title')
            <strong class="float-right">{{$articles->count()}} makale bulundu
        <a class="btn btn-primary btn-sm" href="{{route('admin.makaleler.index')}}">Aktif Makaleler</a>
    </strong>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotograf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Silinme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($articles as $article )

                    <tr>
                        <td><img src="/{{$article->image}}" width="200" alt=""></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->deleted_at->diffForHumans()}}</td>

                        <td>
                            <a href="{{route('admin.recover.article',$article->id)}}" title="Yeniden Yükle" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('admin.harddelete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

