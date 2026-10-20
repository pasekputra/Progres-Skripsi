<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource untuk model Payment (transaksi sewa motor).
 * Data internal (id_xendit, data pelanggan) hanya tampil untuk admin.
 */
class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isAdmin = $request->user() instanceof Admin;

        return [
            'id'                   => $this->id,
            'nama_motor'           => $this->nama_motor,
            'tanggal_mulai'        => $this->tanggal_mulai?->format('Y-m-d'),
            'tanggal_selesai'      => $this->tanggal_selesai?->format('Y-m-d'),
            'total_hari'           => $this->total_hari,
            'jumlah'               => (float) $this->jumlah,
            'status'               => $this->status,
            'metode_pembayaran'    => $this->metode_pembayaran,
            // URL lengkap bukti bayar (asumsi disimpan di storage/app/public).
            'bukti_pembayaran_url' => $this->bukti_pembayaran
                ? asset('storage/' . $this->bukti_pembayaran)
                : null,
            'dibuat_pada'          => $this->created_at?->format('Y-m-d H:i:s'),

            // Motor hanya tampil jika di-load: Payment::with('motor')
            'motor'                => new MotorResource($this->whenLoaded('motor')),

            // Khusus admin
            'id_xendit'            => $this->when($isAdmin, $this->id_xendit),
            'pelanggan'            => $this->when(
                $isAdmin && $this->relationLoaded('user'),
                fn () => [
                    'id'       => $this->user->id,
                    'nama'     => $this->user->nama,
                    'email'    => $this->user->email,
                    'whatsapp' => $this->user->whatsapp,
                ]
            ),
        ];
    }
}