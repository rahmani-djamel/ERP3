<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                     الإعدادات
                </h1>

                <div class="  grid md:grid-cols-4 md:gap-12 my-4" >
              
                    <x-button href="{{route('settings.main')}}" primary label="الإعدادات الأساسية" class="font-semibold" />

                    <x-button href="{{route('settings.branches')}}" primary label="إعدادات مواقع العمل" class="font-semibold" />


                    <x-button href="{{route('settings.logo')}}" positive label="إعدادات الشعار والختم" class="font-semibold" />

                  

                </div>
            </div>
        </section>
    </div>
</main>