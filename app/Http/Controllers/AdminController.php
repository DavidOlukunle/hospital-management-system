<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctors;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Appointments;

class AdminController extends Controller
{
    public function adminDashboard() {
        $appointments = Appointments::where('status', '=', 'in progress')->get();
        return view('Admin.dashboard',  compact('appointments'));
    } 

    public function addDoctors() {
        $appointments = Appointments::where('status', '=', 'in progress')->get();
        return view('Admin.addDoctors', compact('appointments'));
    }


    public function store(StoreDoctors $request) {

        $newImageName = uniqid(). '-' . $request->title . '-' .
        $request->Image->extension();
        $request->Image->move(public_path('image'), $newImageName);

        Doctor::create([
            'name' => $request->input('name'),
            'room_no' => $request->input('room_no') ,
            'doctor_no' => $request->input('doctor_no'),
            'Image' => $newImageName,
            'speciality' => $request->input('speciality'),
        ]);
      
            return redirect('/Admin/dashboard')->with('message','Doctor created succesfully');
    }


    public function showAppointments() {
        $appointments = Appointments::where('status', '=', 'in progress')->get();
        return view('Admin.showAppointments', compact('appointments'));
    }

    

    // public function performApointmentAction($action, $id) {
    //     $statuses = [
    //         'approve' => 'approved',
    //         'cancel' => 'canceled',
    //     ];
        
    //     if(array_key_exists($action, $statuses)){
    //         $appointment = Appointments::where('id', $id);

    //         $appointment->update(['status' => $statuses[$action]]);
    //     }
    // }
     public function approveAppointment($id) {
        $appointment = Appointments::where('id', $id);
       
        $appointment->update(['status' => 'approved']);

        return redirect('/showAppointments');
     
    }

    public function cancelAppointment($id) {
        $appointment = Appointments::where('id', $id);
        $appointment->update(['status' => 'canceled']);
        return redirect('/showAppointments');
    }

    public function showDoctors() {
        $appointments = Appointments::all();
        $docs = Doctor::all();
        return view('Admin.view_all_doctors', compact('appointments', 'docs'));
    }

    public function deleteDoctor(Doctor $doctor) {

       $doctor->delete();

        return redirect('/view_all_doctors');
    }

   public function editPage($id) {
    return view('Admin.edit_doctor')->with('docs', Doctor::where('id', $id)->first());
   } 

  public function updateDoctor(request $request, $id) {
    $formFields = $request->validate([
        'name' => 'required',
        'room_no' => 'required',
        'doctor_no' => 'required',
        'speciality' => 'required',
    ]);
    if($request->hasFile('Image')) {
        $formFields['Image'] = 
        
        $request->file('Image')->store('Images','public');
    }
    Doctor::where('id', $id)->update($formFields);
    
    return redirect('/view_all_doctors');
  }
  
}