@extends('layouts.admin')

@section('content')
<div class="container-xl p-1 mt-3 pt-5 mt-5">
    {{-- ? Messaggio di avvenuta cancellazione --}}
    @if(session('deleted'))
                <div class="alert alert-success" role="alert">
                {{ session('deleted')}}
                </div>
    @endif

    {{-- ?messaggio di aggiunta del progetto --}}
    @if(session('success'))
    <div class="alert alert-success my-3" role="alert">
       {{session('success')}}
    </div>
    @endif
    <div class="">
        <a href="{{ route('admin.project.create') }}" class="btn btn-success my-5"><i class="fa-solid fa-folder-plus"></i></a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">tipo</th>
          <th scope="col">Link</th>

          <th scope="col">Descrizione</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($projects as $project )
          <tr>
              <th scope="row">{{$project->title}}</th>
              <td>{{$project->type->name}}</td>
              <td>{{$project->link}}</td>

              <td>{{$project->desc}}</td>
              <td class=" ">
                <a
                  href="{{ route('admin.project.edit', $project)}}"
                  class="btn btn-outline-warning mb-1"
                  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                ><i class="fa-solid fa-pen"></i></a>
                {{-- <form action="" method="POST">

                    <button
                      type="submit"
                      class="btn btn-outline-warning mb-1"
                      style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                      onclick="submitForm({{$project->id}})"
                    >
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </form> --}}
                <form action="{{route('admin.project.destroy', $project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      class="btn btn-outline-danger"
                      style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
              </td>

          </tr>
          @endforeach
      </tbody>
  </table>
  <div class="paginator">
        {{-- {{$projectsPagi->links()}} --}}
    </div>
</div>


{{-- <div class="container-xl">

    <div class="box tab-class w-100">
        <div class="box-title">
          <h5>
            Project
          </h5>
        </div>
        <div class="box-content table-responsive-md overflow-x-hidden w-100">

          <table class="table mb-0 bg-white table-sm table-hover w-100 text-center ">
            <thead class="bg-light">
              <tr>
                <th class="text-start tab-name">Title</th>
                <th class="hide d-md-table-cell tab-date">Link</th>
                <th class="hide d-md-table-cell tab-roi">Tipo</th>
                <th class="tab-state">Descrizione</th>
                <th class="tab-action">Azioni</th>
              </tr>
            </thead>
            <tbody>
              <!-- contenuto -->
              @foreach ($projects as $project )
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    {{$project->link}}
                </td>
                <td class="hide d-md-table-cell">
                    {{$project->type}}
                </td>
                <td class="hide d-md-table-cell">
                    {{$project->desc}}
                </td>
                <td>
                  <button type="button" class="btn btn-outline-secondary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    <i class="fa-solid fa-pen"></i>
                  </button>
                  <button type="button" class="btn btn-outline-secondary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
              </tr>
              <!-- /contenuto -->
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div> --}}
@endsection
