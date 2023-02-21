<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
  <!-- ... -->
</head>
<body>
  
<nav class="bg-gray-50 border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
      <a href="https://flowbite.com/" class="flex items-center">
          <img src="" class="h-6 mr-3 sm:h-9" alt="" />
          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">DAILYCARE</span>
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
         
          @auth
         
            <li>
                welcome{{auth()->user()->name}}
            </li>
          
          <li class="bg-red-300 text-bold hover:bg-red-600 text-white">
            <a href="{{url('appointments')}}">
          View my Appointments</a>
        </li>
        <li>
          <form action='/logout' method="post">
            @csrf
            <button type="submit">
          <i class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">LOGOUT</i></button></form>
        </li>

        @else
         
          <li>
            <a href="/login" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">LOGIN</a>
          </li>
          <li>
            <a href="/register" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">REGISTER</a>
          </li>
          
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 pt-7 auto">
    <div class="pl-20 pt-7">
      <h6 class="text-blue-700 text-5xl font-bold ">Feel Better About</h6><br><h6 class="text-blue-200 text-5xl font-bold  "> Finding HealthCare</h6>
      <h3 class="pt-4 font-bold text-xl text-gray-500">The time is now for it, be okay!<br>People in this world shun people for being nice</h3>
      <div class="pt-8 flex">
        <div>
      <button type="button" class="flex w-32 bg-gray-200 text-center py-4 px-5 rounded-full ">Get Started</button></div>
      <div class="pl-7">
      <button type="button" class="flex w-32 bg-gray-200 hover:bg-blue-600 py-4 px-5 rounded-full">Read More</button>
      </div>
      </div>
    </div>

    <div class="">
      <img  class=" max-w-full"src='/image/happy.jpeg'height=5px>
    </div>

  
  </div>

  <div class="pt-9 ">
    <h3 class="text-blue-900 text-center font-bold text-3xl">What We do</h3>
  </div>


  <div class="grid grid-cols-1 gap-4 pt-7 pl-20 w-11/12 md:grid-cols-4 sm:grid-cols-2">
    <div class="bg-gray-50 border-8 border-gray-50 h-48 pt-12 text-center hover:bg-gray-600 hover:text-white">
      <h1 class="font-bold text-xl">24/7 Access</h1>
      <h3 class=" text-xm pt-3">We get insulted by others,</h3>
      <h3 class="text-xm ">loose trust for those we get back</h3>
    </div>
    <div class="bg-gray-50 border-8 border-gray-50 h-48 pt-12 text-center hover:bg-gray-600 hover:text-white">
      <h1 class="font-bold text-xl">24/7 Access</h1>
      <h3 class=" text-xm pt-3">We get insulted by others,</h3>
      <h3 class="text-xm ">loose trust for those we get back</h3>
    </div>
    <div class="bg-gray-50 border-8 border-gray-50 h-48 pt-12 text-center hover:bg-gray-600 hover:text-white">
      <h1 class="font-bold text-xl">24/7 Access</h1>
      <h3 class=" text-xm pt-3">We get insulted by others,</h3>
      <h3 class="text-xm ">loose trust for those we get back</h3>
    </div>
    <div class="bg-gray-50 border-8 border-gray-50 h-48 pt-12 text-center pr-5 hover:bg-gray-600 hover:text-white">
      <h1 class="font-bold text-xl">24/7 Access</h1>
      <h3 class=" text-xm pt-3">We get insulted by others,</h3>
      <h3 class="text-xm ">loose trust for those we get back</h3>
    </div>
  </div>



    <div class="grid grid-cols-1 pt-10 pl-20 md:grid-cols-2 ">
       <div class="h-full pl-20 pt-9 ">
        <img src="image/doctor2.png"class="max-w-full h-62 w-3/4">
          </div>
      <div class="pr-20 lg:pt-20">
        <h3 class="text-blue-900 font-bold text-4xl">Find the right doctor right at your finger tip</h3><br>
        <h3 class="text-gray-500 font-bold">We help you connect with the best doctors in the country. We are here to ensure that the best is given to our lovely patients. 
          This is where the art of medicine is loved and  the love for humanity can not be overemphasized.
        </h3>
        <br><br>
        <button type="button" class="w-32 py-2 px-5 bg-blue-600 text-white text-center align-center ">Read More</button>
      </div> 
    </div>


<div class="pt-20">
  <h3 class="text-center text-3xl text-blue-700 font-bold">Our Team</h3>
  <h3 class="text-center text-3xl text-blue-900 font-bold pt-4">Meet our specialists</h3>
  <h2 class="text-center pt-5 pl-36 pr-36">Over the years, our team of specailists have grown both locally and internationally. We have ensured that the best of practioners are employed here with us. Not just that practioners who value life and hold humanity in high esteem</h2>
</div>



 <div id="dynamic-carousel" class="relative pt-12" data-carousel="slide">
  <!--carousel wrapper-->
  <div class="relative h-56 w-screen overflow-hidden rounded-lg lg:w-3/4 lg:h-96 ">
    <!--items to loop-->
   
   
    <!--img src= class="rounded-t-lg h-36" alt="" /-->
   
    @foreach($docs as $doc)
    
    <div class="hidden duration-700 ease-linear" data-carousel-item>
     <h3 class="text-gray-150 font-bold pl-44 text-center ">{{$doc->name}}</h3>
     <h3 class="text-gray-150 font-bold pl-44 text-center ">{{$doc->speciality}}</h3>
      <img src="{{ asset('storage/'.$doc->Image)}}" class="lg:pl-72 h-96 w-3/4 " alt="">
  

  </div>
  
  
    @endforeach
      <!-- Slider controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-red/30 dark:bg-red-800/30 group-hover:bg-red/50 dark:group-hover:bg-red-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-red-800/70 group-focus:outline-none">
          <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          <span class="sr-only">Previous</span>
      </span>
  </button>
  <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          <span class="sr-only">Next</span>
      </span>
  </button>

  </div>
 </div>



 
     
     

    
<div class="grid grid-cols-1 lg:grid-cols-2 pt-20  pl-16 lg:pl-20 ">
  <div class="">
    <h3 class="text-2xl font-bold text-blue-600">
      Subscribe for news</h3>
      <h1> The latest news, articles and resources sent to your inbox weekly</h1>
  </div>

  <div class="">
    <input type="text" class="bg-gray-50 rounded w-64" placeholder="your Email">
    <button type="button" class="rounded bg-blue-500 "><h3 class="inline text-center text-white">Subscribe</h3></button>
  </div>
</div>
<div class="grid grid-cols-3 gap-4   pl-10 pt-10 md:grid-cols-5 md:gap-4">
  <div class="">
    <h3>HOSPITAL</h3>
    
  </div>

    <div class="">
      <h3>COMPANY</h3>
     
    </div>

    <div class="">
      <h3>COMPANY</h3>
     
    </div>

    <div class="">
      <h3>COMPANY</h3>
      
    </div>

    <div class="">
      <h3>COMPANY</h3>
      
    </div>
  </div>



      <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>
</html>

  


