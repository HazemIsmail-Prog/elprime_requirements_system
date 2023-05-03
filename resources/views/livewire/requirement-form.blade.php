<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Requirements') }}
        </h2>
    </div>
</x-slot>

<div class="flex flex-col">
    <div class="flex items-end justify-start">
        <x-select title="Clients" wire:model="filter.selected_client_id">
            <option disabled value="">Select Client</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </x-select>
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
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            @if ($filter['selected_client_id'])
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-4">Date</th>
                                <th scope="col" class="px-6 py-4">Account</th>
                                <th scope="col" class="px-6 py-4">Description</th>
                                <th scope="col" class="px-6 py-4">Amount</th>
                                <th scope="col" class="px-6 py-4">Remarks</th>
                                <th scope="col" class="px-6 py-4">Client Reply</th>
                                <th scope="col" class="px-6 py-4 text-center">Completed</th>
                                <th scope="col" class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($requirements as $requirement)
                                <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-gray-700 dark:hover:bg-neutral-600">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $requirement->date }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $requirement->account }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $requirement->description }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $requirement->amount }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $requirement->remarks }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $requirement->comment }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-center">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input wire:click="toggle_completed({{ $requirement->id }})" type="checkbox"
                                                {{ $requirement->is_completed ? 'checked' : '' }} class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                            </div>
                                        </label>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex gap-3 justify-center">
                                            @can('requirements_delete')
                                                <button
                                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                    wire:click="delete({{ $requirement }})" class="text-red-400">
                                                    <x-svgs.trash></x-svgs.trash>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-gray-700 dark:hover:bg-neutral-600">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <x-text-input wire:model="requirement.date" class="p-1 w-full me-auto"
                                        type="date" placeholder="Date" />
                                    <x-input-error class="mt-2" :messages="$errors->get('requirement.date')" />
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <x-text-input wire:model="requirement.account" class="p-1 w-full me-auto"
                                        type="text" placeholder="Account" />
                                    <x-input-error class="mt-2" :messages="$errors->get('requirement.account')" />
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <x-text-input wire:model="requirement.description" class="p-1 w-full me-auto"
                                        type="text" placeholder="Description" />
                                    <x-input-error class="mt-2" :messages="$errors->get('requirement.description')" />
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <x-text-input wire:model="requirement.amount" class="p-1 w-full me-auto"
                                        type="number" placeholder="Amount" />
                                    <x-input-error class="mt-2" :messages="$errors->get('requirement.amount')" />

                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <x-text-input wire:model="requirement.remarks" class="p-1 w-full me-auto"
                                        type="text" placeholder="Remarks" />
                                    <x-input-error class="mt-2" :messages="$errors->get('requirement.remarks')" />
                                </td>
                                <td></td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <div class="flex gap-3 justify-center">
                                        <x-primary-button wire:click="save">save</x-primary-button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
