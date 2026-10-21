@php
    $kontak = config('rental.kontak');
    $sosmed = config('rental.sosmed');
@endphp

<footer class="border-t border-line bg-white pb-7 pt-14">
    <x-user.container>
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-[1.5fr_1fr_1fr_1.3fr]">

            <div>
                @include('user.partials.brand')
                <p class="mb-[18px] mt-3.5 max-w-[300px] text-[13px] text-muted">
                    Teman perjalanan terpercaya untuk menjelajahi Bali dengan aman, nyaman, dan tanpa ribet.
                </p>
                <div class="flex gap-2.5">
                    <a href="{{ $sosmed['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram"
                       class="inline-flex size-[42px] items-center justify-center rounded-full border border-line bg-white text-brand-dark transition hover:border-brand">
                        <i data-lucide="instagram" class="size-[18px]"></i>
                    </a>
                    <a href="https://wa.me/{{ $kontak['whatsapp'] }}" target="_blank" rel="noopener" aria-label="WhatsApp"
                       class="inline-flex size-[42px] items-center justify-center rounded-full border border-line bg-white text-brand-dark transition hover:border-brand">
                        <i data-lucide="message-circle" class="size-[18px]"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="mb-4 text-sm font-medium">Jelajahi</h4>
                <ul class="text-[13px] text-muted">
                    <li class="mb-2.5"><a href="{{ route('user.motor') }}" class="hover:text-brand-dark">Daftar Motor</a></li>
                    <li class="mb-2.5"><a href="{{ route('tentang') }}" class="hover:text-brand-dark">Tentang Kami</a></li>
                    <li class="mb-2.5"><a href="{{ route('kontak') }}" class="hover:text-brand-dark">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 text-sm font-medium">Bantuan</h4>
                <ul class="text-[13px] text-muted">
                    <li class="mb-2.5"><a href="#" class="hover:text-brand-dark">Syarat &amp; Ketentuan</a></li>
                    <li class="mb-2.5"><a href="#" class="hover:text-brand-dark">Kebijakan Privasi</a></li>
                    <li class="mb-2.5"><a href="#" class="hover:text-brand-dark">Pusat Bantuan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 text-sm font-medium">Hubungi Kami</h4>
                <ul class="text-[13px] text-muted">
                    <li class="mb-2.5 flex items-start gap-2.5">
                        <i data-lucide="map-pin" class="mt-0.5 size-[18px] text-brand-dark"></i>
                        <a href="{{ $kontak['maps'] }}" target="_blank" rel="noopener" class="hover:text-brand-dark">{{ $kontak['alamat'] }}</a>
                    </li>
                    <li class="mb-2.5 flex items-start gap-2.5">
                        <i data-lucide="phone" class="mt-0.5 size-[18px] text-brand-dark"></i>
                        <a href="tel:{{ $kontak['telepon'] }}" class="hover:text-brand-dark">{{ $kontak['telepon'] }}</a>
                    </li>
                    <li class="mb-2.5 flex items-start gap-2.5">
                        <i data-lucide="mail" class="mt-0.5 size-[18px] text-brand-dark"></i>
                        <a href="mailto:{{ $kontak['email'] }}" class="break-all hover:text-brand-dark">{{ $kontak['email'] }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-9 border-t border-line pt-[22px] text-center text-xs text-muted">
            &copy; {{ date('Y') }} {{ config('rental.nama') }}. Dibuat dengan hangat di Bali.
        </div>
    </x-user.container>
</footer>
