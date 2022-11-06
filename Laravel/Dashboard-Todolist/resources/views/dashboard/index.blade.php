@extends('layouts.dashboard.main')

@section('container')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <i class="bi bi-clipboard text-primary"></i>
                </div>
                <div class="card-content">
                    <p class="category">
                        <strong>Total Task</strong>
                    </p>
                    <h3 class="card-title">{{ $todolist }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="bi bi-info-circle-fill"></i>
                        <a href="todolists">See detailed task</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <i class="bi bi-check2-circle text-success"></i>
                </div>
                <div class="card-content">
                    <p class="category">
                        <strong>Task Finished</strong>
                    </p>
                    <h3 class="card-title">{{ $finished }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="bi bi-info-circle-fill"></i>
                        <a href="todolist/status/finished">See detailed task finished</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <i class="bi bi-dash-circle text-danger"></i>
                </div>
                <div class="card-content">
                    <p class="category">
                        <strong>Task Unfinished</strong>
                    </p>
                    <h3 class="card-title">{{ $unfinished }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="bi bi-info-circle-fill"></i>
                        <a href="todolist/status/unfinished">See detailed task unfinished</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <i class="bi bi-tag text-info"></i>
                </div>
                <div class="card-content">
                    <p class="category">
                        <strong>All Category</strong>
                    </p>
                    <h3 class="card-title">{{ $category }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="bi bi-info-circle-fill"></i>
                        <a href="todolist/categories">See detailed task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
