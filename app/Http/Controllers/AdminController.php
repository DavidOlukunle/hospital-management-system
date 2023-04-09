<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\updateSpecialist;

class AdminController extends Controller
{
    public function adminDashboard() {
        $appointments = Appointment::where('status',  'canceled')->get();
        return view('Admin.dashboard' ,   compact('appointments'));
    } 

    public function addSpecialist() {
        $appointments = Appointment::where('status', '=', 'in progress')->get();
        return view('Admin.add-specialist', compact('appointments'));
    }


    public function store(updateSpecialist $request) {

        if($request->hasFile('image')) {
            $newImage['image'] = $request->file('image')->store('image', 'public');
        }

        Specialist::create([
            'name' => $request->input('name'),
            'room_no' => $request->input('room_no') ,
            'doctor_no' => $request->input('doctor_no'),
            'image' => $newImage,
            'speciality' => $request->input('speciality'),
        ]);
      
            return redirect('/admin/dashboard')->with('message','Specialist created succesfully');
    }


    public function showAppointments() {
        $appointments = Appointment::where('status',  'in progress')->get();
        return view('Admin.showAppointments', compact('appointments'));
    }



     public function approveAppointment($uuid) {
        $appointment = Appointment::where('uuid', $uuid);
       
        $appointment->update(['status' => 'approved']);

        return redirect('/admin/showAppointments');
     
    }

    public function cancelAppointment($uuid) {
        $appointment = Appointment::where('uuid', $uuid);
        $appointment->update(['status' => 'canceled']);
        return redirect('admin/showAppointments');
    }

    public function showSpecialists() {
        $appointments = Appointment::all();
        $specialists = Specialist::all();
        return view('Admin.all-specialists', compact('appointments', 'specialists'));
    }

    public function deleteSpecialist(Specialist  $specialist) {

      $specialist->delete();

        return redirect('/admin/view_all_doctors/');
    }

   public function editPage($id) {
    return view('Admin.edit-specialist')->with('doctors', Specialist::where('id', $id)->first());
   } 

  public function updateSpecialist(updateSpecialist $request, $id) {
   
    if($request->hasFile('Image')) {
        
      $image['image'] = $request->file('Image')->store('Images', 'public');
    }

    Specialist::where('id', $id)->update([
        'name' => $request->input('name'),
        'room_no' => $request->input('room_no') ,
        'doctor_no' => $request->input('doctor_no'),
        'image' => $image,
        'speciality' => $request->input('speciality'),
    ]);
    
    return redirect('/view_all_doctors');
  }
  
}