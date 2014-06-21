@extends('layouts.layout')

@section('content')

<head>
		{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}
		{{ HTML::script('jquery/jquery-1.11.0.min.js') }}
		{{ HTML::script('bootstrap/js/bootstrap.min.js') }}      
        {{ HTML::script('ckeditor/ckeditor.js') }}
        {{ HTML::script('moment/moment.js') }}       
        {{ HTML::script('datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
                $('#datetimepicker2').datetimepicker();
                $('#datetimepicker3').datetimepicker();
                $("#datetimepicker1").on("dp.change",function (e) {
                	$('#datetimepicker2').data("DateTimePicker").setMinDate(e.date);
            		});
           		
            	$("#datetimepicker2").on("dp.change",function (e) {
              		$('#datetimepicker1').data("DateTimePicker").setMaxDate(e.date);
           		});
           		$("#datetimepicker3").on("dp.change",function (e) {
              		$('#datetimepicker2').data("DateTimePicker").setMaxDate(e.date);
           		});
		    });
        </script>
</head>

<div class="container">
	<div class="row">
		{{ Form::open(array('route' => array('lottery.update', $data['lottery']->id),'method' => 'PUT'))}}
		<div class="col-md-3">
			{{ Form::label('lottery_name','標題')}}
			{{ Form::text('lottery_name',$data['lottery']->lottery_name,array('class'=>'form-control'))}}
			
			{{ Form::label('start_time','開始時間')}}
			<div class="form-group">
				<div class='input-group date' id="datetimepicker1" data-date-format="YYYY-MM-DD HH:mm:ss">					
					<input type='text' name="start_time" class="form-control" value="{{{$data['lottery']->start_time}}}"/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
				</div>
			</div>

			{{ Form::label('end_time','結束時間')}}
			<div class="form-group">
				<div class='input-group date' name="end_time" id="datetimepicker2" data-date-format="YYYY-MM-DD HH:mm:ss">					
					<input type='text' name="end_time" class="form-control" value="{{{$data['lottery']->end_time}}}"/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
				</div>
			</div>
			{{ Form::label('point','需要點數')}}
			{{ Form::text('point',$data['lottery']->consume_point,array('class'=>'form-control'))}}

			{{ Form::label('announce_time','公布時間')}}
			<div class="form-group">
				<div class='input-group date'  id='datetimepicker3' data-date-format="YYYY-MM-DD HH:mm:ss">					
					<input type='text' name='announce_time' class="form-control" value="{{{$data['lottery']->announce_time}}}"/>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
				</div>
			</div>
			<script type="text/javascript">
				var NumOfArr = '<?php print(count($data['lottery']->awards)+1); ?>';
				$(document).ready(function() {
					$('#addAwardBtn').click(function() {
						var html = '<label for="l' + NumOfArr + '">獎項' + NumOfArr + '</label>';
						html += '<input class="form-control" name="award_name[' + NumOfArr + ']" type="text" value="">'
						html += '<label for="n' + NumOfArr + '">人數' + NumOfArr + '</label>';
						html += '<input class="form-control" name="num_of_people[' + NumOfArr + ']" type="text" value="">';
						$('#awardsList').append(html);
						NumOfArr++;
					});
				});
			</script>
			<div id="awardsList">
				<p>獎項設定</p>
				<?php $a=1;?>
				@foreach ($data['lottery']->awards as $award)
					{{ Form::label('l'.$a,'獎項'.$a)}}
		          	{{ Form::text('award_name['.$a.']',$award->award_name,array('class'=>'form-control'))}}
		          	{{ Form::label('n1'.$a,'人數'.$a)}}
		          	{{ Form::text('num_of_people['.$a.']',$award->num_of_people,array('class'=>'form-control'))}}
		    	<?php $a++;?>
				@endforeach			
			</div>
			<div>
				<div id="addAwardBtn" class="btn btn-default">Add Award</div>			
				{{ Form::submit('edit',array('class' => 'btn btn-small')) }}
			</div>		
		</div>
		<div class="col-md-9">
			<label>詳細資訊</label>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
            {{$data['lottery']->details}}
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
		</div>
		{{ Form::close()}}
	</div>
</div>

@stop