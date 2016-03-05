@extends('app')

@section('content')


    @if($drugs==[])
        <h2>You haven't got created drugs yet.</h2>
    @else
        <table class="table table-responsive">
            <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Delete</th>
            <th>Edit</th>
            </thead>
            <tbody>
            @foreach($drugs as $drug)
                {!! Form::open(array('url' => 'drugs/' . $drug[3], 'method' => 'DELETE')) !!}
                <tr>
                    @for($i = 0; $i < 3; $i++)
                        <td>{{$drug[$i]}} </td>
                    @endfor
                    <td>
                        {!! Form::button('Delete', array(
                        'type' => 'submit',
                        'class'=> 'actions-line icon-trash btn btn-danger',
                        'onclick'=>'return confirm("Are you sure?")'
                        ))  !!}
                    </td>
                    <td>
                        <a class="btn btn-warning" href="drugs/{{$drug[3]}}/edit">Edit</a>
                    </td>
                </tr>
                {!! Form::close() !!}
            @endforeach
            </tbody>
        </table>
    @endif


@stop

