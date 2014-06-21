@extends('layouts.layout')

@section('content')
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
	            <div class="panel-heading">得獎名單</div>
	            <div class="panel-body">
	            	@if($data['result'] != NULL || !isset($data['result']))
		            	@foreach ($data['result'] as $key => $value)
							<p>{{{ $value['name'] }}}<p>
							@foreach ($value['users'] as $key => $value)
								{{{ $value }}}<br>
							@endforeach
						@endforeach
					@else
						<p>名單尚未公布</p>
					@endif
	            </div>
	        </div>
		</div>	
	</div>
@stop