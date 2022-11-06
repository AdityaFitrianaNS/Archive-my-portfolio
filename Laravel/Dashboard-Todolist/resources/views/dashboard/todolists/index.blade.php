@extends('layouts.dashboard.main')

@section('container')
    <div class="row ">
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-header card-header-text">
                    <h4 class="card-title">My To-do List</h4>
                    <p class="sub-text" style="margin-top: -5px;">
                        Last update {{ $todolists[0]->due->format('d F, H:i') }}
                    </p>
                </div>

                <div class="card-content table-responsive" id="card-content">
                    <a href="todolists/create" class="btn mb-2" id="btn-add">
                        <i class="bi bi-clipboard-plus bi-action"></i>
                        Add Todolist
                    </a>

                    <table class="table table-bordered table-hover text-center">
                        <thead class="text-white">
                            <tr class="table-title" style="font-weight: bold">
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($todolists as $todolist)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{!! Str::limit($todolist->title, 25) !!}</td>
                                    <td>{!! Str::limit($todolist->category->name, 15) !!}</td>
                                    <td>{{ $todolist->created_at->format('d F, H:i') }}</td>
                                    <td>{{ $todolist->due->format('d F, H:i') }}</td>
                                    @if ($todolist->status == 'Finished')
                                        <td>
                                            <div class="bg-success rounded-5 text-white" id="status">
                                                <i class="bi bi-check2-circle" style="font-size: 16px"></i>
                                                Finished
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="bg-danger rounded-5" id="status">
                                                <i class="bi bi-x-circle pt-1 text-white" style="font-size: 16px">
                                                    Unfinished
                                                </i>
                                            </div>
                                        </td>
                                    @endif
                                    
                                    <td>
                                        <a href="/todolists/{{ $todolist->slug }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye bi-action text-white text-center"></i>
                                        </a>

                                        <a href="/todolists/{{ $todolist->slug }}/edit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square bi-action text-white"></i>
                                        </a>

                                        <form action="/todolists/{{ $todolist->slug }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger border-0 btn-sm"
                                                onclick="return confirm('Are you sure delete?')">
                                                <i class="bi bi-trash bi-action text-white"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mb-1">
                        {{ $todolists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
