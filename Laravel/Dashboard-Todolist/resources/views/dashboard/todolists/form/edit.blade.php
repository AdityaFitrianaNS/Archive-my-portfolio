@extends('layouts.dashboard.main')

@section('container')
    <div class="col-lg-6 offset-lg-3 align-items-center">
        <h3 class="mt-1 mb-3" style="border-bottom: 1px solid #cccccc;">
            Edit {{ $todolist->title }}
        </h3>

        <form action="/todolists/{{ $todolist->slug }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

            <!-- Title -->
            <div class="mb-1">
                <label for="title" class="form-label">Title</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-card-heading icon-input"></i>
                    </span>

                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" value="{{ old('title', $todolist->title) }}" placeholder="Input your title" autofocus
                        required>

                    @error('title')
                        <div class="invalid-feedback" style="margin-bottom: -5px">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Slug -->
            <div class="mb-1">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-link-45deg icon-input"></i>
                    </span>

                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                        id="slug" value="{{ old('slug', $todolist->slug) }}" placeholder="Input your slug" required>

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Category -->
            <div class="mb-1">
                <label for="category" class="form-label">Category</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-tag icon-input" style="rotate: 90deg"></i>
                    </span>

                    <select class="form-select @error('create') is-invalid @enderror" name="category_id" required>
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Due -->
            <div class="mb-1">
                <label for="due" class="form-label">Due</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-calendar-event icon-input"></i>
                    </span>

                    <input type="datetime-local" class="form-control @error('due') is-invalid @enderror" name="due"
                        id="due" value="{{ old('due'), $todolist->due->format('d F, H:i') }}" required>

                    @error('due')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div class="mb-1">
                <label for="status" class="form-label">Status</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">
                        <i class="bi bi-tag icon-input" style="rotate: 90deg"></i>
                    </span>

                    <select class="form-select @error('create') is-invalid @enderror" name="status" required>
                        @if ($todolist->status == 'Finished')
                            <option value="Finished" selected>
                                Finished
                            </option>
                            <option value="Unfinished">
                                Unfinished
                            </option>
                        @else
                            <option value="Unfinished" selected>
                                Unfinished
                            </option>
                            <option value="Finished">
                                Finished
                            </option>
                        @endif
                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mb-2">
                <label for="description" class="form-label mb-1">Description</label>
                @error('description')
                    <div class="text-danger invalid-description">{{ $message }}</div>
                @enderror

                <input name="description" id="description" type="hidden"
                    value="{{ old('description', $todolist->description) }}">
                <trix-editor input="description"></trix-editor>
            </div>

            <div class="mb-3">
                <a href="/todolists" class="btn btn-secondary px-3">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="/js/index.js"></script>
@endsection
