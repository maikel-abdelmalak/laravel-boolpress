@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$post->title}}</h1>
                @forelse ($post->tags as $tag)
                    <span class="badge badge-primary"> {{ $tag->name}}</span>
                @empty

                 @endforelse
                <p>{{$post->text}}</p>
                <smaller>{{$post->category->name ?? ''}}</smaller>
            </div>
        </div>
    </div>
@endsection
