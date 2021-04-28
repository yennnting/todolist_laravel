@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    <!-- New Task Form -->
                    <form action="/p/{{ $task->id }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')
                        <!-- Task Name -->
                        <div class="form-group row">
                            <label for="task-name" class="col-md-3 col-form-label text-md-right">Task</label>

                            <div class="col-md-6">
                                <input type="text"
                                       name="task-name"
                                       id="task-name"
                                       class="form-control @error('task-name') is-invalid @enderror"
                                       value="{{ old('task-name') ?? $task->taskName }}"
                                       autocomplete="task-name" autofocus>
                            </div>

                            @error('task-name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Please fill the taskname.</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Save Button -->
                        <div class="form-group row">
                            <div class="col-md-3 offset-md-3">
                                <button type="submit" name="submit" class="btn btn-outline-dark">
                                    <i class="fa fa-btn fa-plus"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
