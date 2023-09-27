<main>
    <div>
        <section class="mt-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">

                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <x-icon name="cloud-upload" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" />
                        
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">إضغط هنا</span>لرفع الشعار</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG</p>
                                </div>
                                <input id="dropzone-file" wire:model="logo" type="file" class="hidden" />
                            </label>
                            @error('logo') <span class="error">{{ $message }}</span> @enderror

                        </div> 

                    </div>
                    <div class="relative z-0 w-full mb-6 group">

                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file2" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <x-icon name="cloud-upload" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" />
                        
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">إضغط هنا</span>لرفع الختم</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG</p>
                                </div>
                                <input id="dropzone-file2" type="file" class="hidden"  wire:model="seal" />
                            </label>
                            @error('seal') <span class="error">{{ $message }}</span> @enderror

                        </div> 

                    </div>
            </div>
            <div class="grid md:grid-cols-1 md:gap-6">

                <x-button wire:click='save' positive label="حفظ"     wire:loading.attr="disabled"/>
                <div wire:loading >تحميل...</div>

            </div>
            </div>
        </section>
    </div>
</main>