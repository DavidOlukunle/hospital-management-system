<?php

namespace App\Http\Controllers;


use App\Models\Docs;
use App\Models\Appointments;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index(){
        $docs=Docs::get();
        return view('home',compact('docs'));
    }
    public function appointments(){
        $user_id=auth()->user()->id;
        $docs=Docs::get();
        $appoints=Appointments::where('user_id',$user_id)->get();
        return view('appointments',compact('docs','appoints'));
    }

    public function createAppointment(Request $request){
      
        $formField=$request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'number'=>['required'],
            'doctor'=>['required'],
            'date'=>['required'],
            'message'=>['required'],
           
           
        ]);
       
        $formField['status']='in progress';
           $formField['user_id']=auth()->id();
        Appointments::create($formField);
         
        return redirect('/appointments')->with('messaage','Appointment created successfully!');
    }

    public function deleteAppointment($id){
       $appointment=Appointments::where('id',$id);
       $appointment->delete();
        return redirect('/appointments');
    }
}
