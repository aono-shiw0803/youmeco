<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Post;
use App\Matter;
use App\Task;
use App\User;
use Carbon\Carbon;
use \Yasumi\Yasumi;

class ConclusionController extends Controller
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
       $users = User::all();
       $start_date = $request->start_date ?? Carbon::today()->format('Y-m-d');
       $end_date = $request->end_date ?? Carbon::today()->addDay(30)->format('Y-m-d');
       $today = Carbon::today()->format('Y年m月d日');
       $today2 = Carbon::today()->format('Y-m-d');
       $date = $date ?? Carbon::today();
       $date = is_string($date) ? Carbon::parse($date) : $date;
       $holidays = Yasumi::create('Japan', $date->year);
       $weeks = [0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土'];
       return view('conclusions.index', ['weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users, 'user'=>$user]);
     }

     public function export_conclution(Request $request){
       $response = new StreamedResponse(function() use ($request){
         $stream = fopen('php://output', 'w');
         stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
         fputcsv($stream, ['営業担当', '納品日','企業名/サイト名','種別','納品数','担当者']);
         // User::where('name', 'LIKE', '%')->chunk(1000, function($results) use ($stream){
         Post::orderBy('salestaff', 'asc')->orderBy('delivery_date', 'asc')->chunk(1000, function($results) use ($stream){
           foreach($results as $result){
             if($result->delivery_date != null && $result->status == 1){
               fputcsv($stream, [$result->salestaff,$result->delivery_date,$result->matter,$result->type,"'".$result->delivery_number,$result->windowstaff]);
             }
           }
         });
         fclose($stream);
       });
       $response->headers->set('Content-Type', 'application/octet-stream');
       $response->headers->set('Content-Disposition', 'attachment; filename="ConclusionList.'.Carbon::now()->format('Ymd_His').'.csv"');
       return $response;
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
