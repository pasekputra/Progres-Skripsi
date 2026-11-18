{{-- Pemakaian:
<x-admin.table>
    <x-slot:head><th class="px-4 py-3">Nama</th></x-slot:head>
    <tr><td class="px-4 py-3">...</td></tr>
</x-admin.table>
--}}
<div class="overflow-x-auto rounded-xl border border-orange-100 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-orange-100 text-left text-sm">
        @isset($head)
            <thead class="bg-orange-50 text-xs font-semibold uppercase tracking-wide text-orange-700">
                <tr>{{ $head }}</tr>
            </thead>
        @endisset
        <tbody class="divide-y divide-gray-100">
            {{ $slot }}
        </tbody>
    </table>
</div>
