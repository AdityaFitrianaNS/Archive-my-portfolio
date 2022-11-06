@extends('layouts.dashboard.main')

@section('container')
    <div class="col-lg-6 offset-lg-3 mb-3 align-items-center">
        <h3 class="mt-1 mb-3" style="border-bottom: 1px solid #cccccc;">
            New Categories
        </h3>

        <form action="/categories" method="post">
            @csrf
            
            <!-- Name -->
            <div class="mb-1">
                <label for="name" class="form-label">Name</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-card-heading icon-input"></i>
                    </span>
                    
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="title" required autofocus value="{{ old('name') }}" placeholder="Input your name">

                    @error('title')
                        <div class="invalid-feedback" style="margin-bottom: -5px">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Slug -->
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-link-45deg icon-input"></i>
                    </span>

                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                        id="slug" required value="{{ old('slug') }}" placeholder="Input your slug">

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <a href="/categories" class="btn btn-secondary px-3">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="/js/index.js"></script>
@endsection