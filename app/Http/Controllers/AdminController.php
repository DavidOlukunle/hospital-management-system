<?php

namespace App\Http\Controllers;
use App\Models\Docs;
use Illuminate\Http\Request;
use App\Models\Appointments;

class AdminController extends Controller
{
    public function index(){
        $appointments=Appointments::get();
        return view('Admin.home',compact('appointments'));
    }
    public function addDoctors(){
        return view('Admin.addDoctors');
    }

    public function store(Request $request){
        dd($request->file('Image'));
        $formFields=$request->validate([
            'name'=>['required'],
            'room_no'=>['required'],
            'doctor_no'=>['required'],
            'speciality'=>['required'],
            'Image'=>'required|mimes:jpg,png|max:5048'
            
            
        ]);

        if($request->hasFile('Image')){
            $formFields['Image']=$request->file('Image')->store('Images','public');
        }

            Docs::create($formFields);

            return redirect('Admin/home')->with('message','Doctor created succesfully');
    }

    public function showAppointments(){
        $appointments =Appointments::all();
        return view('Admin.showAppointments',compact('appointments'));
    }
     public function approve_appointment($id){
        $appointment=Appointments::where('id',$id);
       
        $appointment->update(['status'=>'approved']);

        return redirect('/showAppointments');
     
    }
    public function cancel_appointment($id){
        $appointment=Appointments::where('id',$id);
        $appointment->update(['status'=>'canceled']);
        return redirect('/showAppointments');
    }

    public function show_doctors(){
        $appointments=Appointments::get();
        $docs=Docs::get();
        return view('Admin.view_all_doctors',compact('appointments','docs'));
    }
    public function delete_doctor($id){
        $doctor=Docs::where('id',$id);
        $doctor->delete();
        return redirect('/view_all_doctors');
    }
   public function edit_page($id){
    return view('Admin.edit_doctor')->with('docs', Docs::where('id',$id)->first());
   }
  public function update_doctor(request $request, $id){
    $formFields=$request->validate([
        'name'=>'required',
        'room_no'=>'required',
        'doctor_no'=>'required',
        'speciality'=>'required',
    ]);
    if($request->hasFile('Image')){
        $formFields['Image']=$request->file('Image')->store('Images','public');
    }
    Docs::where('id',$id)->update($formFields);
    
    return redirect('/view_all_doctors');
  }
  
}