{{-- Pagination bertema Putri Ayu. Pemakaian: {{ $motors->links('vendor.pagination.user') }} --}}
@if ($paginator->hasPages())
    @php
        $dasar    = 'inline-flex size-10 items-center justify-center rounded-xl border text-sm font-semibold transition';
        $biasa    = 'border-line bg-white text-ink hover:border-brand hover:text-brand-dark';
        $aktif    = 'border-brand bg-brand text-ink';
        $nonaktif = 'cursor-not-allowed border-line bg-white text-muted/50';
    @endphp

    <nav role="navigation" aria-label="Navigasi halaman" class="flex flex-wrap items-center justify-center gap-2">

        {{-- Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="{{ $dasar }} {{ $nonaktif }}" aria-disabled="true" aria-label="Halaman sebelumnya">
                <i data-lucide="chevron-left" class="size-[18px]"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $dasar }} {{ $biasa }}" aria-label="Halaman sebelumnya">
                <i data-lucide="chevron-left" class="size-[18px]"></i>
            </a>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-1 text-muted">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="{{ $dasar }} {{ $aktif }}">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="{{ $dasar }} {{ $biasa }}" aria-label="Ke halaman {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Berikutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $dasar }} {{ $biasa }}" aria-label="Halaman berikutnya">
                <i data-lucide="chevron-right" class="size-[18px]"></i>
            </a>
        @else
            <span class="{{ $dasar }} {{ $nonaktif }}" aria-disabled="true" aria-label="Halaman berikutnya">
                <i data-lucide="chevron-right" class="size-[18px]"></i>
            </span>
        @endif
    </nav>
@endif