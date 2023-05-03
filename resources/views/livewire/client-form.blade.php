<x-modal wire:model="showModal" name="client" maxWidth="sm">
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
                    <x-text-input placeholder="Name" wire:model="client.name" type="text" class="mt-1 block w-full"
                        autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('client.name')" />
                </div>
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
