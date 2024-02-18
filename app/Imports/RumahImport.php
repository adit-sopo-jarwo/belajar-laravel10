<?php

namespace App\Imports;

use App\Models\Rumah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RumahImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $ke = 1;
        foreach ($collection as $row) {
            if ($ke > 1) {

                $type = !empty($row[0]) ? $row[0] : "";

                if(!$type){
                    break;
                }

                $data['user_id'] = auth()->user()->id;
                $data['type'] = $type;
                $data['harga'] = $row[1];
                $data['lokasi'] = $row[2];


                Rumah::create($data);
            }
            $ke++;
        }
    }
}
