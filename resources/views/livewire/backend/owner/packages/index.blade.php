<main>
    <div>
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 shadow-2xl ">
                <x-button
                class="m-2"
                href="{{route('owner.dashboard.packages.create')}}"
                label="{{__('Add New Package')}}"
                teal
            />                <!-- Start coding here -->
                <livewire:package-table/>
            </div>
        </section>
    
    </div>
</main>
