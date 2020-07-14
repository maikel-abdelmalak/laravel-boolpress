@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$post->title}}</h1>
                <p>{{$post->text}}</p>
                <smaller>{{$post->category->name ?? ''}}</smaller>
            </div>
        </div>
    </div>
@endsection
