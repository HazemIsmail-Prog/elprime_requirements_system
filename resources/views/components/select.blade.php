<div class=" mx-2 flex flex-col items-start">
    <label for="{{ $title }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $title }}</label>
    <select id="{{ $title }}" {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
        {{ $slot }}
    </select>
</div>