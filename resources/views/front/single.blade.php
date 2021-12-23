@section('title',$article->title)
@section('bg',"../".$article->image)
@extends('front.layouts.master')
@section('content')

    <!-- Post Content -->

                <div class="col-md-9 mx-auto">

                    {!! $article->content !!}
                    <br>
                    <span class="text-danger">Okunma Sayısı : <b>{{$article->hit}}</b> </span>

                </div>
   @include('front.widgets.categoryWidget')

@endsection

