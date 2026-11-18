@props(['title' => 'Belum ada data', 'text' => null])

<div class="rounded-xl border border-dashed border-orange-200 bg-white p-10 text-center">
    <p class="font-semibold text-gray-700">{{ $title }}</p>
    @if ($text)
        <p class="mt-1 text-sm text-gray-400">{{ $text }}</p>
    @endif
</div>
