<div
    class="p-3 bg-gradient-to-br {{ $requirement->is_completed ? 'from-emerald-500 to-emerald-400' : 'from-indigo-200 to-indigo-100' }} border border-gray-200 rounded-xl shadow-lg">
    <div
        class=" border {{ $requirement->is_completed ? 'border-emerald-800' : 'border-indigo-500' }} rounded-xl p-4 h-full">
        <div class="flex flex-col justify-between h-full">
            <div>
                <div class="flex justify-between">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                        {{ $requirement->description }}</h5>
                    <h5
                        class="mb-2 text-lg font-bold tracking-tight {{ $requirement->is_completed ? 'text-green-900' : 'text-red-900' }}">
                        {{ $requirement->is_completed ? 'Completed' : 'Pending' }}</h5>
                </div>
                <p class="mb-3 font-normal text-xs text-gray-700">
                    {{ $requirement->date }}
                </p>
                <div class="flex justify-between items-center border-y p-2 border-indigo-500">
                    <p class="font-normal text-gray-700">
                        {{ $requirement->account }}</p>
                    <p class="text-lg font-bold text-gray-700">
                        {{ number_format($requirement->amount, 3) }} KWD</p>
                </div>
                <p class="mb-3 font-normal text-gray-700">{{ $requirement->remarks }}
                </p>
            </div>
            @if (!$requirement->comment)
                <div class="flex gap-2 items-center justify-center">
                    <div class="relative flex-1" style="height: 42px;">
                        <textarea wire:model="comment" class="p-2 pe-11 bg-transparent w-full rounded-lg border-indigo-500" cols="30"
                            rows="1" style="resize: none;overflow:hidden"></textarea>
                        <span class=" absolute top-2 right-3 cursor-pointer text-indigo-500"
                            onclick="fileInput{{ $requirement->id }}.click();">
                            <x-svgs.attachment></x-svgs.attachment>
                        </span>
                        <input class=" hidden" type="file" id="fileInput{{ $requirement->id }}"
                            multiple>
                    </div>
                    <a href="#" wire:click="save_comment({{ $requirement->id }})"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                        Submit
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
