<div class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::route('lottery.index')}}"></a>
    </div>
    
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      @if(Auth::check() && !Auth::user()->isManager())
        <li><a href="{{URL::route('user.index')}}">個人管理</a></li>
      @endif
      @if(Auth::check() && Auth::user()->isManager())
        <li><a href="{{URL::route('activity.index')}}">活動管理</a></li>
      @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check() && !Auth::user()->isManager())
            <li><a href="#">points：{{Auth::user()->rule->point}}</a></li>
            <li><a href="{{URL::to('logout')}}">登出</a></li>
        @elseif(Auth::check())
            <li><a href="{{URL::to('logout')}}">登出</a></li>
          </ul>
        @else
        <li><a href="{{URL::to('admin_login')}}">管理員專區</a></li>
        <li><a href="{{URL::to('login')}}">登入</a></li>
        @endif
      </ul>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->
