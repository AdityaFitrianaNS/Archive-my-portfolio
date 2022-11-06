@extends('layouts.dashboard.main')

@section('container')
    <div class="row ">
        <div class="col-lg-12 col-md-12">
            <div class="card w-full">

                <div class="card-header card-header-text">
                    <h4 class="card-title">{!! $todolist->title !!}</h4>
                    <p class="sub-text" style="margin-top: -5px;">
                        Last update {{ $todolist->created_at }}
                    </p>
                </div>

                <div class="card-content table-responsive" id="card-content">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-success">
                        <i class="bi bi-action bi-arrow-left"></i> Back
                    </a>

                    <a href="/todolists/{{ $todolist->slug }}/edit" class="btn btn-sm btn-warning text-light">
                        <i class="bi bi-action bi-pencil-square"></i> Edit
                    </a>

                    <form action="/todolists/{{ $todolist->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure delete?')">
                            <i class="bi bi-action bi-trash w-0"></i> Delete
                        </button>
                    </form>

                    <article class="mt-2">
                        {!! $todolist->description !!}
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
