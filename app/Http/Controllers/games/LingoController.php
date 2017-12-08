<?php

namespace App\Http\Controllers\games;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LingoDict;

class LingoController extends Controller
{
    public function randomWord(){
        $word = LingoDict::all()->random(1)[0];
        return response()->json($word,200);
    }

    public function checkWord(Request $request){
        $res = true;
        $req = $request;
        if(count(LingoDict::where('word',$request->input('guess'))->get())==0){
           $res = false;
        }
        return response()->json($res,200);
    }
}
