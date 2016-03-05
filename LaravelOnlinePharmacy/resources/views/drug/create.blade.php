@extends('app')

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js"></script>
</head>

@section('content')

    <h1 class="bojaLek text-right dole">Enter the drugs which you are going to deliver</h1>

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/drugs') }}">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label bojaLek">Name</label>

            <div class="col-md-6">
                {!! Form::select('name', $drugs, null, ['id' => 'drugs_list', 'class' => 'form-control']) !!}
                        <!-- <input type="text" class="form-control" name="name" value="{{ old('name') }}"> -->

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label bojaLek">Description</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="desc" id="desc" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label bojaLek">Image URL:</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="img_url" id="img_url" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group{{ $errors->has('drug_price') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label bojaLek">Drug Price</label>

            <div class="col-md-6">
                <input type="number" class="form-control" name="drug_price" id="drug_price" value="{{ old('name') }}">

                @if ($errors->has('drug_price'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('drug_price') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('delivery_price') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label bojaLek">Delivery Price</label>

            <div class="col-md-6">
                <input type="number" class="form-control" name="delivery_price" value="{{ old('name') }}">

                @if ($errors->has('delivery_price'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('delivery_price') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class=" btn btn-success pull-right">
                    <i class="glyphicon glyphicon-plus-sign"></i>Post
                </button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        $('#drugs_list').select2({
            tags: true,

        });
    </script>

    <script>
        $( "#drugs_list" ).change(function() {
            $( "select option:selected" ).each(function() {
                str = $( this ).val();

                $.get( "price/" + str, function( data ) {
                    //alert( "Data Loaded: " + data['cena'] );
                    document.getElementById("drug_price").value = data['cena'];
                    document.getElementById("desc").value = data['opis'];
                    document.getElementById("img_url").value = data['img_url'];;

                    if(data['cena'] != ""){
                        $('#drug_price').prop('readonly', true);
                        $('#desc').prop('readonly', true);
                        $('#img_url').prop('readonly', true);
                    }
                    else if(data['opis'] != ""){
                        $('#drug_price').prop('readonly', false);

                        $('#desc').prop('readonly', true);
                        $('#img_url').prop('readonly', true);
                    }
                    else{
                        $('#drug_price').prop('readonly', false);
                        $('#desc').prop('readonly', false);
                    }
                });
            });
        });
    </script>
@stop