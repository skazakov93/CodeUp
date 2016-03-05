@extends('app')

@section('content')

    <h1>Edit the drug</h1>

    {!! Form::model($drug, ['method' => 'PATCH', 'url' => 'drugs/' . 8]) !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ $drugName }}" readonly>

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="desc" value="{{ $drugDesc }}" readonly>

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Image URL:</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="img_url" value="{{ $imgUrl }}" readonly>

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Drug Price</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="drug_price" value="{{$drugPrice }}" readonly>

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Delivery Price</label>

        <div class="col-md-6">
            <input type="number" class="form-control" name="delivery_price" value="{{ $drugDeliveryPrice }}">

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <input type="hidden" value="{{$dfu}}" name="dfu">

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-success">
                Update
            </button>
        </div>
    </div>

    {!! Form::close() !!}
@stop