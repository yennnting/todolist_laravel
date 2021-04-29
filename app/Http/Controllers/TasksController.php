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
//        soj: 查找看 laravel 啟動，include 多少檔案
//        return count(get_included_files());
//        soj:
//        variable $user 是從哪來的？
//        命名要改 $userId
//        soj:
//        可以不用找出 $user (Model)?
//        $tasks = Task::where('user_id', $user)->latest()->get();
        $user = User::findOrFail($user); // User Model
//        dd();
//        ddd();

        // database : 1. sql query, 2. query builder 3. eloquent builder （base on query builder)

//        User::find($userId);
//        User::where('id', $userId)->where(...)->get(); // 有 get() => model, 沒有 get() => builder
        // where :  select ... where ...，update table values() where ... and，delete
        // collection
//        soj:
//        可以不用 with user
        $tasks = Task::whereIn('user_id', $user)->with('user')->latest()->get(); //collection
//        $tasks = Task::whereIn('user_id', [$user, 2, 3])->with('user')->latest(); // Query Builder
        // where in 後面是放 array， where 後面是放單一值

//        $this->authorize('viewAny', Task::class);
//        soj:
//        同上，可以不用 load users relationship table

        return view('home', compact('user'));

    }

    public function store()
    {
//        soj:
//        request body 命名原則 task-name => task_name or taskName
        $data = request()->validate([
            'task-name' => 'required',
        ]);

        auth()->user()->tasks()->create([
            'taskName' => $data['task-name'],
        ]);

        return redirect('/user/' . auth()->user()->id);
    }

    //php type hint
    public function edit(Task $task)
    {
//        $user = Auth::user();
//        $task = Task::where('id', $task['id'])->where('user_id',$user['id'])->first();
        $this->authorize('update', $task);
        return view('edit', compact('task'));
    }

    public function update(\Illuminate\Http\Request $request, $task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('update', $task);

        // request() helper function
        // marco()
//        request()->validate();
        $validated = $this->validate($request, [
            'task-name' => 'required',
        ]);

        // input name , database column name 一致

        $task->update($validated);

        $task->update([
            'taskName' => $validated['task-name'],
        ]);

        return redirect('/user/' . auth()->user()->id);
    }

    public function completed($task_id)
    {
        $task = Task::find($task_id);
        $this->authorize('update', $task);

        $task->update([
//            soj
//            value 應該填 true
            'flag' => true,
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
