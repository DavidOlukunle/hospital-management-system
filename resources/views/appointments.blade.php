<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <!-- ... -->
</head>
<body>

    <h4>
        @if(session()->has('message'))
{{session()->get('message')}}
@endif
    </h4>
    
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Doctor Name
                </th>
                <th scope="col" class="px-6 py-3">
                    message
                </th>
                <th scope="col" class="px-6 py-3">
                    date
                </th>
                <th scope="col" class="px-6 py-3">
                    status
                </th>
                <th scope="col" class="px-6 py-3">Cancel Appointment</th>
            </tr>
        </thead>
        <tbody>

            @foreach($appointments as $appointment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{$appointment->doctor}}
                </th>
                <td class="px-6 py-4">
                   {{$appointment->message}}
                </td>
                <td class="px-6 py-4">
                    {{$appointment->date}}
                </td>
                <td class="px-6 py-4">
                   {{$appointment->status}}
                </td>

                <td><a class="bg-red-600" onclick="return confirm('are you sure you want to cancel?')" href="{{url('cancel_appointment',$appointment->id)}}">cancel</a></td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="pt-9 text-center text-black-500 text-xl text-">
<h4 class="text-dark">Make An Appointment
</h4>

</div>
<div class="flex flex-col justify-center items-center ">
<div class=" w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700  justify-content:center">
    <div class="p-6 space-y-4:space-y-6 sm:p-8 ">
<form class="space-y-4 md:space-y-6 " action="appointment/create" method="POST">
    @csrf
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required="">
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
        <input type="email" name="email" id="email" placeholder="email@" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>

    <div>
        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>Number
        <input type="text" name="number" id="number" placeholder="number" class=" block w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
    {{-- <div>
        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>status
        <input type="text" name="status" id="number" placeholder="number" class=" block w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div> --}}
    <div>
        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>date
        <input type="date" name="date" id="date" placeholder="date" class=" block w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
    <div>
        <label for="speciality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">doctors</label>
        <select name="doctor" class="form-select
        block
      w-full
      px-3
      py-1.5">
            @foreach($specialists as $specialist)
            <option>---select----</option>
            <option value="{{$specialist->name}}">{{$specialist->name}} ---{{$specialist->speciality}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="Your message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
        <textarea name="message" id="message" placeholder="Your message" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""></textarea>
    </div>
    
    <button type="submit" class="bg-blue-600 h-9 w-full text-white text-xl">Send</button>

</form>
    </div>
</div>

</body>