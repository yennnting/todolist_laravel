@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tasks of All Users</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="text-center">
                            <th>Task</th>
                            <th>User</th>
                            <th> </th>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr style="height: 70px">
                                @if($task->flag)
                                    <td class="pt-3" style="border:0;"><del>{{ $task->taskName }}</del></td>
                                @else
                                    <td class="pt-3" style="border:0;">{{ $task->taskName }}</td>
                                @endif

                                <td class="pt-3 text-center" style="border:0;">
                                    {{ $task->user->name }}
                                </td>

                                <!-- Task Buttons -->
                                <td class="row offset-sm-3" style="border:0;">
                                    @can('update', $task)
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
                                    @endcan
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
