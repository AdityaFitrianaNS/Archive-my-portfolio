@extends('layouts.dashboard.main')

@section('container')
    <div class="col-lg-12 col-md-12">
        <div class="card px-3">
            <div class="row">
                @if ($finished->count())
                    <div class="pt-3 card-header-text">
                        <h4 class="card-title">To-do List Unfinished</h4>
                    </div>
                    @foreach ($finished as $finish)
                        <div class="col-16 col-md-6 col-lg-4 mb-0">
                            <div class="card" id="status-finished">
                                <div class="card-body border border-primary">
                                    <h5 class="card-title mb-2 text-center">
                                        <a href="/todolists/{{ $finish->slug }}" class="text-decoration-none text-dark">
                                            {!! Str::limit($finish->title, 20) !!}
                                        </a>
                                    </h5>

                                    <p class="m-0">
                                        {!! Str::limit($finish->description, 70) !!}
                                    </p>

                                    <p class="mt-1 text-muted">
                                        Last update {{ $finish->created_at->diffForHumans() }}
                                    </p>

                                    <a href="/todolists/{{ $finish->slug }}" class="btn btn-primary w-100 mt-2"
                                        style="font-size: 14px;">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="error-page container">
                        <div class="col-md-8 col-12 offset-md-2">
                            <div class="text-center">
                                <h3 class="error-title fw-semibold mt-3">NOT FOUND</h3>
                                <p class='fs-5 text-gray-600'>
                                    To-do list finished not found, please change status to-do list.
                                </p>
                                <a href="/dashboard" class="btn btn-md btn-outline-primary mt-3">
                                    Go Back
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-center mb-3 mt-3">
                    {{ $finished->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
