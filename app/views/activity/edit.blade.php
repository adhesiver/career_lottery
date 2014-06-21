@extends('layouts.layout')

@section('content')
<head>
        {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
        {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script('jquery/jquery-1.11.0.min.js') }}
        <script>
            //全選
            $(document).ready(function() {
                 $("#selecctall").on("click", function () {
                    $('.checkbox1:input:checkbox').not(this).prop('checked', this.checked);
                 });               
            });
        </script> 
</head>

<div class="container">
    <div class="col-md-12">
    	{{ Form::open(array('route' => array('activity.update',$data['activity']->OID),'method' => 'put'))}}
    	<div class="col-md-12">
    		<h3>{{ Form::label('activity_name','活動名稱:'.$data['activity']->Title)}}</h3>
    	</div>		
		<div class="col-md-3">
			{{ Form::label('point','設定點數')}}
			{{ Form::text('point',$data['activity']->point,array('class'=>'form-control'))}}
		</div>
		<div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>參加者</th>
                        <th><input type="checkbox" id="selecctall">全選</th>
                    </tr>
                </thead>
                <tbody data-link="row" class="rowlink">
                    @foreach ($data['activity']->attendants as $attendant)
                        <tr>
                            <td>{{ $attendant->Name }}</td>
                            <td>
                                <label class="checkbox-inline">                                     
                                    <input type="checkbox" class="checkbox1" name="atid[{{{$attendant->OID}}}]" value="1" > 
                                </label>
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            {{ Form::submit('edit',array('class' => 'btn' , 'onclick'=>'return confirm("送出後將無法再次送出該活動點數，確認送出？")')) }}
        </div>
		

		{{ Form::close()}}

		@foreach ($errors->all() as $message)
            {{ $message }}
        @endforeach
	</div>
</div>
@stop