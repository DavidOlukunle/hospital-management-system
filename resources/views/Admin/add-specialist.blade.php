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

    <div class = "flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class = "flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class = "w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt = "logo">
            Flowbite    
        </a>

        <div class = "w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class = "p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class = "text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Add new Doctors
                </h1>

                <form class = "space-y-4 md:space-y-6" action = "{{url('Admin/register')}}" method = "POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div>
                        <label for = "name" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type = "text" name = "name" id = "name" class = "bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder = "Doctor's name" required="">
                    </div>

                    <div>
                        <label for ="room no" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">room no</label>
                        <input type = "text" name = "room_no" id = "password" placeholder = "room no" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>

                    <div>
                        <label for = "speciality" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">speciality</label>
                        <select name = "speciality" class = "bg-gray-5">

                            <option>---select----</option>

                        <option value = "Pediatrician"> Pediatrician </option>
                        <option value = "neurosogeon"> neurosogeon </option>
                        <option value = "Cardiologist"> Cardiologist </option>
                        <option value = "Pulmonologist"> Pulmonologist </option>
                        <option value = "oncologist"> oncologist </option>
                        </select>
                    </div>

                    <div>
                        <label for = "doctor's number" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor's number</label>
                        <input type = "text" name = "doctor_no" id="password" placeholder = "Number" class = "bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    
                    <div>
                        <label for = "Image" class = "block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type = "file" name = "image" id = "password" placeholder = "Number" class = "bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                                                                
                    <button type = "submit" class = "w-full text-xl text-black bg-red-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
                    
                </form>
            </div>
        </div>
    </div>
</section>
                  
</body>
</html>
