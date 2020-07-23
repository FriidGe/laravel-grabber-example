@extends('layouts.app')

@section('content')
    <div style="padding-bottom: 20px">
        <h2>{{$news->title}}</h2>
        @if(!empty($news->img))
            <div>
                <img src="{{$news->img}}" class="article__main-image__image js-rbcslider-image">
            </div>
        @endif
        {{$news->text}}
        <div class="btn">
            <a class="white" href="{{route('news.index')}}">
                <p>
                    <span class="bg"></span>
                    <span class="base"></span>
                    <span class="text">Назад</span>
                </p>
            </a>
        </div>
    </div>
@endsection
