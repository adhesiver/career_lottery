@extends('layouts.layout')

@section('content')

<div class="container">
    @if(Auth::check() && Auth::user()->isManager())
    <div class="col-md-6">
    @else
    <div class="col-md-6 col-md-offset-3">
    @endif
        <h1>{{$data['lottery']->lottery_name}}</h1>
        <div class="panel panel-default">
            <div class="panel-heading">需要點數</div>
            <div class="panel-body">{{$data['lottery']->consume_point}}</div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">報名開始時間</div>
             <div class="panel-body">{{$data['lottery']->start_time}}</div>
        </div>
        <div class="panel panel-default">
             <div class="panel-heading">報名結束時間</div>
             <div class="panel-body">{{$data['lottery']->end_time}}</div>
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">公布抽獎時間</div>
              <div class="panel-body">{{$data['lottery']->announce_time}}</div>
        </div>
        <div class="panel panel-default">
              <div class="panel-heading">詳細資訊</div>
              <div class="panel-body">{{$data['lottery']->details}}</div>
        </div>    
    </div>
  @if(Auth::check() && Auth::user()->isManager())
	<div class="col-md-6">    
        <div class="panel panel-default">
            <div class="panel-heading">報名者名單</div>
            <div class="panel-body">
                @foreach($data['lottery']->lattendants as $lattendant)
                <p>{{$lattendant->StuID}} {{$lattendant->Name}}</p>
                @endforeach
          </div>
        </div>
  </div>
  @endif
  
</div>

@stop