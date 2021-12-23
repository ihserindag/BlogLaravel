@section('title','iletişim sayfası')
@section('bg', 'https://images.unsplash.com/photo-1499159058454-75067059248a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80')
@extends('front.layouts.master')
@section('content')

    <!-- Post Content -->

    <div class="col-md-8">
        <p>Bizimle iletişime geçebilirsiniz.</p>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Ad Soyad</label>
                    <input type="text" value="{{old('name')}}" class="form-control" placeholder="Ad Soyadınız" name="name" required >
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Email Adresi</label>
                    <input type="email" value="{{old('email')}}" class="form-control" placeholder="Email Adresiniz" name="email" required >
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12 controls">
                    <label>Konu</label>
                    <select name="topic" class="form-control" id="">
                       <option @if(old('topic')=="Bilgi") @endif>Bilgi</option>
                       <option @if(old('topic')=="Destek") @endif>Destek</option>
                       <option @if(old('topic')=="Genel") @endif>Genel</option>
                    </select>

                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Mesajınız</label>
                    <textarea rows="5" class="form-control" value="{{old('message')}}" placeholder="Mesajınız" name="message" required ></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
        </form>
    </div>

    <div class="col-md-4">
        adafsfdsaf
    </div>

@endsection








