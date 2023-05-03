<x-modal wire:model="showModal" name="user" maxWidth="sm">
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
                    {{-- <x-input-label for="name" :value="__('Name')" /> --}}
                    <x-text-input placeholder="Name" wire:model="user.name" type="text" class="mt-1 block w-full"
                        autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('user.name')" />
                </div>

                <div>
                    {{-- <x-input-label for="username" :value="__('Username')" /> --}}
                    <x-text-input placeholder="Username" wire:model="user.username" type="text"
                        class="mt-1 block w-full" autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('user.username')" />
                </div>

                <div>
                    {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                    <x-text-input placeholder="Email" wire:model="user.email" type="email" class="mt-1 block w-full"
                        autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('user.email')" />
                </div>
                <div>
                    {{-- <x-input-label for="password" :value="__('Password')" /> --}}
                    <x-text-input placeholder="Password" wire:model="user.password" type="password"
                        class="mt-1 block w-full" autocomplete="password" />
                    <x-input-error class="mt-2" :messages="$errors->get('user.password')" />
                </div>
                <div class="flex flex-row items-center justify-start gap-5">
                    <div class="flex items-center">
                        <input wire:model="user.type" id="default-radio-1" type="radio" value="local"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Local User</label>
                    </div>
                    <div class="flex items-center">
                        <input wire:model="user.type" id="default-radio-2" type="radio" value="client"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-2"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Client User</label>
                    </div>
                </div>
                <div class="flex items-center">
                    <input checked id="checked-checkbox" type="checkbox" wire:model="user.active"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
                </div>
                <div wire:ignore id="rolesList" class=" border rounded p-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Roles') }}</h3>
                    @foreach ($roles as $role)
                        <div class="flex items-center">
                            <input id="role{{ $role->id }}" type="checkbox" value="{{ $role->id }}"
                                wire:model="selected_roles"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="role{{ $role->id }}"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('selected_roles')" />
                    
                <div wire:ignore id="clientsList" class=" border rounded p-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Clients') }}</h3>
                    @foreach ($clients as $client)
                        <div class="flex items-center">
                            <input id="client{{ $client->id }}" type="checkbox" value="{{ $client->id }}"
                                wire:model="selected_clients"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="client{{ $client->id }}"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $client->name }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('selected_clients')" />
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
