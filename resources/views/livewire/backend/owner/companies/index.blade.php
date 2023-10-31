<main wire:ignore>
    <div x-on:Package-Delete.window="count = count + 1">
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 shadow-2xl ">
                <div class="flex justify-between">
                    <x-button
                    class="m-2"
                    href="{{route('owner.dashboard.companies.create')}}"
                    label="{{__('Add New Company')}}"
                    teal
                />    

                <x-button href="{{route('owner.dashboard.Index')}}" 
                    info 
                    icon="arrow-{{config('direction') == 'ltr' ? 'left' : 'right'}}" 
                    label="{{__('Back')}}"
                    class="font-semibold my-2"
                />


                </div>
            <!-- Start coding here -->
            <livewire:company-table/>
            
            </div>
        </section>
    </div>

</main>
