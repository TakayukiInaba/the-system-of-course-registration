﻿@extends('layouts.main')

@section('title','$message')
@section('content')
<div class="conttainer">
<div class="row justify-content-center">
    <h3>削除が完了しました。</h3>
</div>
<br>
<div class='row justify-content-center'>
    <div class="col-2">
        <a class="btn btn-secondary btn-block" role="button" href="{{route('teacher.top')}}" >トップページへ戻る</a>
    </div>
</div>
</div>
@endsection