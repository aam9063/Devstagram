@extends('layouts.app')

@section('title')
    Create a new post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col
                justify-center items-center">
                @csrf <!-- CSRF Token -->

            </form>
        </div>
        <div class="md:w-6/12 p-10 bg-white  rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Title
                    </label>
                    <input id="title" name="title" type="text" placeholder="Post title"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('title') }}" />
                    @error('name')
                        <!-- Error message -->
                        <p class="bg-red-500 text-white my-2 rounded-lg
                    text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">
                        Description
                    </label>
                    <textarea id="description" name="description" placeholder="Post Description"
                        class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}
                    </textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg
                    text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input name="image" type="hidden" value="{{ old('image') }}" />
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg
                    text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Post"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>

    </div>
@endsection
