@extends('layouts.app')

@section('content')
    @foreach($news as $item)
        <div style="padding-bottom: 20px">
            <h2>{{$item->title}}</h2>
            {{Str::limit($item->text, 200)}}
            <div class="btn">
                <a class="white" href="{{$item->id}}">
                    <p>
                        <span class="bg"></span>
                        <span class="base"></span>
                        <span class="text">Подробнее</span>
                    </p>
                </a>
            </div>
        </div>
    @endforeach
@endsection
