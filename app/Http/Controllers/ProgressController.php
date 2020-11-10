<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Progress;
use App\Post;
use App\Matter;
use App\Task;
use App\User;
use App\Http\Requests\ProgressRequest;
use App\Http\Requests\ProgressAjaxRequest;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Progress $progress){
      $progresses = Progress::orderBy('month', 'desc')->get();
      $posts = Post::orderBy('start_date', 'asc')->get();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('progresses.index', ['progress'=>$progress, 'progresses'=>$progresses, 'today'=>$today, 'posts'=>$posts, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $progresses = Progress::orderBy('id', 'asc')->get();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('progresses.create', ['today'=>$today, 'progresses'=>$progresses, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgressRequest $request){
      $progress = new Progress();
      $progress->measures = $request->measures;
      $progress->month = $request->month;
      $progress->company = $request->company;
      $progress->no = $request->no;
      $progress->title = $request->title;
      $progress->matter_content = $request->matter_content;
      $progress->original_staff = $request->original_staff;
      $progress->original_done = $request->original_done;
      $progress->original_content = $request->original_content;
      $progress->check_staff = $request->check_staff;
      $progress->check_done = $request->check_done;
      $progress->check_content = $request->check_content;
      $progress->update_staff = $request->update_staff;
      $progress->update_done = $request->update_done;
      $progress->update_content = $request->update_content;
      $progress->file_staff = $request->file_staff;
      $progress->file_done = $request->file_done;
      $progress->file_content = $request->file_content;
      $progress->sale_staff = $request->sale_staff;
      $progress->sale_done = $request->sale_done;
      $progress->sale_content = $request->sale_content;
      $progress->final_staff = $request->final_staff;
      $progress->final_done = $request->final_done;
      $progress->final_content = $request->final_content;
      $progress->delivery = $request->delivery;
      // dd($request->all());
      $progress->save();
      session()->flash('flash_message', '投稿が完了しました！');
      return redirect('progresses/' . $progress->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Progress $progress){
      $progresses = Progress::orderBy('id', 'asc')->get();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('progresses.show', ['today'=>$today, 'progress'=>$progress, 'progresses'=>$progresses, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Progress $progress, User $user){
      $posts = Post::all();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('progresses.edit', ['today'=>$today, 'posts'=>$posts, 'progress'=>$progress, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
    }

    public function edit_ajax(Request $request, Progress $progress){
      $progresses = Progress::orderBy('month', 'desc')->get();
      $posts = Post::all();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('progresses.edit_ajax', ['today'=>$today, 'posts'=>$posts, 'progress'=>$progress, 'progresses'=>$progresses, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgressRequest $request, Progress $progress){
      // $progress->update($progress);
      $progress->measures = $request->measures;
      $progress->month = $request->month;
      $progress->company = $request->company;
      $progress->no = $request->no;
      $progress->title = $request->title;
      $progress->matter_content = $request->matter_content;
      $progress->original_staff = $request->original_staff;
      $progress->original_done = $request->original_done;
      $progress->original_content = $request->original_content;
      $progress->check_staff = $request->check_staff;
      $progress->check_done = $request->check_done;
      $progress->check_content = $request->check_content;
      $progress->update_staff = $request->update_staff;
      $progress->update_done = $request->update_done;
      $progress->update_content = $request->update_content;
      $progress->file_staff = $request->file_staff;
      $progress->file_done = $request->file_done;
      $progress->file_content = $request->file_content;
      $progress->sale_staff = $request->sale_staff;
      $progress->sale_done = $request->sale_done;
      $progress->sale_content = $request->sale_content;
      $progress->final_staff = $request->final_staff;
      $progress->final_done = $request->final_done;
      $progress->final_content = $request->final_content;
      $progress->delivery = $request->delivery;
      $progress->save();
      session()->flash('flash_message', '更新しました！');
      return redirect('progresses/' . $progress->id);
    }

    public function update_ajax(ProgressAjaxRequest $request, Progress $progress){
      foreach($request->progress as $id => $attribute){
        $progress = Progress::find($id);
        $progress->original_staff = $attribute['original_staff'];
        $progress->check_staff = $attribute['check_staff'];
        $progress->update_staff = $attribute['update_staff'];
        $progress->file_staff = $attribute['file_staff'];
        $progress->sale_staff = $attribute['sale_staff'];
        $progress->final_staff = $attribute['final_staff'];
        $progress->save();
        // $progress->update($attribute);
      }
      session()->flash('flash_message', '更新しました！');
      return redirect('progresses');
    }

    public function delete(Request $request){
      Progress::find($request->id)->delete();
      session()->flash('flash_message', '削除が完了しました！');
      return redirect('/progresses');
    }

    public function delete_progress(Request $request){
      $validatedData = $request->validate([
        'ids' => 'array|required'
      ]);
      Progress::destroy($request->ids);
      session()->flash('flash_message', '削除が完了しました！');
      return redirect('/progresses');
    }
}
