@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads/' . $post->image) }}" alt="{{ $post->title }}" class="rounded-md">

            <div class="p-3 flex items-center gap4">
                0 likes
            </div>
        </div>

        <div class="md:w-1/2">
        </div>

    </div>

@endsection
