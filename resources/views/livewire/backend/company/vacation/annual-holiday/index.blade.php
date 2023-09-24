<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                    الإجازات السنوية
                </h1>

                <div class="  grid md:grid-cols-3 md:gap-12 my-4" >

                    <x-button href="{{route('vacation.annualholiday.index')}}" primary label="عرض الإجازات السنوية" class="font-semibold" />
              
                    <x-button href="{{route('vacation.annualholiday.edit')}}" primary label="إجراء علي أجازة" class="font-semibold" />
                  
                    <x-button href="{{route('vacation.annualholiday.create')}}" positive label="إنشاء إجازة" class="font-semibold" />

                </div>
            </div>
        </section>
    </div>
</main>