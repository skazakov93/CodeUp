@extends('app')

@section('content')
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>

        .navbar-brand {
            font-size:1.8em;
        }



        #topContainer {

            height:400px;
            width:100%;
            background-size:cover;
        }

        #topRow {
            margin-top:100px;
            text-align:center;
        }

        #topRow h1 {
            font-size:300%;
        }



        .marginTop {
            margin-top:30px;
        }

        .center {
            text-align:center;
        }

        .title {
            margin-top:100px;
            font-size:300%;
        }


        .colorNav{
            color:black;


        }
        .linkNavbar{

            color:green;
        }

        body{
            background-image: url(http://hearthewindofchange.com/wp-content/uploads/2015/05/pills-234633_1280.jpg);
            background-size: 100%;
            background-repeat: no-repeat;
            background-color:#eaeaea;

        }
        .orange{
            color:green;
        }
        .naslov{
            font-size: 60px;
        }
        .prv{
            font-size: 30px;
        }
        .vtor{
            font-size: 50px;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar-collapse">



<div class="container contentContainer" id="topContainer">

    <div class="row ">

        <div class="col-md-10 col-md-offset- text-centar" id="topRow">

            <p class="marginTop orange text-center naslov">All medications in one place</p>

            <p class="lead prv " style="color:green">Find what you need, deliver if you want. <strong>Anytime</strong></p>

            <p class=" lead vtor" style="color:green" >Just <strong>Join our team</strong></p>



            <form class="marginTop">













            </form>



        </div>


    </div>

</div>


<div class="container" id="details">



</div>





<script>

    $(".contentContainer").css("min-height",$(window).height());


</script>
</body>
</html>
@stop