<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shumoku;
use Auth;

class ShumokuController extends Controller
{

    public function store(Request $request){

        $shumoku = new Shumoku();

        $shumoku->event = $request->event;
        $shumoku->user_id = Auth::id();

        $shumoku->save();

    }

    public function getData(Request $request){

        $masters = Shumoku::select('event as shumoku','id')
                ->where('user_id','=',Auth::id())
                ->get();

        if($masters){
            
            return $masters;

        }else{
            return null;
        }

    }


    public function deleteMaster(Request $request){

        $master = Shumoku::where('id','=',$request->id)
        ->where('user_id','=',Auth::id())
        ->first();

        if($master) 
            $master->delete();
        else
            return null;
        }

}
