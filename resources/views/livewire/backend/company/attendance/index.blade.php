<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                     {{__('Attendance')}}
                </h1>

                <div class="  grid md:grid-cols-4 md:gap-12 my-4" >
              
                    <x-button href="{{route('company.dashboard.attendance.report')}}" primary label="{{__('Read report')}}" class="font-semibold" />
                  
                    <x-button href="{{route('company.dashboard.attendance.statment')}}" positive label="{{__('Read Satatment Information')}}" class="font-semibold" />

                </div>
            </div>
        </section>
    </div>
</main>