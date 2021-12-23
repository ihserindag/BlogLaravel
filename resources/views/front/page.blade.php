@section('title',$page->title)
@section('bg',$page->image)
@extends('front.layouts.master')
@section('content')

    <!-- Post Content -->

    <div class="col-lg-8 col-md-10 mx-auto">

           {!! $page->content !!}




    </div>

@endsection

