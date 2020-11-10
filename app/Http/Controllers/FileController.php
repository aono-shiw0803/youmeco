<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Matter;
use App\Task;
use App\User;
use App\File;
use Carbon\Carbon;
use App\Http\Requests\FileRequest;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $files = File::orderBy('created_at', 'desc')->get();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('files.index', ['today'=>$today, 'files'=>$files, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $tasks = Task::all();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('files.create', ['today'=>$today, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request){
      $file = new File();
      $file->file = $request->file;
      $file->matter = $request->matter;
      $file->task = $request->task;
      $file->type = $request->type;
      $file->content = $request->content;
      $request->file('file')->storeAs('public','upload_file.'.$request->type);
      $file->save();
      session()->flash('flash_message', 'アップロードが完了しました！');
      return redirect('/files');
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

    public function delete(Request $request){
      File::find($request->id)->delete();
      session()->flash('flash_message', '削除が完了しました！');
      return redirect('/files');
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
