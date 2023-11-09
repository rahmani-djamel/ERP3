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
  <x-notifications />



@livewire('includes.navbar',['fixed' => true])
  <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900 h-screen">
  
    <aside id="logo-sidebar" class="fixed inset-y-0 top-0 ltr:left-0 rtl:sm:right-0 z-40 w-64
    h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 
    sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 w-64  max-sm:w-full" aria-label="Sidebar">
      <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
         <ul class="space-y-2 font-medium">

            <x-layouts.dashboard.navigation />
         </ul>
        
      </div>
      <div class="absolute bottom-0 left-0 justify-center hidden w-full bg-white space-x-4  lg:flex dark:bg-gray-800" sidebar-bottom-menu="">

      </div>
   </aside>
   
  

   <div class="fixed inset-0 z-10 hidden min-h-screen   dark:bg-gray-900/90 h-screen" id="sidebarBackdrop"></div>
 
   <div id="main-content" class="relative w-full h-full  overflow-y-auto bg-[#DEE6EC] rtl:lg:mr-64 ltr:lg:ml-64 dark:bg-gray-900 ">

    @if (auth()->user()->hasRole('manger'))
        @if (auth()->user()->company->days < 30)
          <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
              
              <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{__('The subscription will expire in ')}} {{auth()->user()->company->days}} {{__('day')}}</span> 
              </div>
            </div>
          </section>
        @endif
    @endif



   {{$slot}}
   </div>
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