<?php

namespace App\Imports;

use App\Models\Mobil;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MobilImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $ke = 1;
        foreach ($collection as $row) {
            if ($ke >1) {
                
                $merk = !empty($row[0]) ? $row[0] : "";

                if(!$merk){
                    break;
                }

                $data['user_id'] = auth()->user()->id;
                $data['merk'] = $merk;
                $data['type'] = $row[1];
                $data['tahun'] = $row[2];
                $data['harga'] = $row[3];


                Mobil::create($data);
            }
            $ke++;
        }
    }
}
