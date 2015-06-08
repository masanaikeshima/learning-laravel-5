<!doctype html>
<html lang="en">
<head>
    <title>Template</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <!-- use the elixir function to automatically update the css being referenced -->
    <link rel="stylesheet" href=".{{ elixir('css/all.css')  }}" >
</head>
<body>

    @include('resources._nav')

    <div class="container">

        <?php /*
        @include('partials._flash')
        */ ?>

        @include('flash::message')

        @yield('content')
    </div>

    <script type="text/javascript" src="/learning-laravel-5/public/build/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/learning-laravel-5/public/build/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    @yield('footer')

    <script>
        $('#flash-overlay-modal').modal();
        // $('div.alert').not('alert-important').delay(3000).slideUp(300);
    </script>
</body>
</html>
