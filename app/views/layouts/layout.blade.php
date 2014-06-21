<html>
    <head>
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('css/layout.css') }}
        {{ HTML::style('css/footer.css') }}
        {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
        <title>³éª„Ïµ½y</title>
    </head>
    <body>
        @include('layouts.topbar')
        <div id="content">
            <div class="row">
                <div>
                    @yield('content')
                </div>
            </div>
        </div><!--/.container-->

        @include('layouts.footer')
    </body>
</html>