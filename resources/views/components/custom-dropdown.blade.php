@props([
    'contentClasses' => '',
    'title',
])


<li
    class="block w-full ps-3 pe-4  border-s-4 border-transparent text-start text-base font-medium  transition duration-150 ease-in-out">
    <button type="button"
        class="flex py-2 items-center w-full transition duration-75 group text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600"
        aria-controls="{{ $title }}" data-collapse-toggle="{{ $title }}">
        {{ $icon }}
        <span class="flex-1 ms-3 text-start whitespace-nowrap" sidebar-toggle-item>{{ $title }}</span>
        <x-svgs.chevron-down></x-svgs.chevron-down>
    </button>
    <ul id="{{ $title }}" class=" py-2 space-y-2 {{ $contentClasses }}">
        {{ $content }}
    </ul>
</li>
