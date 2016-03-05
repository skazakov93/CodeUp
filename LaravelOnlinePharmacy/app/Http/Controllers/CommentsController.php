<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

class CommentsController extends Controller
{
    //

    public function destroy($id)
    {

        //dd("TUKA");

        //$drug = Drug::find($id);

        $comment = Comment::where('id', '=', $id);

        $comment->delete();

        return redirect('show');
    }
}
