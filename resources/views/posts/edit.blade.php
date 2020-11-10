@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('posts-edit', $post) }}
@endsection

@section('main')
<div class="page-title">
  <p>タスク編集</p>
</div>
<div class="posts-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/posts', $post->id)}}">
  @csrf
  @method('PATCH')
  <table class="edit-posts-table">
    <tbody>
      <tr>
        <th>案件名<span class="must">※</span></th>
        <td>
          <select autofocus name="matter">
            @foreach($matters as $matter)
            <option value="{{$matter->name}}" @if(old('matter', $post->matter) == $matter->name) selected @endif>{{$matter->name}}</option>
            @endforeach
          </select>
          @if($errors->has('matter'))
          <span id="error">{{$errors->first('matter')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>案件名2</th>
        <td>
          <select autofocus name="matter_2">
            <option disabled selected value>選択してください</option>
            @foreach($matters as $matter)
            <option value="{{$matter->name_2}}" @if(old('matter_2', $post->matter_2) == $matter->name_2) selected @endif>{{$matter->name_2}}</option>
            @endforeach
          </select>
          @if($errors->has('matter_2'))
          <span id="error">{{$errors->first('matter_2')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>タスク<span class="must">※</span></th>
        <td>
          <select name="task" value="{{old('task', $post->task)}}">
            @foreach($tasks as $task)
            <option value="{{$task->title}}" @if(old('task', $post->task) == $task->title) selected @endif>{{$task->title}}</option>
            @endforeach
          </select>
          @if($errors->has('task'))
          <span id="error">{{$errors->first('task')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>作業者<span class="must">※</span></th>
        <td>
          <select name="staff">
            @foreach($users as $user)
            <option value="{{$user->name}}" @if(old('user', $post->staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
          @if($errors->has('staff'))
          <span id="error">{{$errors->first('staff')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>営業担当</th>
        <td>
          <select id="small" name="salestaff">
            <option disabled selected value>選択してください</option>
            <option value="清野部長" @if(old('salestaff', $post->salestaff) == '清野部長') selected @endif>清野部長</option>
            <option value="中西Mgr" @if(old('salestaff', $post->salestaff) == '中西Mgr') selected @endif>中西Mgr</option>
            <option value="日高リーダー" @if(old('salestaff', $post->salestaff) == '日高リーダー') selected @endif>日高リーダー</option>
            <option value="伏木" @if(old('salestaff', $post->salestaff) == '伏木') selected @endif>伏木</option>
            <option value="森杉" @if(old('salestaff', $post->salestaff) == '森杉') selected @endif>森杉</option>
            <option value="橋本・石黒" @if(old('salestaff', $post->salestaff) == '橋本・石黒') selected @endif>橋本・石黒</option>
            <option value="データメゾン" @if(old('salestaff', $post->salestaff) == 'データメゾン') selected @endif>データメゾン</option>
            <option value="集客激増" @if(old('salestaff', $post->salestaff) == '集客激増') selected @endif>集客激増</option>
          </select>
          @if($errors->has('salestaff'))
          <span id="error">{{$errors->first('salestaff')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>営業担当欄の背景色</th>
        @php
          $salestaff_bgs[] = array();
          $salestaff_bgs = ['#FFCC66', '#99CC99', '#FFC7AF', '#A4C6FF', '#CCCCCC', '#D9E5FF', '#FFCCCC']
        @endphp
        <td id="radio-salestaff_bg">
          @foreach($salestaff_bgs as $salestaff_bg)
          <i class="fas fa-circle" style="color:{{$salestaff_bg}}"></i><input type="radio" name="salestaff_bg" value="{{$salestaff_bg}}" @if(old('salestaff_bg', $post->salestaff_bg) == $salestaff_bg) checked @endif>
          @endforeach
        </td>
      </tr>
      <tr>
        <th>担当者</th>
        <td>
          <select id="small" name="windowstaff">
            <option disabled selected value>選択してください</option>
            @foreach($users as $user)
            <option value="{{$user->name}}" @if(old('user', $post->windowstaff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
          @if($errors->has('windowstaff'))
          <span id="error">{{$errors->first('windowstaff')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>工数<span class="must">※</span></th>
        <td>
          <input type="text" inputmode="numeric" pattern="\d*" name="hour" value="{{old('hour', $post->hour)}}">
          @if($errors->has('hour'))
          <span id="error">{{$errors->first('hour')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>種別</th>
        <td>
          <select id="small" name="type">
            <option disabled selected value>選択してください</option>
            <option value="記事" @if(old('type', $post->type) == '記事') selected @endif>記事</option>
            <option value="方針案" @if(old('type', $post->type) == '方針案') selected @endif>方針案</option>
          </select>
          @if($errors->has('type'))
          <span id="error">{{$errors->first('type')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>開始日<span class="must">※</span></th>
        <td>
          <input type="date" name="start_date" value="{{old('start_date', $post->start_date)}}">
          @if($errors->has('start_date'))
          <span id="error">{{$errors->first('start_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>完了日<span class="must">※</span></th>
        <td>
          <input type="date" name="end_date" value="{{old('end_date', $post->end_date)}}">
          @if($errors->has('end_date'))
          <span id="error">{{$errors->first('end_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>タスク状況<span class="must">※</span></th>
        <td>
          <select name="status">
            <option value=0 @if(old('status', $post->status) == 0) selected @endif>未完了</option>
            <option value=1 @if(old('status', $post->status) == 1) selected @endif>完了</option>
          </select>
        </td>
      </tr>
      <tr>
        <th>納品日</th>
        <td>
          <input type="date" name="delivery_date" value="{{old('delivery_date', $post->delivery_date)}}">
          @if($errors->has('delivery_date'))
          <span id="error">{{$errors->first('delivery_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>納品数</th>
        <td>
          <input id="delivery" type="text" name="delivery_number" value="{{old('delivery_number', $post->delivery_number)}}" placeholder="例）2/3">
          @if($errors->has('delivery_number'))
          <span id="error">{{$errors->first('delivery_number')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>重要チェック</th>
        <td>
          <input type="checkbox" name="important" value=1 @if(old('important', $post->important) == 1) checked @endif>&nbsp;&nbsp;&nbsp;<span id="important">※重要なタスクの場合はチェックを入れてください。</span>
          @if($errors->has('important'))
          <span id="error">{{$errors->first('important')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="textarea" name="content">{{old('content', $post->content)}}</textarea>
          @if($errors->has('content'))
          <span id="error">{{$errors->first('content')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="edit-posts-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
