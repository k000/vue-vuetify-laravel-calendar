<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    public function store(Request $request){

        $note = new Note();

        $note->event = $request->bui;
        $note->day = $request->day;
        $note->place = $request->place;
        $note->memo = $request->memo;
        $note->datas = json_encode($request->datas);
        $note->user_id = 1;

        $note->save();

    }

    public function getData(Request $request){


        $notes = Note::select('event as name','day as start','place as place','memo as memo','datas','id')
                ->where('day','like',substr($request->month,0,7).'%')
                ->where('user_id','=','1')
                ->get();  

        if($notes){

            foreach($notes as $note){
                $note->datas = json_decode($note->datas);
            }

            return $notes;

        }else{
            return null;
        }

    }


    public function deleteNote(Request $request){
        
        $note = Note::where('id','=',$request->id)
            ->where('user_id','=','1')
            ->first();

        if($note) 
            $note->delete();
        else
            return null;

    }

    public function updateNote(Request $request){

        $note = Note::where('id', '=' , $request->id)
            ->where('user_id','=','1')
            ->first();

        \Log::debug($note);

        if($note)
            $note->update([
                'event' => $request->bui,
                'place' => $request->place,
                'memo' => $request->memo,
                'datas' => json_encode($request->datas),
            ]);
        else
            return null; 
        
    }

    /*
        $note->event = $request->bui;
        $note->day = $request->day;
        $note->place = $request->place;
        $note->memo = $request->memo;
        $note->datas = json_encode($request->datas);
        $note->user_id = 1;
    */


}
