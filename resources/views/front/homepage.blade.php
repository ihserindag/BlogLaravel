@section('title','Anasayfa')

@extends('front.layouts.master')
@section('content')

        <div class="col-md-9 mx-auto">

            @include('front.widgets.articleList')

            <!-- Pager -->
           
        </div>

    @include('front.widgets.categoryWidget')
@endsection

