<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{config('direction')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ URL::asset('logo.ico') }}" type="image/x-icon"/>

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         <!-- Scripts -->
         @wireUiScripts
         @vite(['resources/css/app.css', 'resources/js/app.js'])
         @livewireStyles


        @stack('styles')


</head>
<body class="bg-gray-50 dark:bg-gray-800" x-data="{ mode: $persist('theme') || 'light' }" x-init="$watch('mode', value => $persist('theme', value))" :class="{'dark': mode === 'dark'}">
  <x-dialog />

  @livewire('includes.navbar',['fixed' => false])


 
  <div id="main-content" class="min-h-screen dark:bg-slate-700">

   {{$slot}}
   </div>



    @livewireScripts
  <script>
       // Refresh
      window.addEventListener('refresh',() => {
        setTimeout(() => {
    location.reload();
  }, 2000); // wait for 2 seconds before reloading 
});   
  </script>

  
      @stack('scripts')
      
</body>
</html>