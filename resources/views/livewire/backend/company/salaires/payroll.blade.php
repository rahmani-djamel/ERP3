<main x-data="{ 'showModal': false }">
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-white dark:bg-gray-700">
                                <tr>
                                    @foreach ($headers as $item)
                            
                                    <th scope="col" class="px-4 py-3 text-center">{{$item}}</th>
                            
                                    @endforeach
                                    <th scope="col" class="px-4 py-3 text-center">الإجراءات</th>
                                </tr>
                            </thead>                   
                                     <tbody>

                                        @forelse ($data as $item)

                                        @php
                                        $startOfMonth = now()->startOfMonth();
                                        $endOfMonth = now()->endOfMonth();
                                        $AbsentCount = $item->CounterMounth($startOfMonth, $endOfMonth,'غائب');
                                        $LateCount = $item->CounterMounth($startOfMonth, $endOfMonth,'متأخر');


                                    @endphp

                                        <tr class="border-b dark:border-gray-700 dark:text-white" wire:key="{{$item->id}}">
                                            <td class="px-4 py-3 text-center">
                                             {{$item->id}}
                                            </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->JobNumber}}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->Name}}

                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->BasicSalary}}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->HousingAllowance}}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->transportationAllowance}}
                                        </td>
                                        <td class="px-4 py-3 text-center text-red-500">
                                            10
                                        </td>
                                        <td class="px-4 py-3 text-center text-red-500">
                                            10
                                        </td>
                                        <td class="px-4 py-3 text-center text-red-500">
                                            10
                                        </td>
                                        <td class="px-4 py-3 text-center text-red-500">
                                            10
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$AbsentCount}}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$LateCount}}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->LoanHistory}}
                                        </td>
                                        <td class="px-4 py-3 text-center text-red-500">
                                            10
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            {{$item->BasicSalary}}
                                        </td>
                                        <td class="px-4 py-3 text-center text-red-500">
                                            لم يتم دفع الراتب
                                        </td>

                                    
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($keysToDisplay) }}">No employees found.</td>
                                        </tr>
                                    
                                        
                                    
                                    @endforelse
                                    
                                    </tbody>
                        </table>

                    </div>
    
                    <div class="py-4 px-3">
                        <div class="flex ">
                            <div class="flex space-x-4 items-center mb-3">
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    </div>

</main>
