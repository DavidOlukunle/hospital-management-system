<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <!-- ... -->
</head>
<body>




<form class="space-y-4 md:space-y-6" action="{{url('Admin/edit-specialist', $doctors->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div>
        <label for = "name" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
        <input type = "text" name = "name" id = "name" class = "bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doctor's name" required="" value = "{{$doctors->name}}" >
    </div>
    <div>
        <label for = "room no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">room no</label>
        <input type = "text" name = "room_no" id = "password" placeholder = "room no" class = "bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required ="" value = "{{$doctors->room_no}}" >
    </div>
    <div>
        
        <label for = "speciality" class= "block mb-2 text-sm font-medium text-gray-900 dark:text-white">speciality</label>
        <select name = "speciality" class = "bg-gray-5" >

            <option value = "{{$doctors->speciality}}">{{$doctors->speciality}}</option>

        <option value = "Pediatrician"> Pediatrician </option>

        <option value = "neurosogeon"> neurosogeon </option>

        <option value = "Cardiologist"> Cardiologist </option>

        <option value = "Pulmonologist"> Pulmonologist </option>

        <option value = "oncologist"> oncologist </option>

        </select>
    </div>

    <div>
        <label for = "doctor's number" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor's number</label>
        <input type = "text" name = "doctor_no" id = "password" placeholder = "Number" class = "bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required = "" value = "{{$doctors->doctor_no}}">
    </div>  
     
    <div>
        <label for = "Image" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
        <input type="file" name="Image" id="password" placeholder="Number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
      
    <button type = "submit" class = "w-full text-xl text-black bg-red-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
   
</form>
</body>