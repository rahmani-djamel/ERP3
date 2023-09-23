<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                    الإجازات و العطل
                </h1>

                <div class="  grid md:grid-cols-4 md:gap-12 my-4" >

                    <x-button href="{{route('vacation.annualholiday.index')}}" primary label="الإجازات السنوية" class="font-semibold" />
              
                    <x-button href="{{route('vacation.weekend')}}" primary label="ايام العطل الأسبوعية" class="font-semibold" />
                  
                    <x-button href="{{route('vacation.worktime')}}" positive label="اوقات عمل الموظفين" class="font-semibold" />

                </div>
            </div>
        </section>
    </div>
</main>