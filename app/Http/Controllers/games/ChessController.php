<?php

namespace App\Http\Controllers\games;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChessController extends Controller
{
    function stockfish(Request $request){
        $fen = $request->input('fen');
        $time = microtime(1);
        $cwd='D:\ApacheServer\gameworld\stockfish\Windows';
        $sf  = 'stockfish';
        $thinking_time = 2000;

        $descriptorspec = array(
        0 => array("pipe","r"),
        1 => array("pipe","w"),
        ) ;
        $other_options = array('bypass_shell' => 'true');
        $process = proc_open($sf, $descriptorspec, $pipes, $cwd, null, $other_options) ;
        if (is_resource($process)) {
            fwrite($pipes[0], "uci\n");
            fwrite($pipes[0], "ucinewgame\n");
            fwrite($pipes[0], "isready\n");
            fwrite($pipes[0], "position fen $fen\n");
            fwrite($pipes[0], "go movetime $thinking_time\n");
            $str="";
            while(true){
                usleep(100);
                $s = fgets($pipes[1],4096);
                $str .= $s;
                //echo $s;
                if(strpos(' '.$s,'bestmove')){
                    break;
                }
            }
            #echo $s;
            $teile = explode(" ", $s);
            $zug = $teile[1];
            #echo $zug;
            $str = $zug;
            
            fclose($pipes[0]);
            fclose($pipes[1]);
            proc_close($process);
            return response()->json(['move' => $str],200);
        }
    }
}
