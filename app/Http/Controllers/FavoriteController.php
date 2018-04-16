<?php

namespace App\Http\Controllers;

use DB;
use App\Reply;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
      return $this->middleware(['auth']);
    }

    public function store(Request $request, Reply $reply)
    {
       DB::table('favorites')->insert([
        'user_id' => auth()->id(),
        'favorited_id' => $reply->id,
        'favorited_type' => get_class($reply)
      ]);
    }
}
