<main>
    <div>
        <section class="mx-4">
                <div class="  grid md:grid-cols-4 md:gap-12 py-4" >

                    <x-employee.index.card 
                    link="owner.dashboard.packages.index"
                    iconName="duplicate"
                    title="{{ __('Packages') }}"
                    />

                    <x-employee.index.card 
                    link="owner.dashboard.companies.index"
                    iconName="office-building"
                    title="{{ __('Companies') }}"
                    />



                </div>
        </section>
    </div>
</main>