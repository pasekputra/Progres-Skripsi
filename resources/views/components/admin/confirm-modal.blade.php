{{-- Pemakaian:
<button type="button" data-modal-open="modal-hapus" data-action="{{ route('admin.motor.index') }}/1">Hapus</button>
<x-admin.confirm-modal id="modal-hapus" title="Hapus motor?" message="Data tidak bisa dikembalikan." confirm="Hapus" method="DELETE" />
--}}
@props(['id', 'title' => 'Yakin?', 'message' => '', 'confirm' => 'Ya, lanjutkan', 'method' => 'DELETE'])

<div id="{{ $id }}" data-modal class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-sm rounded-xl bg-white p-6 shadow-xl">
        <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
        @if ($message)
            <p class="mt-2 text-sm text-gray-500">{{ $message }}</p>
        @endif

        <form method="POST" action="#" class="mt-6 flex justify-end gap-2">
            @csrf
            @method($method)
            <button type="button" data-modal-close class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">Batal</button>
            <button type="submit" class="rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600">{{ $confirm }}</button>
        </form>
    </div>
</div>
