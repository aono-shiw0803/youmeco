<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Post;
use App\Matter;
use App\Task;
use App\User;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request, User $user){
       $posts = Post::orderBy('start_date', 'asc')->get();
       $matters = Matter::orderBy('rank', 'asc')->get();
       $tasks = Task::all();
       $users = User::orderBy('rank', 'asc')->get();
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
         // $start = $end = $dayCount = null;
         if ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
           $start = $startCarbon;
           $end = $startCarbon->copy()->endOfMonth();
           $dayCount = $end->diffInDays($start);
         } elseif ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
         // } else if ($current->year == $endCarbon->year && $current->month == $endCarbon->month) {
           $start = $endCarbon->copy()->startOfMonth();
           $end = $endCarbon;
           $dayCount = $end->diffInDays($start);
         } else {
           $start = $current->copy()->startOfMonth();
           $end = $current->copy()->endOfMonth();
         }
         $dayCount = $end->diffInDays($start) + 1;
         return compact('start', 'end', 'dayCount');
       });
       return view('contents.index', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
