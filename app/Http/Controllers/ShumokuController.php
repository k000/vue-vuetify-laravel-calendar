<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shumoku;

class ShumokuController extends Controller
{

    public function store(Request $request){

        $shumoku = new Shumoku();

        $shumoku->event = $request->event;
        $shumoku->user_id = 1;

        $shumoku->save();

    }

    public function getData(Request $request){

        $masters = Shumoku::select('event as shumoku','id')
                ->where('user_id','=','1')
                ->get();

        if($masters){
            
            return $masters;

        }else{
            return null;
        }

    }


    public function deleteMaster(Request $request){

        $master = Shumoku::where('id','=',$request->id)
        ->where('user_id','=','1')
        ->first();

        if($master) 
            $master->delete();
        else
            return null;
        }

}
