@extends('app')

@section('content')
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    </head>



    <script>
        $(document).ready(function() {
            $(".lista").hide();
            $('#lista').click(function(){
                $(".mreza").hide();
                $(".lista").show();


            });
            $('#mreza').click(function(){
                $(".lista").hide();
                $(".mreza").show();


            });

        });
    </script>

    <style>
        .lev{
            margin-left: 20px;
        }
        .visina{
            height: 145px;
            min-height: 145px;
        }
        .dolzina{
            height: 188px;
        }
        h1 { color: black; font-family: 'Trocchi', serif; font-size: 45px; font-weight: normal; line-height: 48px; margin: 0; }

        .h3m { color: green; font-family: 'Source Sans Pro', sans-serif; font-size: 20px; font-weight: 400; line-height: 1px; margin: 0 0 6px; }
        h3 > span { color:#808080; font-family: 'Source Sans Pro', sans-serif; font-size: 16px; font-weight: 400; line-height: 32px; margin: 0 0 24px; }
        .btnLike{
            margin-top: 12px;
        }

        .btn-order{
            width:79px;

        }
        .h2s{
            margin-top: 10px;
            font-size:27px;
        }
        .razdeleni{
            padding: 20px;

        }

    </style>


    <div class="container visina">
        <div class="well well-sm">
            <strong>Display</strong>
            <div class="btn-group">
                <a href="#" id="lista" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="mreza" class="btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-th"></span>Grid</a>
            </div>
        </div>

        @foreach($drugs as $drug)


            <div class="mreza">
                <div id="products" class=" list-group ">
                    <div class="item   col-xs-4 col-lg-4">
                        <div class="thumbnail">
                            <img class="group list-group-image " style="width:323px ; height:182px" src="{{ $drug->drugPharmacy->drug->img_url }}"  alt="" />
                            <br/>
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">
                                    {{$drug->drugPharmacy->drug->name}}</h4>

                                <p class="group inner list-group-item-text">
                                    @if($drug->drugPharmacy->drug->desc == "")
                                        No Description
                                    @endif
                                    @if($drug->drugPharmacy->drug->desc != "")
                                        {{$drug->drugPharmacy->drug->desc}}</p>
                                @endif
                                <div class="row">
                                    <div class="col-xs-10 col-md-5">
                                        <p class="lead " style="width:335px ; height:80px">
                                            Price :  ${{$drug->drugPharmacy->drug_price}}
                                            <br/>

                                            Delivery price: ${{$drug->delivery_price}}


                                        </p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <form class="form-horizontal {{$drug->id}}" role="form" method="POST" action="{{{ url("/drugs/$drug->id/like") }}}">
                                            {!! csrf_field() !!}

                                            <button type="submit" class="{{$drug->id}} sendBtn btn btn-md btn-success {{$disable}}">
                                                @if($drug->userVoted == 1)
                                                    <span class=""><i class="glyphicon glyphicon-thumbs-up"></i> <strong class="badge">{{$drug->numOfLikes}}</strong></span>
                                                @endif
                                                @if($drug->userVoted != 1)
                                                    <span class="{{$drug->id}}spanLike1"><i class="glyphicon glyphicon-thumbs-up"></i> {{$drug->numOfLikes}}</span>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-3">
                                        <form class="form-horizontal {{$drug->id}}dislike" role="form" method="POST" action="{{{ url("/drugs/$drug->id/dislike") }}}">
                                            {!! csrf_field() !!}

                                            <button type="submit" class="{{$drug->id}} sendDislike btn btn-md btn-danger {{$disable}}">
                                                @if($drug->userVoted == -1)
                                                    <i class="glyphicon glyphicon-thumbs-down"></i> <strong class="badge">{{$drug->numOfDislikes}}</strong>
                                                @endif
                                                @if($drug->userVoted != -1)
                                                    <span class="{{$drug->id}}spanDislike"><i class="glyphicon glyphicon-thumbs-down"></i> {{$drug->numOfDislikes}}
                                                @endif
                                            </button>
                                        </form>
                                    </div>





                                        <div class="col-sm-5 right pull-right">
                                            <a class="btn btn-primary" href="{{{ url("/drugs/$drug->id") }}}">More Details</a>
                                        </div>


                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
            <div class="lista">
                <div class="row razdeleni">
                    <div class="ramka">
                        <div class="col-md-4 col-xs-12">
                            <img class=img-responsive src="{{ $drug->drugPharmacy->drug->img_url }}">
                            <div class="row">
                                <div class="col-sm-3">
                                    <form  class="contactForm1 {{$drug->id}}" role="form" method="POST" action="{{{ url("/drugs/$drug->id/like") }}}">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="{{$drug->id}} sendBtn btn btn-md btn-success {{$disable}}">
                                            @if($drug->userVoted == 1)
                                                <span class=""><i class="glyphicon glyphicon-thumbs-up"></i> <strong class="badge">{{$drug->numOfLikes}}</strong></span>
                                            @endif
                                            @if($drug->userVoted != 1)
                                                <span class="{{$drug->id}}spanLike"><i class="glyphicon glyphicon-thumbs-up"></i> {{$drug->numOfLikes}}</span>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form class="form-horizontal {{$drug->id}}dislike" role="form" method="POST" action="{{{ url("/drugs/$drug->id/dislike") }}}">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="{{$drug->id}} sendDislike btn btn-md btn-danger {{$disable}}">
                                            @if($drug->userVoted == -1)
                                                <i class="glyphicon glyphicon-thumbs-down"></i> <strong class="badge">{{$drug->numOfDislikes}}</strong>
                                            @endif
                                            @if($drug->userVoted != -1)
                                                <span class="{{$drug->id}}spanDislike1"><i class="glyphicon glyphicon-thumbs-down"></i> {{$drug->numOfDislikes}}</span>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">

                            <h2 class="h2s">{{$drug->drugPharmacy->drug->name}}</h2>




                            <p>{{$drug->drugPharmacy->drug->desc}}</p>

                            <h3 class="h3m"><span>Price:</span> {{$drug->drugPharmacy->drug_price}}</h3>
                            <h3 class="h3m"><span>Delevery Price:</span> ${{$drug->delivery_price}}</h3>

                            <a class="btn btn-primary" href="{{{ url("/drugs/$drug->id") }}}">More Details</a>

                        </div>
                    </div>
                </div>



            </div>



        @endforeach
    </div>
    
    <script type="text/javascript">
		$('.sendBtn').click(function () {
			var frmId = $(this).attr("class");
			var myClasses = frmId.split(' '); 
			
			//alert(myClasses[0]);

			var frm = $('.' + myClasses[0]);
			//alert(frm + ";");

    		//var sel = $("#sodrzinaKom").val();

    		//alert(sel + "-");
    
    		frm.submit(function (ev) {
        		$.ajax({
            		type: frm.attr('method'),
            		url: frm.attr('action'),
            		data: frm.serialize(),
            
            		success: function (data) {
                		//alert(data + '- return');
            			if(data != "myNotOK"){
                			//alert("YES");
                			var brGlasovi = $('.' + myClasses[0] + "spanLike1").text();
                			//alert(brGlasovi + "=");
                			
                			brGlasovi++;
                			$('.' + myClasses[0] + "spanLike1").html('<i class="glyphicon glyphicon-thumbs-up"></i><strong class="badge">' + brGlasovi + '</strong>');
                			$('.' + myClasses[0] + "spanLike").html('<i class="glyphicon glyphicon-thumbs-up"></i><strong class="badge">' + brGlasovi + '</strong>');	
                		}
            		}
        	});

        	ev.preventDefault();
    	});
	})
</script>
    
    <script type="text/javascript">
		$('.sendDislike').click(function () {
			var frmId = $(this).attr("class");
			var myClasses = frmId.split(' '); 
			
			//alert(myClasses[0]);

			var frm = $('.' + myClasses[0] + "dislike");
			//alert(frm + ";");

    		//var sel = $("#sodrzinaKom").val();

    		//alert(sel + "-");
    
    		frm.submit(function (ev) {
        		$.ajax({
            		type: frm.attr('method'),
            		url: frm.attr('action'),
            		data: frm.serialize(),
            
            		success: function (data) {
                		//alert(data + '- return');
            			if(data != "myNotOK"){
                			//alert("YES");
                			var brGlasovi = $('.' + myClasses[0] + "spanDislike").text();
                			//alert(brGlasovi + "=");
                			
                			brGlasovi++;
                			$('.' + myClasses[0] + "spanDislike").html('<i class="glyphicon glyphicon-thumbs-up"></i><strong class="badge">' + brGlasovi + '</strong>');
                			$('.' + myClasses[0] + "spanDislike1").html('<i class="glyphicon glyphicon-thumbs-up"></i><strong class="badge">' + brGlasovi + '</strong>');
                		}
            		}
        	});

        	ev.preventDefault();
    	});
	})
</script>
@stop