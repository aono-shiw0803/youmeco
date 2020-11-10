<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Matter;
use App\User;
use App\Post;
use Carbon\Carbon;
use Yasumi\Yasumi;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user){
      $users = User::orderBy('rank', 'asc')->get();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $today = Carbon::today()->format('Y年m月d日');
      return view('users.index', ['today'=>$today, 'users'=>$users, 'matters'=>$matters, 'tasks'=>$tasks, 'user'=>$user]);
    }
    // public function export(Request $request){
    //   $response = new StreamedResponse(function() use ($request){
    //     $stream = fopen('php://output', 'w');
    //     stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
    //     fputcsv($stream, ['id','name','rank']);
    //     User::chunk(1000, function($results) use ($stream){
    //       foreach($results as $result){
    //         fputcsv($stream, [$result->id,$result->name,$result->rank]);
    //       }
    //     });
    //     fclose($stream);
    //   });
    //   $response->headers->set('Content-Type', 'application/octet-stream');
    //   $response->headers->set('Content-Disposition', 'attachment; filename="UserList.csv"');
    //   return $response;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('users.create', ['today'=>$today, 'users'=>$users, 'matters'=>$matters, 'tasks'=>$tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(UserRequest $request){
       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->username = $request->username;
       $user->rank = $request->rank;
       $path = $request->file('icon')->store('public');
       $user->icon = basename($path);
       $user->save();
       session()->flash('flash_message', 'メンバーを登録しました！');
       return redirect('/users')->with('filename', basename($path));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $user = User::find($user->id);
      $posts = Post::where('staff', $user->name)->orderBy('start_date', 'asc')->paginate(10);
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
      return view('users.show', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'user'=>$user, 'users'=>$users, 'start_date'=>$start_date, 'end_date'=>$end_date, 'matters'=>$matters, 'tasks'=>$tasks, 'posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('users.edit', ['today'=>$today, 'user'=>$user, 'users'=>$users, 'matters'=>$matters, 'tasks'=>$tasks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user){
      $user->name = $request->name;
      $user->email = $request->email;
      $user->username = $request->username;
      $user->rank = $request->rank;
      if($user->icon = $request->icon){
        $path = $request->file('icon')->store('public');
        $user->icon = basename($path);
      }
      $user->save();
      session()->flash('flash_message', '個人情報を更新しました！');
      return redirect('/users')->with('filename', basename($path));
      return redirect('/users');
    }

    public function delete(Request $request){
      User::find($request->id)->delete();
      session()->flash('flash_message', 'メンバーを削除しました！');
      return redirect('/users');
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
