{{--
    Kolom isian berlabel + pesan error validasi.
    Pemakaian:
      <x-user.input label="Email" name="email" type="email" placeholder="nama@email.com" autocomplete="email" />
      <x-user.input label="Alamat" name="alamat" type="textarea" />
    Untuk type="password" otomatis ada tombol "Tampilkan".
--}}
@props([
    'label',
    'name',
    'type'         => 'text',
    'placeholder'  => '',
    'autocomplete' => null,
    'hint'         => null,
    'required'     => true,
])

@php
    $adaError = $errors->has($name);
    $kelas    = 'w-full rounded-xl border bg-white px-4 py-3 text-sm outline-none transition placeholder:text-muted/70 focus:ring-2 '
              . ($adaError
                    ? 'border-red-400 focus:border-red-500 focus:ring-red-200'
                    : 'border-line focus:border-brand focus:ring-brand/30');
@endphp

<div>
    <label for="{{ $name }}" class="mb-1.5 block text-[13px] font-semibold">{{ $label }}</label>

    <div class="relative">
        @if ($type === 'textarea')
            <textarea id="{{ $name }}" name="{{ $name }}" rows="3" placeholder="{{ $placeholder }}"
                      @if ($required) required @endif
                      {{ $attributes->merge(['class' => $kelas . ' resize-y']) }}>{{ old($name) }}</textarea>
        @elseif ($type === 'password')
            <input id="{{ $name }}" name="{{ $name }}" type="password" placeholder="{{ $placeholder }}"
                   @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                   @if ($required) required @endif
                   {{ $attributes->merge(['class' => $kelas . ' pr-28']) }}>
            <button type="button" data-toggle-password="{{ $name }}"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-brand-dark hover:text-brand">Tampilkan</button>
        @else
            <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}"
                   @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                   @if ($required) required @endif
                   {{ $attributes->merge(['class' => $kelas]) }}>
        @endif
    </div>

    @error($name)
        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
    @elseif ($hint)
        <p class="mt-1.5 text-xs text-muted">{{ $hint }}</p>
    @enderror
</div>

@if ($type === 'password')
    @once
        @push('scripts')
        <script>
            // Tombol "Tampilkan / Sembunyikan" kata sandi
            document.querySelectorAll('[data-toggle-password]').forEach((tombol) => {
                tombol.addEventListener('click', () => {
                    const input  = document.getElementById(tombol.dataset.togglePassword);
                    const tampil = input.type === 'password';
                    input.type = tampil ? 'text' : 'password';
                    tombol.textContent = tampil ? 'Sembunyikan' : 'Tampilkan';
                });
            });
        </script>
        @endpush
    @endonce
@endif