<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                    الحضور و الغياب
                </h1>

                <div class="  grid md:grid-cols-4 md:gap-12 my-4" >
              
                    <x-button href="{{route('attendance.report')}}" primary label="كشف الحضور والغياب" class="font-semibold" />
                  
                    <x-button href="{{route('attendance.statment')}}" positive label=" تقرير الحضور و الغياب" class="font-semibold" />

                </div>
            </div>
        </section>
    </div>
</main>