@extends('layouts.dashboard.main')

@section('container')
    <div class="row">
        @if ($categories->count())
            <div class="col-lg-12 col-md-12">
                <div class="card px-3">
                    <div class="pt-3 card-header-text">
                        <h4 class="card-title">To-do List Categories</h4>
                        <p class="sub-text" style="margin-top: -5px;">
                            Last update {{ $categories[0]->updated_at->format('d F, H:i') }}
                        </p>
                    </div>

                    <a href="categories/create" class="btn btn-primary mt-3">
                        Add Category
                    </a>

                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-4 mb-2">
                                <div class="card bg-dark text-white" id="category">
                                    <img src="https://picsum.photos/500?{{ $category->name }}" class="card-img img-fluid"
                                        alt="{{ $category->name }}" style="object-fit: cover; height: 150px;">

                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center flex-fill p-4 fs-5"
                                            style="background-color: rgba(0, 0, 0, 0.7)">
                                            {{ $category->name }}

                                            <br>
                                            <a href="/categories/{{ $category->id }}" class="btn btn-info btn-sm mt-1">
                                                <i class="bi bi-eye bi-action text-white text-center"></i>
                                            </a>

                                            <a href="/categories/{{ $category->id }}/edit" class="btn btn-warning btn-sm mt-1">
                                                <i class="bi bi-pencil-square bi-action text-white"></i>
                                            </a>

                                            <form action="/categories/{{ $category->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm mt-1"
                                                    onclick="return confirm('Are you sure delete?')">
                                                    <i class="bi bi-trash bi-action text-white"></i>
                                                </button>
                                            </form>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="error-page container">
                            <div class="col-md-8 col-12 offset-md-2">
                                <div class="text-center">
                                    <h3 class="error-title fw-semibold mt-3">NOT FOUND</h3>
                                    <p class='fs-5 text-gray-600'>Categories not found, please add category.</p>
                                    <a href="/dashboard" class="btn btn-md btn-outline-primary mt-3">Go Back</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex w-100 justify-content-center mb-3">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection