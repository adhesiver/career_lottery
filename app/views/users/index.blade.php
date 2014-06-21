@extends('layouts.layout')

@section('content')

<div class="container">
	<div class="col-md-6">
		<div class="panel panel-default">
            <div class="panel-heading"><h4>參與抽獎</h4></div>
            <div class="panel-body">
            	@if(Auth::user()->belongLottery->count() == 0)
					<p>尚未參加任何抽獎</p>
				@else
            	<table class="table">
					<thead>
						<tr>
							<th>抽獎名稱</th>
							<th>消耗點數</th>
						</tr>
					</thead>
					<tbody>
						@foreach(Auth::user()->belongLottery as $lottery)
						<tr>				
							<td>{{$lottery->lottery_name}}</td>
							<td>{{$lottery->consume_point}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
            </div>
        </div>				
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>參與活動</h4></div>
			<div class="panel-body">
				@if(Auth::user()->belongActivity->count() == 0)
					<p>尚未參加任何活動</p>
				@else
				<table class="table">
					<thead>
						<tr>
							<th>活動名稱</th>
							<th>獲得點數</th>
						</tr>
					</thead>
					<tbody>
						@foreach (Auth::user()->belongActivity as $activity)
							<tr>
								<td>{{$activity->Name}}</td>
								<td>{{$activity->point}}</td>
							</tr>
						@endforeach				
					</tbody>
				</table>
				@endif
			</div>	
		</div>	
	</div>
</div>
@stop