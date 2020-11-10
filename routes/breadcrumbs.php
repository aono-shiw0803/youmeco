<?php

// トップ
Breadcrumbs::for('posts', function ($trail) {
    $trail->push('TOP', url('posts'));
});
// トップ > 完了タスク一覧
Breadcrumbs::for('conclusions', function ($trail) {
    $trail->parent('posts');
    $trail->push('完了タスク一覧', url('conclusions'));
});
// トップ > タスク詳細
Breadcrumbs::for('posts-show', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('タスク詳細', url('posts/' . $post->id));
});
// トップ > 新規登録
Breadcrumbs::for('posts-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('タスク追加', url('tasks/create'));
});
// トップ > タスク詳細 > 編集
Breadcrumbs::for('posts-edit', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('タスク詳細', url('posts/' . $post->id));
    $trail->push('編集', action('PostController@edit', $post));
});


// トップ > 案件一覧
Breadcrumbs::for('matters', function ($trail) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
});
// トップ > 案件一覧 > タイトル
Breadcrumbs::for('matters-show', function ($trail, $matter) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
    $trail->push($matter->name, url('matters, $matter->id'));
});
// トップ > 案件一覧 > 新規登録
Breadcrumbs::for('matters-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
    $trail->push('案件追加', url('matters/create'));
});
// トップ > 案件一覧 > タイトル > 編集
Breadcrumbs::for('matters-edit', function ($trail, $matter) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
    $trail->push($matter->name, url('matters/' . $matter->id));
    $trail->push('編集', action('MatterController@edit', $matter));
});


// トップ > タスク一覧
Breadcrumbs::for('tasks', function ($trail) {
    $trail->parent('posts');
    $trail->push('タスク一覧', url('tasks'));
});
// トップ > タスク一覧 > タイトル
Breadcrumbs::for('tasks-show', function ($trail, $task) {
    $trail->parent('posts');
    $trail->push('タスク一覧', url('tasks'));
    $trail->push($task->title, url('tasks, $task->id'));
});
// トップ > タスク一覧 > 新規登録
Breadcrumbs::for('tasks-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('タスク一覧', url('tasks'));
    $trail->push('タスク追加', url('tasks/create'));
});
// トップ > タスク一覧 > タイトル > 編集
Breadcrumbs::for('tasks-edit', function ($trail, $task) {
    $trail->parent('posts');
    $trail->push('タスク一覧', url('tasks'));
    $trail->push($task->title, url('tasks/' . $task->id));
    $trail->push('編集', action('TaskController@edit', $task));
});


// トップ > メンバー一覧
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('posts');
    $trail->push('メンバー一覧', url('users'));
});
// トップ > メンバー一覧 > タイトル
Breadcrumbs::for('users-show', function ($trail, $user) {
    $trail->parent('posts');
    $trail->push('メンバー一覧', url('users'));
    $trail->push($user->name, url('users, $user->id'));
});
// トップ > メンバー一覧 > タイトル > 編集
Breadcrumbs::for('users-edit', function ($trail, $user) {
    $trail->parent('posts');
    $trail->push('メンバー一覧', url('users'));
    $trail->push($user->name, url('users/' . $user->id));
    $trail->push('編集', action('UserController@edit', $user));
});


// トップ > ファイル一覧
Breadcrumbs::for('files', function ($trail) {
    $trail->parent('posts');
    $trail->push('ファイル一覧', url('files'));
});
// トップ > ファイル一覧 > 新規ファイルアップロード
Breadcrumbs::for('files-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('ファイル一覧', url('files'));
    $trail->push('新規ファイルアップロード', url('files/create'));
});

// トップ > コンテンツ作成スケジュール
Breadcrumbs::for('contents', function ($trail) {
    $trail->parent('posts');
    $trail->push('コンテンツ作成スケジュール', url('contents'));
});

// トップ > コンテンツ進捗管理表
Breadcrumbs::for('progresses', function ($trail) {
    $trail->parent('posts');
    $trail->push('コンテンツ進捗管理表', url('progresses'));
});
// トップ > コンテンツ進捗管理表 > 新規登録
Breadcrumbs::for('progresses-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('コンテンツ進捗管理表', url('progresses'));
    $trail->push('新規登録', url('progresses/create'));
});
// トップ > コンテンツ進捗管理表 > 詳細
Breadcrumbs::for('progresses-show', function ($trail, $progress) {
    $trail->parent('posts');
    $trail->push('コンテンツ進捗管理表', url('progresses'));
    $trail->push($progress->id . '：' .$progress->measures, url('progresses/' . $progress->id));
});
// トップ > コンテンツ進捗管理表 > タイトル > 編集
Breadcrumbs::for('progresses-edit', function ($trail, $progress) {
    $trail->parent('posts');
    $trail->push('コンテンツ進捗管理表', url('progresses'));
    $trail->push($progress->id . '：' .$progress->measures, url('progresses/' . $progress->id));
    $trail->push('編集', action('ProgressController@edit', $progress));
});
// トップ > コンテンツ進捗管理表 > 編集
Breadcrumbs::for('progresses-edit_ajax', function ($trail, $progress) {
    $trail->parent('posts');
    $trail->push('コンテンツ進捗管理表', url('progresses'));
    $trail->push('担当者一括編集', action('ProgressController@edit_ajax', $progress));
});
