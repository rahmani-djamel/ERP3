<div class="flex items-center justify-center w-full">
    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <x-icon name="cloud-upload" class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" />

            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="font-semibold">إضغط هنا</span>لرفع ملفات</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PDF, PNG, JPG</p>
        </div>
        <input id="dropzone-file" wire:model="files" type="file" class="hidden" multiple />
    </label>
</div> 