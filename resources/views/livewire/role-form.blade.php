<x-modal wire:model="showModal" name="role" maxWidth="sm">
    <form method="post" wire:submit.prevent="save">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $modalTitle }}
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4">
                <div>
                    <x-text-input placeholder="Name" wire:model="role.name" type="text" class="mt-1 block w-full"
                        autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('role.name')" />
                </div>
                <div wire:ignore>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Permissions') }}</h3>
                    <div>
                        <table class=" min-w-full text-start text-sm font-light">
                            <tbody>
                                @foreach ($permissions as $section => $section_permissions)
                                    <tr class="border-b transition duration-300 ease-in-out dark:border-gray-600">
                                        <td class=" align-middle">{{ Str::ucfirst($section) }}</td>
                                        <td class=" align-middle">
                                            @foreach ($section_permissions as $permission)
                                                <div class="flex items-center">
                                                    <input id="{{ $permission->id }}" type="checkbox"
                                                        value="{{ $permission->id }}" wire:model="selected_permissions"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="{{ $permission->id }}"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->description }}</label>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('selected_permissions')" />
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 space-x-1 border-t border-gray-200 rounded-b dark:border-gray-600">
                <x-primary-button type="submit">Save</x-primary-button>
                <x-secondary-button wire:click="$set('showModal',false)"
                    class=" dark:text-red-400 text-red-400 border-none shadow-none dark:bg-transparent">Cancel
                </x-secondary-button>
            </div>
        </div>
    </form>
</x-modal>
