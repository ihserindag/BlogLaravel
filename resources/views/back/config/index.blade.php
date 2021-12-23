@extends('back.layouts.master')
@section('title','Ayarlar')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0  font-weight-bold text-primary">
            @yield('title')
        </h6>
    </div>
    <div class="card-body">


        <form action="{{route('admin.config.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Başlığı</label>
                        <input type="text" name="title" required value="{{$config->title}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Aktiflik Durumu</label>
                       <select name="active" class="form-control" id="">
                         <option @if($config->active==1) selected @endif value="1">Açık</option>
                         <option @if($config->active==0) selected @endif value="0">Kapalı</option>
                       </select>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Logo</label>
                        <input type="file" name="logo"   class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Favicon</label>
                        <input type="file" name="favicon"   class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" name="facebook" required value="{{$config->facebook}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Twitter</label>
                        <input type="text" name="twitter" required value="{{$config->twitter}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Github</label>
                        <input type="text" name="github" required value="{{$config->github}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">LinkIn</label>
                        <input type="text" name="linkedin" required value="{{$config->linkedin}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Youtube</label>
                        <input type="text" name="youtube" required value="{{$config->youtube}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Instagram</label>
                        <input type="text" name="instagram" required value="{{$config->instagram}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

