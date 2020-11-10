<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Post;
use App\Matter;
use App\Task;
use App\User;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class PostController extends Controller
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
    return view('posts.index', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
  }

  public function export_post(Request $request){
    $response = new StreamedResponse(function() use ($request){
      $stream = fopen('php://output', 'w');
      stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
      fputcsv($stream, ['営業担当', '納品日', '企業名/サイト名', '種別', '納品数', '担当者']);
      // User::where('name', 'LIKE', '%')->chunk(1000, function($results) use ($stream){
      Post::orderBy('salestaff', 'asc')->orderBy('delivery_date', 'asc')->chunk(1000, function($results) use ($stream){
        foreach($results as $result){
          if($result->delivery_date != null && $result->status == 0){
            fputcsv($stream, [$result->salestaff,$result->delivery_date,$result->matter,$result->type,"'".$result->delivery_number,$result->windowstaff]);
          }
        }
      });
      fclose($stream);
    });
    $response->headers->set('Content-Type', 'application/octet-stream');
    $response->headers->set('Content-Disposition', 'attachment; filename="PostList.'.Carbon::now()->format('Ymd_His').'.csv"');
    return $response;
  }

  public function conclusion(Request $request, User $user){
    $posts = Post::orderBy('start_date', 'asc')->get();
    $matters = Matter::orderBy('rank', 'asc')->get();
    $tasks = Task::all();
    $users = User::orderBy('rank', 'asc')->get();
    $start_date = $request->start_date ?? Carbon::today()->format('Y-m-d');
    $end_date = $request->end_date ?? Carbon::today()->addDay(30)->format('Y-m-d');
    $today = Carbon::today()->format('Y年m月d日');
    $today2 = Carbon::today()->format('Y-m-d');
    $date = $date ?? Carbon::today();
    $date = is_string($date) ? Carbon::parse($date) : $date;
    $holidays = Yasumi::create('Japan', $date->year);
    $weeks = [0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土'];
    return view('posts.conclusion', ['weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Post $post, User $user){
    $matters = Matter::orderBy('rank', 'asc')->get();
    $tasks = Task::all();
    $users = User::orderBy('rank', 'asc')->get();
    $today = Carbon::today()->format('Y年m月d日');
    return view('posts.create', ['today'=>$today, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PostRequest $request){
    $post = new Post();
    $post->matter = $request->matter;
    $post->matter_2 = $request->matter_2;
    $post->task = $request->task;
    $post->staff = $request->staff;
    $post->hour = $request->hour;
    $post->start_date = $request->start_date;
    $post->end_date = $request->end_date;
    $post->content = $request->content;
    $post->status = $request->status;
    $post->important = $request->important;
    $post->salestaff = $request->salestaff;
    $post->salestaff_bg = $request->salestaff_bg;
    $post->windowstaff = $request->windowstaff;
    $post->type = $request->type;
    $post->delivery_number = $request->delivery_number;
    $post->delivery_date = $request->delivery_date;
    $post->save();
    session()->flash('flash_message', '投稿が完了しました！');
    return redirect('posts/' . $post->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post, User $user){
    $matters = Matter::orderBy('rank', 'asc')->get();
    $tasks = Task::all();
    $users = User::orderBy('rank', 'asc')->get();
    $today = Carbon::today()->format('Y年m月d日');
    return view('posts.show', ['today'=>$today, 'post'=>$post, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post, User $user){
    $matters = Matter::orderBy('rank', 'asc')->get();
    $tasks = Task::all();
    $users = User::orderBy('rank', 'asc')->get();
    $today = Carbon::today()->format('Y年m月d日');
    return view('posts.edit', ['today'=>$today, 'post'=>$post, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(PostRequest $request, Post $post){
     $post->matter = $request->matter;
     $post->matter_2 = $request->matter_2;
     $post->task = $request->task;
     $post->staff = $request->staff;
     $post->hour = $request->hour;
     $post->start_date = $request->start_date;
     $post->end_date = $request->end_date;
     $post->content = $request->content;
     $post->status = $request->status;
     $post->important = $request->important;
     $post->salestaff = $request->salestaff;
     $post->salestaff_bg = $request->salestaff_bg;
     $post->windowstaff = $request->windowstaff;
     $post->type = $request->type;
     $post->delivery_number = $request->delivery_number;
     $post->delivery_date = $request->delivery_date;
     $post->save();
     session()->flash('flash_message', '更新しました！');
     return redirect('posts/' . $post->id);
   }

   public function delete(Request $request){
     Post::find($request->id)->delete();
     session()->flash('flash_message', '削除が完了しました！');
     return redirect('/posts');
   }

   public function delete_post(Request $request){
     $validatedData = $request->validate([
       'ids' => 'array|required'
     ]);
     Post::destroy($request->ids);
     session()->flash('flash_message', '削除が完了しました！');
     return redirect('/conclusions');
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
