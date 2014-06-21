@extends('layouts.layout')

@section('content')
<div class="jumbotron" style="padding:20px;">
    <div class="container" >
        <h3 style="font-family:微軟正黑體;">管理員登入</h3>
    </div>
</div>
<div class="container">        
    <div class="row">
        <div>
            {{ Form::open(array('action' => 'HomeController@admin_login', 'style' => 'max-width: 330px;')) }}

            <div class="form-group">
                {{ Form::label('account', '帳號:') }}
                {{ Form::text('account', '', array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', '密碼:') }}
                {{ Form::password('password',  array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::submit('登入', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
            @foreach ($errors->all() as $message)
                {{ $message }}
            @endforeach
        </div>
    </div>
</div><!--/.container-->

@stop