@extends('layouts.dashboard')
@section('content')
    <h1>Dettagli post</h1>
    <h1>ID: {{$post->id}}</h1>
    <ul>
        <li>Titolo: {{$post->title}}</li>
        <li>Testo: {{$post->text}}</li>
        <li>Slug: {{$post->slug}}</li>
        <li>Categoria: {{$post->category->name ?? ''}}</li>
        <li>Tags:  @forelse ($post->tags as $tag)
                        {{ $tag->name }}{{ $loop->last ? '' : ', '}}
                    @empty
                        -
                    @endforelse</li>
    </ul>
@endsection
