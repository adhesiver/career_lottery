@extends('layouts.layout')

@section('content')
<head>
    {{ HTML::style('css/lottery.css') }}
</head>
<div class="jumbotron">
    <div class="container">
        <h1><strong>職涯發展中心 抽獎系統</strong></h1>
        @if(Auth::check() && Auth::user()->isManager())
        <p><a class="btn btn-info btn-lg pull-right" href="{{ URL::route('lottery.create') }}">新增抽獎</a></p>
        @endif
    </div>
</div>
<div class="container" id="content">        
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>抽獎活動</th>
                    <th>開始報名時間</th>
                    <th>結束報名時間</th>
                    <th>消耗點數</th>
                    <th>公布時間</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody data-link="row" class="rowlink">
            @if($lotteries->count() > 0)
                @foreach($lotteries as $lottery )   
                    <tr>
                        <td><a href="{{ URL::to('lottery/' . $lottery->id) }}">{{ $lottery->lottery_name }}</a></td>
                        <td>{{ $lottery->start_time }}</td>
                        <td>{{ $lottery->end_time }}</td>
                        <td>{{ $lottery->consume_point }}</td>
                        <td>{{ $lottery->announce_time }}</td>                       
                        <td>
                            @if(!Auth::check() || Auth::user()->isManager() )
                                @if(strtotime($lottery->start_time)>time())
                                    <span class="label label-default">尚未開始</span>
                                @elseif(strtotime($lottery->end_time)<time())
                                    <span class="label label-default">已截止</span>
                                @else
                                    <span class="label label-info">開放報名中</span>
                                @endif
                            @else
                                @if(strtotime($lottery->start_time)>time())
                                    <span class="label label-default">尚未開始</span>
                                @elseif(Auth::user()->isJoin($lottery->id))
                                    <span class="label label-default">已報名</span>
                                @else
                                    @if(strtotime($lottery->end_time)<time())
                                        <span class="label label-default">已截止</span>
                                    @else
                                        @if((Auth::user()->rule != null) && $lottery->consume_point > Auth::user()->rule->point)
                                            <span class="label label-Warning">點數不足</span>
                                        @else
                                            <a class="label label-info" href="{{ URL::to('joinlottery', array('id'=>$lottery->id)) }}" onclick='return confirm("報名後將扣除點數，確認參加？")'>報名參加</a>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($lottery->is_draw == 1)
                            <a href="{{ URL::to('showResult/'. $lottery->id) }}">得獎名單</a>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->isManager())
                        <td>
                            <a class="btn btn-small" href="{{ URL::to('lottery/' . $lottery->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
                            <p>
                                {{ Form::open(array('route' => array('lottery.destroy',$lottery->id),'onclick'=>'return confirm("確定刪除？")')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <button type="submit" class="btn"><span class="glyphicon glyphicon-remove"></span></button>
                                {{ Form::close() }}
                            </p>
                        </td>
                        @endif                        
                        <td>
                            @if(Auth::check() && Auth::user()->isManager() && strtotime($lottery->end_time)<time() && $lottery->is_draw == 0)
                            <a class="btn" href="{{ URL::to('dodolottery', array('id'=>$lottery->id)) }}" onclick='return confirm("確定開獎？")'>開獎</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td>尚沒有任何抽獎活動</td></tr>
            @endif                     
            </tbody>
        </table>
        {{$lotteries->links()}}
    </div>
</div><!--/.container-->

@stop