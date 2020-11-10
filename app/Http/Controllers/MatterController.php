<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MatterRequest;
use App\Matter;
use App\Task;
use App\User;
use App\Post;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class MatterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('matters.index', ['today'=>$today, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Matter $matter, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('matters.create', ['today'=>$today, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatterRequest $request){
      $matter = new Matter();
      $matter->name = $request->name;
      $matter->name_2 = $request->name_2;
      $matter->content = $request->content;
      $matter->rank = $request->rank;
      $matter->save();
      session()->flash('flash_message', '案件を追加しました！');
      return redirect('/matters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show(Request $request, Matter $matter, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $matter = Matter::find($matter->id);
      $posts = Post::where('matter', $matter->name)->orderBy('start_date', 'asc')->paginate(10);
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
      return view('matters.show', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'matter'=>$matter, 'matters'=>$matters, 'tasks'=>$tasks, 'start_date'=>$start_date, 'end_date'=>$end_date, 'users'=>$users, 'user'=>$user, 'posts'=>$posts]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matter $matter, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('matters.edit', ['today'=>$today, 'matter'=>$matter, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(MatterRequest $request, Matter $matter){
       $matter->name = $request->name;
       $matter->name_2 = $request->name_2;
       $matter->content = $request->content;
       $matter->rank = $request->rank;
       $matter->save();
       session()->flash('flash_message', '案件を更新しました！');
       return redirect('/matters');
     }

     public function delete(Request $request){
       Matter::find($request->id)->delete();
       session()->flash('flash_message', '削除が完了しました！');
       return redirect('/matters');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
