@extends('layouts.admin')
@section('content')
<div class="container-xl ">
    <h1 class="my-5">{{ $title }}</h1>
    {{-- messaggio di cancellazione avvenuta del progetto --}}
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
    {{session('error')}}
    </div>
    @endif
  <form action="{{ $route }}" method="POST">
    @csrf
    @method($method)
    <div class="row row-cols-2">
      <div class="col mt-2 ">
        <label for="title">Titolo</label>
        <input
          type="text"
          class="
          form-control @error('title') is-invalid @enderror"
          id="title"
          name="title"
          value="{{ old('project',$project?->title)}}"
        >
        @error('title')
        <small class="text-danger">
            {{$message}}
        </small>
        @enderror
      </div>

      <div class="col mt-2">
        <label for="link">Link</label>
        <input
          type="text"
          class="
          form-control @error('link') is-invalid @enderror"
          id="link"
          name="link"
          value="{{ old('project',$project?->link)}}"
        >
        @error('link')
        <small class="text-danger">
            {{$message}}
        </small>
        @enderror
      </div>
      <div class="col mt-2">
        <label for="desc">Descrizione</label>
        <textarea
          class="form-control "
          id="desc"
          rows="3"
          name="desc"
          value="{{ old('project',$project?->desc)}}"></textarea
        >

        {{-- <textarea type="textarea" class="form-control" id="desc" name="desc"></textarea> --}}
      </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-outline-success me-3">{{ $btn }}</button>
        <button type="reset" class="btn btn-outline-danger">Cancella</button>
    </div>
  </form>
</div>
@endsection

