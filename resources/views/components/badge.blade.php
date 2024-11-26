@props(['size', 'color'])

@php
$colors = [
'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
'gray' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
'red' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
'green' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
'indigo' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
'purple' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
'pink' => 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300',
];

$sizes = [
'xs' => 'text-xs px-2.5 py-0.5',
'sm' => 'text-sm px-3 py-1',
'md' => 'text-base px-4 py-1.5',
'lg' => 'text-lg px-5 py-2',
];

$colorClass = $colors[$color]; // Default ke 'blue' jika tidak ditemukan
$sizeClass = $sizes[$size] ?? $sizes['xs']; // Default ke 'xs' jika tidak ditemukan
@endphp

<span class="font-medium me-2 rounded-full h-fit {{ $colorClass }} {{ $sizeClass }}">
  {{ $slot }}
</span>