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
    	{{ Form::open(array('route' => 'lottery.store'))}}
	    <div class="col-md-3">
			{{ Form::label('lottery_name','標題')}}
			{{ Form::text('lottery_name','',array('class'=>'form-control'))}}

			{{ Form::label('start_time','開始時間')}}
			<div class="form-group">
				<div class='input-group date' id="datetimepicker1" data-date-format="YYYY-MM-DD HH:mm:ss">					
					<input type='text' name="start_time" class="form-control" />
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
				</div>
			</div>

			{{ Form::label('end_time','結束時間')}}
			<div class="form-group">
				<div class='input-group date' name="end_time" id="datetimepicker2" data-date-format="YYYY-MM-DD HH:mm:ss">					
					<input type='text' name="end_time" class="form-control" />
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
				</div>
			</div>

			{{ Form::label('point','需要點數')}}
			{{ Form::text('point','',array('class'=>'form-control'))}}

			{{ Form::label('announce_time','公布時間')}}
			<div class="form-group">
				<div class='input-group date'  id='datetimepicker3' data-date-format="YYYY-MM-DD HH:mm:ss">					
					<input type='text' name='announce_time' class="form-control" />
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
				</div>
			</div>
			<script type="text/javascript">
				var numOfAward = 2;
				$(document).ready(function() {
					$('#addAwardBtn').click(function() {
						var html = '<label for="l' + numOfAward + '">獎項' + numOfAward + '</label>';
						html += '<input class="form-control" name="award_name[' + numOfAward + ']" type="text" value="">'
						html += '<label for="n' + numOfAward + '">人數' + numOfAward + '</label>';
						html += '<input class="form-control" name="num_of_people[' + numOfAward + ']" type="text" value="">';
						$('#awardsList').append(html);
						numOfAward++;
					});
				});
			</script>
			<div id="awardsList">
			<p>獎項設定</p>
				{{ Form::label('l1','獎項1')}}
	          	{{ Form::text('award_name[1]','',array('class'=>'form-control'))}}
	          	{{ Form::label('n1','人數1')}}
	          	{{ Form::text('num_of_people[1]','',array('class'=>'form-control'))}}
			</div>
			<div id="addAwardBtn" class="btn btn-default">Add Award</div>
			{{ Form::submit('create',array('class' => 'btn btn-small')) }}
		</div>
		<div class="col-md-9">

				<label>詳細資訊</label>
	            <textarea name="editor1" id="editor1" rows="10" cols="80">
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