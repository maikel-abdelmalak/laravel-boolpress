@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Elenco post</h1>
            <table class="table">
                @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td class="text-right">
                            <a class="btn btn-info" href="{{route('show', ['slug'=> $post->slug])}}">Leggi</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <ul>


            </ul>
        </div>
    </div>
</div>
@endsection
