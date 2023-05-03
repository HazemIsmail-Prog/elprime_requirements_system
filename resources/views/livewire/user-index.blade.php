<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
        @can('users_create')
            <x-primary-button x-data="{}" x-on:click="window.livewire.emitTo('user-form','showModal',null)">
                {{ __('New User') }}</x-primary-button>
        @endcan
    </div>
</x-slot>

<div class="flex flex-col">
    @livewire('user-form')
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
                            <th scope="col" class="px-6 py-4">Username</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-gray-700 dark:hover:bg-neutral-600">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $user->id }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->username }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($user->active)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">In-Active</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex gap-3 justify-end">
                                        @can('users_edit')
                                            <button x-data="{}"
                                                x-on:click="window.livewire.emitTo('user-form','showModal',{{ $user }})">
                                                <x-svgs.edit></x-svgs.edit>
                                            </button>
                                        @endcan
                                        @can('users_delete')
                                            <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                wire:click="delete({{ $user }})" class="text-red-400">
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
    <div class="px-6 py-4">{{ $users->links() }}</div>
</div>
