<x-slot name="header">
    <div class="flex justify-between">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissions') }}
        </h2>
        @can('permissions_create')
            <x-primary-button x-data="{}" x-on:click="window.livewire.emitTo('permission-form','showModal',null)">
                {{ __('New Permission') }}</x-primary-button>
        @endcan
    </div>
</x-slot>

<div class="flex flex-col">
    @livewire('permission-form')
    <div class="flex items-center justify-end">
        <x-text-input wire:model="search" class="p-1 me-auto" type="text" placeholder="Search" />
    </div>
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4">ID</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Description</th>
                            <th scope="col" class="px-6 py-4">Section</th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-neutral-100  dark:hover:bg-neutral-600 dark:border-gray-700">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $permission->id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $permission->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $permission->description }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $permission->section_name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex gap-3 justify-end">
                                        @can('permissions_edit')
                                            <button x-data="{}"
                                                x-on:click="window.livewire.emitTo('permission-form','showModal',{{ $permission }})">
                                                <x-svgs.edit></x-svgs.edit>
                                            </button>
                                        @endcan
                                        @can('permissions_delete')
                                            <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                wire:click="delete({{ $permission }})" class="text-red-400">
                                                <x-svgs.trash></x-svgs.trash>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="px-6 py-4">{{ $permissions->links() }}</div>
</div>
