<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                 {{__('Annual leaves')}}
                </h1>

                <div class="  grid md:grid-cols-3 md:gap-12 my-4" >

                    <x-button href="{{route('company.dashboard.vacation.annualholiday.show')}}" primary label="{{__('View annual leaves')}}" class="font-semibold" />
              
                    <x-button href="{{route('company.dashboard.vacation.annualholiday.edit')}}" primary label="{{__('Amendment to leave')}}" class="font-semibold" />
                  
                    <x-button href="{{route('company.dashboard.vacation.annualholiday.create')}}" positive label="{{__('Create a vacation')}}" class="font-semibold" />

                </div>
            </div>
        </section>
    </div>
</main>