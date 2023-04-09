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

 <div class = "relative overflow-x-auto pl-96 ">
    <table class = "text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class = "text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope = "col" class = "py-3">
                    Doctor Name
                </th>
                <th scope = "col" class = "px-6 py-3">
                    room_number
                </th>
                <th scope = "col" class = "px-6 py-3">
                    Doctor_number
                </th>
                <th scope = "col" class = "px-6 py-3">
                    speciality
                </th>
                
                <th scope = "col" class = "px-6 py-3">Delete Doctor</th>
                <th scope = "col" class = "px-6 py-3">Edit</th>
            </tr>
        </thead>
        <tbody>

            @foreach($specialists as $specialist)
            <tr class = "bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                
                <th scope = "row" class = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{$specialist->name}}
                </th>
                <td class = "px-6 py-4">
                   {{$specialist->room_no}}
                </td>
                <td class = "px-6 py-4">
                    {{$specialist->doctor_no}}
                </td>
                <td class = "px-6 py-4">
                   {{$specialist->speciality}}
                </td>

                <form action = "{{url('Admin/delete_specialist', $specialist->id)}}" method = "Post" >
                     @csrf
                     @method('DELETE')
                     <td><button class = "bg-red-600 px-6 py-2"  onclick = "return confirm('are you sure you want to delete?')"> delete</button></td>
                  </form>
				  
                <td class="px-6 py-4"><a href='{{url('Admin/edit_specialist', $specialist->id)}}'>
                 Edit</a>
               </td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
