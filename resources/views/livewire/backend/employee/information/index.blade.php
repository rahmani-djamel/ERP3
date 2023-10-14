<main>
    <div>
        <section class="pt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                     <x-employee.includes.header-card iconname="identification" title="{{__('My Information')}}" />

                    <div class="overflow-x-auto">
           

                    </div>
    
                    <div class="py-4 px-3">
                        <div class="container mx-auto">

                            <h2 class="dark:text-white font-extrabold my-2">
                            </h2>
                            <div class="grid md:grid-cols-1 gap-4">
                                <div class="col-span-1">
                                    <table class="w-full text-sm text-left text-gray-500 ">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700" >
                                            <tr>
                                                <th scope="col" class="px-4 py-3 text-center">{{__('title')}}</th>
                                                <th scope="col" class="px-4 py-3 text-center">{{__('information')}}</th>
                                            </tr>
                                        </thead>                   
                                                 <tbody>
                                                    @forelse ($header as $cle => $item)
                                                    <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$cle}}">
                                                        
                                                        <td class="px-4 py-3 text-center">
                                                            {{__($item)}}
                                                        </td>
                                                        <td class="px-4 py-3 text-center">
                                                            {{$employee->$cle}}
                                                        </td>
                                                    </tr>

                                                    @empty
                                                    <tr>
                                                        <td colspan="2">No employees found.</td>
                                                    </tr>
                                                    @endforelse
            
                                      
                                                
                                                </tbody>
                                    </table>
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