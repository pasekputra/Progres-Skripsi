<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MotorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [



         'data' => MotorResource::collection($this->collection),

        //  adding information paging

        "paging" => [


             "current_page" => $this->currentPage(),
                "total_page" => $this->lastPage(),
                "per_page" => $this->perPage(),
                "total_data" => $this->total(),

        ]
        ];
    }
}
