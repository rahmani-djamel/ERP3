<main>
    <div>
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                    <div class="overflow-x-auto">
           

                    </div>
    
                    <div class="py-4 px-3">
                        <div class="container mx-auto">

                            <div class="grid grid-cols-1 gap-4 mt-3">
                                <div class="col-span-1">
                                    <x-input wire:model="password" label="{{__('Current Password')}}" type="password" />
                                </div>

                                <div class="col-span-1">
                                    <x-input wire:model="new_password" label="{{__('New Password')}}" type="password" />
                                </div>

                                <div class="col-span-1">
                                    <x-input wire:model="confirmation" label="{{__('Password Confirmation')}}" type="password" />
                                </div>
                                <div class="col-span-1">
                                    <x-button info wire:click="updatePassword" label="{{__('save')}}" />
                                </div>

                            </div>


                            <h2 class="dark:text-white font-extrabold my-2">
                            </h2>
                            <div class="grid md:grid-cols-1 gap-4">
                                <div class="col-span-1">

                                </div>
                            </div>
                        </div>

                    </div>
                        
                    </div>
                </div>
            </div>
        </section>
    
    </div>
</main>