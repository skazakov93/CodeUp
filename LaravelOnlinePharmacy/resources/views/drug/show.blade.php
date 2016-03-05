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
                    <h3><span>Pharmacy:</span> ЈАКА РАДОФИШ</h3>
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



                <div class="actionBox">





                    <!-- Comment -->
                    @foreach($commentsList as $comment)

                        <div class="media">
                            <a class="pull-left" href="#">
                                <div class="commenterImage">
                                    <img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" />
                                </div>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">by {{ $comment->comment->user->name }} {{ $comment->comment->user->lastname }}
                                    <small>{{ $comment->comment->created_at }}</small>
                                </h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ $comment->comment->desc }}
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>

                                <!-- Nested Comment -->
                                <span id="{{$comment->comment->id}}" class="sokri" >Reply</span>

                                @foreach($nestedComment as $ns)
                                    @if(($ns->comment_id)==($comment->comment->id))
                                        <div class="media">
                                            <a class="pull-left" href="#" class="commenterImage">
                                                <div class="commenterImage">
                                                    <img class="media-object" src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" alt="">
                                                </div>
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">by {{ $ns->user->name }} {{ $ns->user->lastname }}
                                                    <small>{{ $ns->created_at }}</small>
                                                </h4>
                                                {{ $ns->desc }}
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







                </div>      <!-- actionbox ennds here -->

                <div class="row">
                    <div class="col-md-12 col-xs-12">

                        <div id="comentGroup">
                            <form role="form" method="POST" action="{{{ url("/drugs/$drugPharUser->id/comment") }}}">
                                {!! csrf_field() !!}

                                <input type="hidden" name="drug_phar_id" value="{{$drugPharUser->id}}">
                                <div class="form-group">

                                    <input type="text" name="comment_text"  class="form-control" placeholder="Your coment...">

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Post
                                    </button>
                                </div>

                            </form>
                        </div>  <!-- detailbox end here -->
                    </div>

                </div> <!-- detailbox end here -->

            </div>      <!-- row for coments end here -->

        </div>
    </div>
    <hr/>


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
@stop