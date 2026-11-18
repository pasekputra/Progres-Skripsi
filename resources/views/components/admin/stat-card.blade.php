@props(['label', 'value', 'hint' => null])

<div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
    <p class="text-sm text-gray-500">{{ $label }}</p>
    <p class="mt-2 text-2xl font-bold text-orange-600">{{ $value }}</p>
    @if ($hint)
        <p class="mt-1 text-xs text-gray-400">{{ $hint }}</p>
    @endif
</div>
