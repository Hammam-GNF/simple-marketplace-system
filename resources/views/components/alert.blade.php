@props([
    'type' => 'success',
    'message'
])

@php
    $colors = [
        'success' => 'bg-green-50 text-green-800 border-green-300',
        'error' => 'bg-red-50 text-red-800 border-red-300',
    ];
@endphp

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3500)"
    x-show="show"
    x-transition
    class="border rounded-md p-4 flex justify-between items-start {{ $colors[$type] }}"
>
    <p class="text-sm font-medium">
        {{ $message }}
    </p>

    <button
        @click="show = false"
        class="ml-4 text-sm font-bold opacity-70 hover:opacity-100"
    >
        ✕
    </button>
</div>
