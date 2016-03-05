<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NestedCommentsController extends Controller
{
    //


    public function destroy($id)
    {
        dd($id);

        //dd("TUKA");

        //$drug = Drug::find($id);

        $comment = NestedComment::where('id', '=', $id);

        $comment->delete();

        return redirect('show');
    }
}
