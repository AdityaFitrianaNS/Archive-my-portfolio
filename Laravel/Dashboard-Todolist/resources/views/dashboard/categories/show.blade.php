@extends('layouts.dashboard.main')

@section('container') 
    <div class="col-lg-12 col-md-12">
        <div class="card px-3" style="min-height: 485px">

            <div class="pt-3 card-header-text">
                <h4 class="card-title">Todolist by categories</h4>
            </div>

            <div class="row">
                @if ($todolists->count())
                    @foreach ($todolists as $todolist)
                        <div class="col-16 col-md-6 col-lg-4 mb-0">
                            <div class="card" id="category-todolist">
                                <div class="card-body border border-secondary">

                                    <h5 class="card-title mb-2 text-center">
                                        <a href="/blog/{{ $todolist->slug }}" class="text-decoration-none text-dark">
                                            {!! Str::limit($todolist->title, 20) !!}
                                        </a>
                                    </h5>

                                    <p class="m-0 text-center">
                                        {!! Str::limit($todolist->description, 70) !!}
                                    </p>

                                    <p class="mt-1 text-muted text-center">
                                        Last update {{ $todolist->created_at->diffForHumans() }}
                                    </p>

                                    <a href="/todolists/{{ $todolist->slug }}" class="btn btn-primary w-100 mt-2" style="font-size: 14px;">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center fs-4">No post found.</p>
                @endif
            </div>

            <div class="d-flex justify-content-center mb-3 mt-3">
                {{ $todolists->links() }}
            </div>
        </div>
    </div>
@endsection
