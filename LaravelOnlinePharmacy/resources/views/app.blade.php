<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Drug Service</title>
    <!-- Add any other metadata here -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('myNewCss.css')  }}">
   
</head>

<body>
    @include('partials.navbar')
<div class="container">


    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

    <script type="text/javascript">
        $('#flash-overlay-modal').modal();
        //$('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>

    <script rel="stylesheet" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

    <div class="row">
        <div class="col-sm-10">
            @yield('content')
        </div>

        <div class="col-sm-2">
            @yield('right-menu')
        </div>
    </div>
</div>

</body>
</html>