<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Requirements') }}
        </h2>
    </div>
</x-slot>

<div class="flex flex-col">
    <div class="flex items-end justify-start">
        <x-select title="Month" wire:model="filter.month">
            <option disabled value="">Month</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </x-select>
        <x-select title="Year" wire:model="filter.year">
            <option disabled value="">Year</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
        </x-select>
        <button wire:click="refresh" class="mb-2.5 ms-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </button>
    </div>
    <div class="overflow-x-auto mt-3 sm:-mx-6 lg:-mx-8">
        <div class="min-w-full py-2 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($requirements as $requirement)
                <div wire:key="{{ $loop->index }}">
                    @livewire('client-card', ['requirement' => $requirement], key($requirement->id))
                </div>
            @endforeach
        </div>
    </div>
</div>
