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

                    <x-employee.index.card 
                    link="employee.dashboard.information.index"
                    iconName="identification"
                    title="{{ __('My Information') }}"
                    />
                  
                    <x-employee.index.card 
                    link="employee.dashboard.password.index"
                    iconName="lock-closed"
                    title="{{ __('Change Password') }}"
                    />

                    <x-employee.index.card 
                    link="employee.dashboard.askpermission.index"
                    iconName="clock"
                    title="{{ __('Asking Permission') }}"
                    />

                    <x-employee.index.card 
                    link="employee.dashboard.resumption.index"
                    iconName="fast-forward"
                    title="{{ __('Request to start work') }}"
                    />

                </div>
        </section>
    </div>
</main>