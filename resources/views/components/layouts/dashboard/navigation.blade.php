<div>

    <x-layouts.dashboard.navigationitem url="company.dashboard.Index" icon="home" text="Home" />

    @ability('manger', 'create-employee|read-employee|delete-employee|edit-employee')
    <x-layouts.dashboard.navigationitem url="company.dashboard.employee.index" icon="users" text="Employees" />
    @endability

    @ability('manger', 'read-statment-attendance|read-report-attendance')

    <x-layouts.dashboard.navigationitem url="company.dashboard.attendance.index" icon="clipboard" text="Attendance" />

    @endability

    @ability('manger', 'annual-leave|weekend-days|employees-working-hours')

    <x-layouts.dashboard.navigationitem url="company.dashboard.vacation.index" icon="calendar" text="Vacations" />

    @endability

    @ability('manger', 'salaries-and-commissions')
    <x-layouts.dashboard.navigationitem url="company.dashboard.salaires.index" icon="currency-dollar" text="Salaries and commissions" />

    @endability

    @ability('manger', 'appeal-requests')

    <x-layouts.dashboard.navigationitem url="company.dashboard.resumption.index" icon="fast-forward" text="Appeal requests" />

    @endability

    @ability('manger', 'ask-permission')

    <x-layouts.dashboard.navigationitem url="company.dashboard.askpermission.index" icon="clock" text="ask permission" />

    @endability


    @ability('manger', 'company-settings')

    <x-layouts.dashboard.navigationitem url="company.dashboard.settings.index" icon="cog" text="Settings" />

    @endability



    

    

</div>