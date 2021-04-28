<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;


class TasksController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index($user)
    {
        $user = User::findOrFail($user);
        $tasks = Task::whereIn('user_id', $user)->with('user')->latest();

//        $this->authorize('viewAny', Task::class);
        return view('home', compact('tasks','user'));

    }

    public function store()
    {
        $data = request()->validate([
            'task-name' => 'required',
        ]);

        auth()->user()->tasks()->create([
            'taskName' => $data['task-name'],
        ]);

        return redirect('/user/' . auth()->user()->id);
    }

    public function edit(Task $task)
    {
//        $user = Auth::user();
//        $task = Task::where('id', $task['id'])->where('user_id',$user['id'])->first();
        $this->authorize('update', $task);
        return view('edit', compact('task'));
    }

    public function update($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('update', $task);

        $data = request()->validate([
            'task-name' => 'required',
        ]);

        $task->update([
            'taskName' => $data['task-name'],
        ]);

        return redirect('/user/' . auth()->user()->id);
    }

    public function completed($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('update', $task);

        $task->update([
            'flag' => 1,
        ]);

        return back();
    }

    public function destroy($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('delete', $task);
        $task->delete();

        return back();
    }
}
