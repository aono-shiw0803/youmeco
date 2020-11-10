<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Matter;
use App\Task;
use App\User;
use App\File;
use App\Calendar;

class CalendarController extends Controller
{
  // public function index(){
  //   $calendars = Calendar::orderBy('created_at', 'desc')->get();
  //   return view('posts.index', ['start_date' => $request->start_date, 'end_date' => $request->end_date]);
  // }
  //
  // public function show(Calendar $calendar){
  //   $calendars = Calendar::all();
  //   $files = File::all();
  //   $matters = Matter::all();
  //   $tasks = Task::all();
  //   $users = User::all();
  //   return view('calendars.show', ['calendar'=>$calendar, 'calendars'=>$calendars, 'files'=>$files, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
  // }
  //
  // public function create(Calendar $calendar){
  //   $calendars = Calendar::all();
  //   $files = File::all();
  //   $matters = Matter::all();
  //   $tasks = Task::all();
  //   $users = User::all();
  //   return view('calendars.create', ['calendar'=>$calendar, 'calendars'=>$calendars, 'files'=>$files, 'matters'=>$matters, 'tasks'=>$tasks, 'users'=>$users]);
  // }
  //
  // public function store(Request $request){
  //   $calendar = new Calendar();
  //   $calendar->start_date = $request->start_date;
  //   $calendar->end_date = $request->end_date;
  //   $calendar->save();
  //   return redirect('/calendars');
  // }
}
