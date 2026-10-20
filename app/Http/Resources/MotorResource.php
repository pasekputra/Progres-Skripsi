<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource untuk model Motor.
 * Aman untuk publik: tidak menampilkan riwayat pembayaran.
 */
class MotorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nama'           => $this->nama,
            'merk'           => $this->merk,
            'tahun_produksi' => $this->tahun_produksi,
            'harga_per_hari' => (float) $this->harga_per_hari,
            // URL lengkap gambar (asumsi disimpan di storage/app/public/motor).
            // Sesuaikan foldernya dengan tempat Anda menyimpan gambar.
            'gambar_url'     => $this->gambar ? asset('storage/motor/' . $this->gambar) : null,
            'deskripsi'      => $this->deskripsi,
            'status'         => $this->status,
            'tersedia'       => $this->isTersedia(),

            // Kategori hanya tampil jika di-load: Motor::with('kategori')
            'kategori'       => $this->whenLoaded('kategori', fn () => [
                'id'   => $this->kategori->id,
                'nama' => $this->kategori->nama,
            ]),
        ];
    }
}