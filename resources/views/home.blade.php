@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">New Task</div>

                <div class="card-body">
                    <!-- New Task Form -->
                    <form action="/p" enctype="multipart/form-data" method="POST">
                        @csrf
                        <!-- Task Name -->
                        <div class="form-group row">
                            <label for="task-name" class="col-md-3 col-form-label text-md-right">Task</label>

                            <div class="col-md-6">
                                <input type="text"
                                       name="task-name"
                                       id="task-name"
                                       class="form-control @error('task-name') is-invalid @enderror">
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
                                    <i class="fa fa-btn fa-plus"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Current Tasks</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Task</th>
                            <th> </th>
                        </thead>
                        <tbody>
                            @foreach($user->tasks as $task)
                                <tr style="height: 70px">
                                    @if($task->flag)
                                        <td class="pt-3" style="border:0;"><del>{{ $task->taskName }}</del></td>
                                    @else
                                        <td class="pt-3" style="border:0;">{{ $task->taskName }}</td>
                                    @endif

                                    <!-- Task Buttons -->
                                    <td class="row offset-sm-4" style="border:0; ">
                                        <form action="/p/{{ $task->id }}/completed" method="POST" class="pr-2">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            @if($task->flag)
                                                <button type="submit" class="btn btn-success" disabled><i class="fa fa-btn fa-thumbs-o-up"></i> completed</button>
                                            @else
                                                <button type="submit" class="btn btn-success"><i class="fa fa-btn fa-thumbs-o-up"></i> completed</button>
                                            @endif
                                        </form>

                                        <form action="/p/{{ $task->id }}/edit" method="POST" class="pr-2">
                                            {{ csrf_field() }}
                                            {{ method_field('GET') }}
                                            @if($task->flag)
                                                <button type="button" class="btn btn-primary"><i class="fa fa-btn fa-pencil"></i> edit</button>
                                            @else
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-pencil"></i> edit</button>
                                            @endif
                                        </form>

                                        <form action="/p/{{ $task->id }}" method="POST" >
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-btn fa-trash"></i> delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
