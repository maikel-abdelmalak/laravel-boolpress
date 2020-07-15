@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Elenco Articoli</h1>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Aggiungi Post</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>SLUG</th>
                        <th>TAGS</th>
                        <th class="text-right">AZIONI</th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->slug}}</td>
                                <td>
                                    @forelse ($post->tags as $tag)
                                       {{ $tag->name }}{{ $loop->last ? '' : ', '}}
                                    @empty
                                       -
                                    @endforelse
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-info" href="{{route('admin.posts.show', ['post'=> $post->id])}}">Dettagli</a>
                                    <a class="btn btn-info" href="{{route('admin.posts.edit', ['post'=> $post->id])}}">Modifica</a>
                                    <form class="d-inline" action="{{route('admin.posts.destroy', ['post'=> $post->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-info" type="submit" name="button" >Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
