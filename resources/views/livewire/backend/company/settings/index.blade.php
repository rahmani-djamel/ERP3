<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                   {{__('Settings')}}
                </h1>

                <div class="grid md:grid-cols-4 md:gap-12 my-4">
                    <x-button href="{{ route('company.dashboard.settings.main') }}" primary label="{{ __('Basic Settings') }}" class="font-semibold" />
                    <x-button href="{{ route('company.dashboard.settings.branches') }}" primary label="{{ __('Worksite Settings') }}" class="font-semibold" />
                    <x-button href="{{ route('company.dashboard.settings.logo') }}" positive label="{{ __('Logo and Stamp Settings') }}" class="font-semibold" />
                </div>
                
            </div>
        </section>
    </div>
</main>