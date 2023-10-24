<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                    {{__('Vacations')}}
                </h1>

                <div class="  grid md:grid-cols-4 md:gap-12 my-4" >

                    <x-button href="{{route('vacation.annualholiday.index')}}" primary label="{{__('Annual leaves')}}" class="font-semibold" />
              
                    <x-button href="{{route('vacation.weekend')}}" primary label="{{__('Weekend days')}}" class="font-semibold" />
                  
                    <x-button href="{{route('vacation.worktime')}}" positive label="{{__('Employees working hours')}}" class="font-semibold" />

                </div>
            </div>
        </section>
    </div>
</main>