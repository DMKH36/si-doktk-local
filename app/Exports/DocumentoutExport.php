<?php

namespace App\Exports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentoutExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Document::where('type', '=', 'keluar')
                            ->select('letter_number', 'letter_date', 'receiver_name', 'regarding', 'description')
                            ->get();
    }

    public function headings(): array
    {
        return ["Nomor Surat", "Tanggal Surat", "Tujuan", "Perihal", "Keterangan"];
    }
}
