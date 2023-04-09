<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <!-- ... -->
</head>
<body>
  
   @include('Admin.Layouts.navbar')
  
   @include('Admin.Layouts.sidebar')
<section class="pb-10 dark:bg-gray-900">
         
   <div class="relative overflow-x-auto pl-64">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700        dark:text-gray-400">
         <tr>
            <th  scope="col" class = "px-6 py-3">customer name</th>
            <th  scope = "col" class = "px-6 py-3">Email</th>
            <th  scope = "col" class = "px-6 py-3"> Phone</th>
            <th  scope = "col" class = "px-6 py-3"> Doctor Name</th>
            <th  scope = "col" class = "px-6 py-3"> Date</th>
            <th  scope = "col" class = "px-6 py-3"> Message</th>
            <th  scope = "col" class = "px-6 py-3"> Status</th>
            <th  scope = "col" class = "px-6 py-3"> Approve</th>
            <th  scope = "col" class = "px-6 py-3"  scope="col" class="px-6 py-3">Cancel</th>
         </tr>
      </thead>
                     
            <tbody>
            @foreach($appointments as $appointment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->name}}</td>
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->email}}</td>
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->number}}</td>
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->doctor}}</td>
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->date}}</td>
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->message}}</td>
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->status}}</td>
               
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><a onclick = "return confirm('are you sure?')" href="{{url('Admin/approved', $appointment->uuid)}}">Approve</a></td>
               
               <td scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><a  onclick = "return confirm('are you sure?')"  href="{{url('Admin/canceled', $appointment->uuid)}}">Cancel</a></td>
            </tr>
         </tbody>
            @endforeach
   </table>
</div>
</section>
         

         
