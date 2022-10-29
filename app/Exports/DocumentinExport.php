<?php

namespace App\Exports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentinExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Document::where('type', '=', 'masuk')
                            ->select('letter_number', 'letter_date', 'date_received', 'sender_name', 'receiver_name', 'regarding', 'viewer', 'description')
                            ->get();
    }

    public function headings(): array
    {
        return ["Nomor Surat", "Tanggal Surat", "Tanggal Diterima", "Pengirim", "Tujuan/Penerima", "Perihal", "Status", "Keterangan"];
    }
}
