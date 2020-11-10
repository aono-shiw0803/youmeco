<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Task;
use App\Matter;
use App\User;
use App\Post;
use Carbon\Carbon;
use Yasumi\Yasumi;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Matter $matter, User $user){
       $tasks = Task::orderBy('id', 'asc')->get();
       $matters = Matter::orderBy('rank', 'asc')->get();
       $users = User::orderBy('rank', 'asc')->get();
       $today = Carbon::today()->format('Y年m月d日');
       return view('tasks.index', ['today'=>$today, 'tasks'=>$tasks, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Matter $matter, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $today = Carbon::today()->format('Y年m月d日');
      return view('tasks.create', ['today'=>$today, 'tasks'=>$tasks, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request){
      $task = new Task();
      $task->title = $request->title;
      $task->bg = $request->bg;
      $task->save();
      session()->flash('flash_message', 'タスクを追加しました！');
      return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Task $task, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $task = Task::find($task->id);
      $posts = Post::where('task', $task->title)->orderBy('start_date', 'asc')->paginate(10);
      $start_date = $request->start_date ?? Carbon::today()->startOfMonth()->format('Y-m-d');
      $end_date = $request->end_date ?? Carbon::today()->endOfMonth()->format('Y-m-d');
      $today = Carbon::today()->format('Y年m月d日');
      $today2 = Carbon::today()->format('Y-m-d');
      $date = $date ?? Carbon::today();
      $date = is_string($date) ? Carbon::parse($date) : $date;
      $holidays = Yasumi::create('Japan', $date->year);
      $weeks = [0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土'];
      $startCarbon = Carbon::parse($start_date);
      $endCarbon = Carbon::parse($end_date);
      $array = collect(range(0, $endCarbon->diffInMonths($startCarbon)))
      ->map(function($month) use ($startCarbon, $endCarbon) {
        $current = $startCarbon->copy()->addMonth($month);
        $start = $end = null;
        if ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
          $start = $startCarbon;
          $end = $startCarbon->copy()->endOfMonth();
        } else if ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
          $start = $endCarbon->copy()->startOfMonth();
          $end = $endCarbon;
        } else {
          $start = $current->copy()->startOfMonth();
          $end = $current->copy()->endOfMonth();
        }
        $dayCount = $end->diffInDays($start) + 1;
        return compact('start', 'end', 'dayCount');
      });
      return view('tasks.show', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'task'=>$task, 'tasks'=>$tasks, 'start_date'=>$start_date, 'end_date'=>$end_date, 'matters'=>$matters, 'users'=>$users, 'user'=>$user, 'posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $today = Carbon::today()->format('Y年m月d日');
      return view('tasks.edit', ['today'=>$today, 'task'=>$task, 'tasks'=>$tasks, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task){
      $task->title = $request->title;
      $task->bg = $request->bg;
      $task->save();
      session()->flash('flash_message', 'タスクを更新しました！');
      return redirect('/tasks');
    }

    public function delete(Request $request){
      Task::find($request->id)->delete();
      session()->flash('flash_message', '削除が完了しました！');
      return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

    }
}
