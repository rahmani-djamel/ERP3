<main>
    <div>
        <section class="mx-4">
                <div class="  grid md:grid-cols-4 md:gap-12 py-4" >

                    <x-employee.index.card 
                    link="employee.dashboard.attendance.index"
                    iconName="clipboard-check"
                    title="{{ __('Recording attendance and absence') }}"
                    />

                    <x-employee.index.card 
                    link="employee.dashboard.attendance.report"
                    iconName="document-report"
                    title="{{ __('Read report') }}"
                    />
              
                    <x-employee.index.card 
                    link="employee.dashboard.vacation.index"
                    iconName="flag"
                    title="{{ __('Vacation') }}"
                    />
                  

                </div>
        </section>
    </div>
</main>