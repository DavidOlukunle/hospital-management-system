<?php

namespace App\Http\Controllers;


use App\Models\Specialist;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class HomeController extends Controller
{

    public function index() {
        $specialists = Specialist::all();
        return view('home', compact('specialists'));
    }

    public function appointments() {
        $user_id = auth()->user()->id;
        $specialists = Specialist::all();
        $appointments = Appointment::where('user_id', $user_id)->get();
        return view('appointments', compact('specialists', 'appointments'));
    }

    public function createAppointment(Request $request){
        $formField = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'number' => ['required'],
            'doctor' => ['required'],
            'date' => ['required'],
            'message' => ['required'],
        ]);
        $formField['status'] = 'in progress';
           $formField['user_id'] = auth()->id();
           $formField['uuid'] = str::uuid();
        Appointment::create($formField);
         
        return redirect('/appointments')->with('messaage', 'Appointment created successfully!');
    }

    public function deleteAppointment($id) {
        
        try{
            Appointment::where('id', $id)->delete();
        }

        catch (\Exception $e){
            throw new \Exception('message', 'Delete action not carried out');
        }
      
        return redirect('/appointments');
    }
}
