<?php

namespace App\Imports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\ToModel;

class TicketsImport implements ToModel
{
    public function model(array $row)
    {
        // Lewati baris header
        if ($row[0] === 'NO') {
            return null;
        }

        return new Ticket([
            'bib_number'   => $row[1], // NOMOR BIB
            'name'         => $row[2], // NAMA
            'category'     => $row[3], // KATEGORI
            'jersey_size'  => $row[4], // UKURAN JERSEY
            'phone_number' => $row[5], // NOMOR HENDPHONE
            'email'        => $row[6], // ALAMAT EMAIL
        ]);
    }
}

