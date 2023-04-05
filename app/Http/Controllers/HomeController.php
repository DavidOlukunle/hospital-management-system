<?php

namespace App\Http\Controllers;


use App\Models\Doctor;
use App\Models\Appointments;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index() {
        $docs = Doctor::all();
        return view('home', compact('docs'));
    }

    public function appointments() {
        $user_id = auth()->user()->id;
        $docs = Doctor::all();
        $appointments = Appointments::where('user_id', $user_id)->get();
        return view('appointments', compact('docs', 'appointments'));
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
        Appointments::create($formField);
         
        return redirect('/appointments')->with('messaage', 'Appointment created successfully!');
    }

    public function deleteAppointment($id) {
        
        try{
            Appointments::where('id', $id)->delete();
        }

        catch (\Exception $e){
            throw new \Exception('message', 'Delete action not carried out');
        }
      
        return redirect('/appointments');
    }
}
