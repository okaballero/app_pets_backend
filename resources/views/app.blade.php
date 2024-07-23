<!DOCTYPE html>
<html>
    <head>
        <title> {{ (isset($title))?$title:'Rescate animal' }} </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container-fluid">
            @include('navbar')
            @yield('content')
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>