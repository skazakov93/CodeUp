@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <img class=img-responsive src="{{$drugPharUser->drugPharmacy->drug->img_url}}">
                <form class="form-horizontal btnProduckt" role="form" method="POST" action="{{{ url("/drugs/$drugPharUser->id/like") }}}">
                    {!! csrf_field() !!}

                    <button type="submit" class="btn btn-success {{$disabled}}">
                        <i class="glyphicon glyphicon-thumbs-up"></i> {{$numOfLikes}}
                    </button>
                </form>

                <form class="form-horizontal btnProduckt" role="form" method="POST" action="{{{ url("/drugs/$drugPharUser->id/dislike") }}}">
                    {!! csrf_field() !!}

                    <button type="submit" class="btn btn-danger {{$disabled}}">
                        <i class="glyphicon glyphicon-thumbs-down"></i> {{$numOfDislikes}}
                    </button>
                </form>
            </div>
            <div class="col-md-6 col-xs-12">
                <h1>{{$drugPharUser->drugPharmacy->drug->name}}</h1>
                @if($drugPharUser->drugPharmacy->pharmacy->name == "")
                    <h3><span>Pharmacy:</span> ЖИВА-ФАРМ</h3>
                @endif
                @if($drugPharUser->drugPharmacy->pharmacy->name != "")
                    <h3><span>Pharmacy:</span> {{ $drugPharUser->drugPharmacy->pharmacy->name }}</h3>
                @endif
                <h3><span>Delivery man:</span> {{$drugPharUser->user->name}}</h3>
                <div class="panel panel-default">
                    <div class="panel-heading">Description</div>
                    <div class="panel-body">{{$drugPharUser->drugPharmacy->drug->desc}}</div>
                </div>
                <h3><span>Price:</span> {{$drugPharUser->drugPharmacy->drug_price}}</h3>
                <h3><span>Delevery Price:</span> {{$drugPharUser->delivery_price}}</h3>
                <select class="form-control selectQuantity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="4">5</option>
                </select>
                <button class="btn btn-success btn-order">Order</button>
                <h2></h2>
            </div>
        </div>

    </div>
    <br/>
    <br/>

    <div class="row">
        <div class="col-md-7 ol-xs-12">
            <!-- coments start here -->
            <div class="detailBox">
                <div class="titleBox komentari">
                    <span class="bela"><span class="glyphicon glyphicon-pencil bela"></span ><strong> Comments</strong></span>
                </div>
                <div class="comentWarning">
                    <p class="taskDescription">Spam and insulting coments will be baned</p>
                </div>



               <!-- coments start here -->
    <div class="detailBox">

        <div class="actionBox">
            	<ul class="myComUl">

                @foreach($commentsList as $comment)
                   <div class="media">
                            <div class="commenterImage">
                            	<img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" />
                        	</div>
                            <div class="media-body">
                                <div class="commentText">
                            		<p class="">{{ $comment->comment->desc }}</p> <span class="username date sub-text">by {{ $comment->comment->user->name }} {{ $comment->comment->user->lastname }}</span> <span class="date sub-text"> {{ $comment->comment->created_at }}</span>
                        		</div>

                                <!-- Nested Comment -->
                                <span id="{{$comment->comment->id}}" class="sokri" >Reply</span>

                                @foreach($nestedComment as $ns)
                                    @if(($ns->comment_id)==($comment->comment->id))
                                        <div class="media">
                                            <div class="commenterImage">
                            					<img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" />
                        					</div>
                                            <div class="media-body">
                                                <div class="commentText">
                            						<p class="">{{ $ns->desc }}</p> <span class="username date sub-text">by {{ $ns->user->name }} {{ $ns->user->lastname }}</span> <span class="date sub-text"> {{ $ns->created_at }}</span>
                        						</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="{{$comment->comment->id}} koms" ><!-- End Nested Comment -->
                                    <form class="coment2" role="form" method="POST" action="{{ url("/drugs/myNested") }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="com_id" value="{{$comment->comment->id}}">
                                        <div class="form-group" style="padding-top: 10px;">
                                            <input type="hidden" name="drug_id" value="{{$drugPharUser->id}}">
                                            <input type="text" name="com_text" class="form-control" placeholder="Reply...">
                                        </div>
                                        <button type="submit" class="btn btn-success">Reply</button>
                                    </form>
                                </div>
                    </div>
					</div>
                @endforeach
			</ul>
            

        </div>      <!-- actionbox ennds here -->

        <div class="input-group" id="comentGroup">
            <form id="contactForm1" class="form-horizontal" role="form" method="POST" action="{{{ url("/drugs/$drugPharUser->id/comment") }}}">
                {!! csrf_field() !!}

                <input type="hidden" name="drug_phar_id" value="{{$drugPharUser->id}}">
                <input type="text" name="comment_text" id="sodrzinaKom" class="form-control" placeholder="Your coment...">
                <button id="sendBtn" type="submit" class="btn btn-default">
                    Send
                </button>
            </form>
        </div>  <!-- detailbox end here -->

    </div>      <!-- row for coments end here -->
        </div>
    </div>
    <hr/>

    <!-- Za sokrivanje na formite za reply na sekoj komentar -->
    <script>
        $(function(){
            $(".koms").hide();
            $(".sokri").show();
            $(".sokri").click(function(){
                var clickedID = $(this).attr('id');
                //alert(clickedID);
                $('.' + clickedID).show();
            });
        });
    </script>
    
    <!-- za sokrivanje na formite za reply, na novite komentari zemene na -->
    <!-- interval od nekolku sekundi (3 sekundi) -->
    <script>
		$(document).on('click', ".sokri", function () {
            //alert("klik na Reply");
			$(".koms").hide();
            $(".sokri").show();

            var clickedID = $(this).attr('id');
            //alert(clickedID);

            $('.' + clickedID).show();

        });
    </script>
    
    <!-- za postiranje na nov komentar -->
    <script type="text/javascript">
		$('#sendBtn').click(function () {
			var frm = $('#contactForm1');

    		//var sel = $("#sodrzinaKom").val();

    		frm.unbind('submit').submit(function (ev) {
        		$.ajax({
            		type: frm.attr('method'),
            		url: frm.attr('action'),
            		data: frm.serialize(),
            
            		success: function (data) {
                		//$(".actionBox ul").append('<div class="media"><div class="commenterImage"><img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" /></div><div class="media-body"><div class="commentText"> <p class="">' + data['komentar'] + '</p> <span class="username date sub-text">by ' + data['imeP'] + ' ' + data['prezimeP'] + '</span> <span class="date sub-text">' + data['timeCom'] + '</span></div></div></div>');
            			
                	}
        	});

        	$("#sodrzinaKom").val('');

        	ev.preventDefault();
    		});
		})
	</script>
	
	
    <!-- za zemanje na novi komentari -->
    <script>

    	var lastComId = {{ $imaKom }};

		//alert("=" + lastComId);
    
		$(document).ready(function(){
			//alert(lastComId + "-");
			
        	$.get('/api/drugs/' + {{$drugPharUser->id}} + '/' + lastComId, function(data) {
            	//alert( "Data Loaded: " + data[0].id);

				if(data.length >= 2){
					for(i = 0; i < data.length - 1; i += 2){
						//alert(data[i].user.name);
						lastComId = data[i].id;
            		
						$(".myComUl").append('<div class="media"><div class="commenterImage"><img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" /></div><div class="media-body"><div class="commentText"><p class="">' + data[i].desc + '</p><span class="username date sub-text">by' + data[i].user.name + ' ' + data[i].user.lastname + '</span> <span class="date sub-text">' + data[i].created_at + '</span></div><!-- Nested Comment --><span id="' + data[i].id + '" class="sokri" >Reply</span><div class="' + data[i].id + ' koms" ><!-- End Nested Comment --><form class="coment2" role="form" method="POST" action="{{ url("/drugs/myNested") }}">{!! csrf_field() !!}<input type="hidden" name="com_id" value=' + data[i].id + '><div class="form-group" style="padding-top: 10px;"><input type="hidden" name="drug_id" value="{{$drugPharUser->id}}"><input type="text" name="com_text" class="form-control" placeholder="Reply..."></div><button type="submit" class="btn btn-success">Reply</button></form></div></div></div>');

						$('.' + data[i].id).hide();
						//$(".sokri").show();
					}
				}				
        	});

        	setTimeout(arguments.callee, 3000);
		});
	</script>
	
	<script>
		$(document).on('click', "sendBtn", function () {
			var frm = $('#contactForm1');

    		//var sel = $("#sodrzinaKom").val();

    		//alert(sel + "-");
    
    		frm.unbind('submit').submit(function (ev) {
        		$.ajax({
            		type: frm.attr('method'),
            		url: frm.attr('action'),
            		data: frm.serialize(),
            
            		success: function (data) {
                		//$(".actionBox ul").append('<div class="media"><div class="commenterImage"><img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" /></div><div class="media-body"><div class="commentText"> <p class="">' + data['komentar'] + '</p> <span class="username date sub-text">by ' + data['imeP'] + ' ' + data['prezimeP'] + '</span> <span class="date sub-text">' + data['timeCom'] + '</span></div></div></div>');
            		}
        	});

        	ev.preventDefault();
    		});
    </script>
@stop