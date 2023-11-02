    <main wire:ignore>
        <div x-on:Package-Delete.window="count = count + 1">
            <section class="pt-10">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12 shadow-2xl ">
                    <div class="flex justify-between">
                        <x-button
                        class="m-2"
                        href="{{route('employee.create')}}"
                        label="{{__('Add New Employee')}}"
                        teal
                    />    
    
                    <x-button href="{{route('company.Index')}}" 
                        info 
                        icon="arrow-{{config('direction') == 'ltr' ? 'left' : 'right'}}" 
                        label="{{__('Back')}}"
                        class="font-semibold my-2"
                    />
    
                    </div>
                <!-- Start coding here -->
                <livewire:employee-table/>
            </div>
            </section>
        </div>
    
    </main>
    