@extends('layouts.layout')

@section('content')
<div class="jumbotron" style="padding:20px;">
    <div class="container" >
        <h3>活動管理</h3>
    </div>
</div>
<div class="container" id="content" >        
    <table class="table">
        <thead>
            <tr>
                <th>活動名稱</th>
                <th>點數</th>
                <th>配給點數</th>
            </tr>
        </thead>
        <tbody data-link="row" class="rowlink">
            @foreach($activities as $activity )   
                <tr>
                    <td>{{{ $activity->Title }}}</td>
                    <td>
                        @if($activity->info != null)
                            {{{ $activity->info->point }}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                    @if($activity->info == null)
                    <a class="btn btn-small" href="{{ URL::to('activity/' . $activity->OID . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endif
                    </td>
                </tr>
            @endforeach                     
        </tbody>
    </table>
    {{$activities->links()}}
</div><!--/.container-->
@stop