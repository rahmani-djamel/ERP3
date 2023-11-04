<main wire:ignore>
    <div x-on:Package-Delete.window="count = count + 1">
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12 shadow-2xl ">
            <!-- Start coding here -->
            <livewire:employee-table  company="{{$company->id}}"/>
        </div>
        </section>
    </div>

</main>
