<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <h1 class="font-extrabold text-lg dark:text-white">
                 {{__('Salaries and commissions')}}
                </h1>

                <div class="  grid md:grid-cols-4 md:gap-12 my-4" >
                    @ability('manger', 'salaries-and-commissions')

                    <x-button href="{{route('company.dashboard.salaires.payroll')}}" primary label="{{__('Salaries')}}" class="font-semibold" />
                    @endability

                </div>
            </div>
        </section>
    </div>
</main>