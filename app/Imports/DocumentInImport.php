<?php

namespace App\Imports;

use App\Models\Document;
use App\Models\Receiver;
use App\Models\Sender;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocumentInImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if ($row['email_pengirim'] != null) {
                $sender = Sender::where('email', '=', $row['email_pengirim'])->first();
                if ($sender) {
                    if ($row['email_penerima'] != null) {
                        $receiver = Receiver::where('email', '=', $row['email_penerima'])->first();
                        if($receiver) {
                            Document::create([
                                'type'           => 'masuk',
                                'letter_number'  => $row['no_surat'],
                                'letter_date'    => $row['tanggal_surat'],
                                'date_received'  => $row['tanggal_diterima'],
                                'sender_id'      => $sender->id,
                                'sender_name'    => $sender->name,
                                'sender_email'   => $sender->email,
                                'receiver_id'    => $receiver->id,
                                'receiver_name'  => $receiver->name,
                                'receiver_email' => $receiver->email,
                                'regarding'      => $row['perihal'],
                                'file'           => 'document/'.$row['nama_file'],
                                'viewer'         => $row['view'],
                                'disposisi_set'  => $row['status_disposisi'],
                                'description'    => $row['keterangan']
                            ]);
                        } else {
                            Receiver::create([
                                'user_id'   => 0,
                                'name'      => $row['tujuan_atau_penerima'],
                                'email'     => $row['email_penerima'],
                                'lembaga'   => 'Teknik Komputer',
                            ]);
                            // $receiver_1 = Receiver::where('email', '=', $row['email_penerima'])->latest()->first();
                            $receiver_1 = Receiver::all()->last();
                            Document::create([
                                'type'           => 'masuk',
                                'letter_number'  => $row['no_surat'],
                                'letter_date'    => $row['tanggal_surat'],
                                'date_received'  => $row['tanggal_diterima'],
                                'sender_id'      => $sender->id,
                                'sender_name'    => $sender->name,
                                'sender_email'   => $sender->email,
                                'receiver_id'    => $receiver_1->id,
                                'receiver_name'  => $receiver_1->name,
                                'receiver_email' => $receiver_1->email,
                                'regarding'      => $row['perihal'],
                                'file'           => 'document/'.$row['nama_file'],
                                'viewer'         => $row['view'],
                                'disposisi_set'  => $row['status_disposisi'],
                                'description'    => $row['keterangan']
                            ]);
                        }
                    } else {
                        Receiver::create([
                            'user_id'   => 0,
                            'name'      => $row['tujuan_atau_penerima'],
                            'email'     => $row['email_penerima'],
                            'lembaga'   => 'Teknik Komputer',
                        ]);
                        // $receiver_2 = Receiver::where('email', '=', $row['email_penerima'])->latest()->first();
                        $receiver_2 = Receiver::all()->last();
                        Document::create([
                            'type'           => 'masuk',
                            'letter_number'  => $row['no_surat'],
                            'letter_date'    => $row['tanggal_surat'],
                            'date_received'  => $row['tanggal_diterima'],
                            'sender_id'      => $sender->id,
                            'sender_name'    => $sender->name,
                            'sender_email'   => $sender->email,
                            'receiver_id'    => $receiver_2->id,
                            'receiver_name'  => $receiver_2->name,
                            'receiver_email' => $receiver_2->email,
                            'regarding'      => $row['perihal'],
                            'file'           => 'document/'.$row['nama_file'],
                            'viewer'         => $row['view'],
                            'disposisi_set'  => $row['status_disposisi'],
                            'description'    => $row['keterangan']
                        ]);
                    }
                } else {
                    if ($row['email_penerima'] != null) {
                        $receiver_3 = Receiver::where('email', '=', $row['email_penerima'])->first();
                        if ($receiver_3) {
                            Sender::create([
                                'user_id'   => 0,
                                'name'      => $row['nama_pengirim'],
                                'email'     => $row['email_pengirim'],
                                'lembaga'   => $row['lembaga_pengirim'],
                            ]);
                            // $sender_1 = Sender::where('email', '=', $row['email_pengirim'])->latest()->first();
                            $sender_1 = Sender::all()->last();
                            Document::create([
                                'type'           => 'masuk',
                                'letter_number'  => $row['no_surat'],
                                'letter_date'    => $row['tanggal_surat'],
                                'date_received'  => $row['tanggal_diterima'],
                                'sender_id'      => $sender_1->id,
                                'sender_name'    => $sender_1->name,
                                'sender_email'   => $sender_1->email,
                                'receiver_id'    => $receiver_3->id,
                                'receiver_name'  => $receiver_3->name,
                                'receiver_email' => $receiver_3->email,
                                'regarding'      => $row['perihal'],
                                'file'           => 'document/'.$row['nama_file'],
                                'viewer'         => $row['view'],
                                'disposisi_set'  => $row['status_disposisi'],
                                'description'    => $row['keterangan']
                            ]);
                        } else {
                            Sender::create([
                                'user_id'   => 0,
                                'name'      => $row['nama_pengirim'],
                                'email'     => $row['email_pengirim'],
                                'lembaga'   => $row['lembaga_pengirim'],
                            ]);
                            // $sender_2 = Sender::where('email', '=', $row['email_pengirim'])->latest()->first();
                            $sender_2 = Sender::all()->last();
                            Receiver::create([
                                'user_id'   => 0,
                                'name'      => $row['tujuan_atau_penerima'],
                                'email'     => $row['email_penerima'],
                                'lembaga'   => 'Teknik Komputer',
                            ]);
                            // $receiver_4 = Receiver::where('email', '=', $row['email_penerima'])->latest()->first();
                            $receiver_4 = Receiver::all()->last();
                            Document::create([
                                'type'           => 'masuk',
                                'letter_number'  => $row['no_surat'],
                                'letter_date'    => $row['tanggal_surat'],
                                'date_received'  => $row['tanggal_diterima'],
                                'sender_id'      => $sender_2->id,
                                'sender_name'    => $sender_2->name,
                                'sender_email'   => $sender_2->email,
                                'receiver_id'    => $receiver_4->id,
                                'receiver_name'  => $receiver_4->name,
                                'receiver_email' => $receiver_4->email,
                                'regarding'      => $row['perihal'],
                                'file'           => 'document/'.$row['nama_file'],
                                'viewer'         => $row['view'],
                                'disposisi_set'  => $row['status_disposisi'],
                                'description'    => $row['keterangan']
                            ]);
                        }
                    } else {
                        Sender::create([
                            'user_id'   => 0,
                            'name'      => $row['nama_pengirim'],
                            'email'     => $row['email_pengirim'],
                            'lembaga'   => $row['lembaga_pengirim'],
                        ]);
                        // $sender_3 = Sender::where('email', '=', $row['email_pengirim'])->latest()->first();
                        $sender_3 = Sender::all()->last();
                        Receiver::create([
                            'user_id'   => 0,
                            'name'      => $row['tujuan_atau_penerima'],
                            'email'     => $row['email_penerima'],
                            'lembaga'   => 'Teknik Komputer',
                        ]);
                        // $receiver_5 = Receiver::where('email', '=', $row['email_penerima'])->latest()->first();
                        $receiver_5 = Receiver::all()->last();
                        Document::create([
                            'type'           => 'masuk',
                            'letter_number'  => $row['no_surat'],
                            'letter_date'    => $row['tanggal_surat'],
                            'date_received'  => $row['tanggal_diterima'],
                            'sender_id'      => $sender_3->id,
                            'sender_name'    => $sender_3->name,
                            'sender_email'   => $sender_3->email,
                            'receiver_id'    => $receiver_5->id,
                            'receiver_name'  => $receiver_5->name,
                            'receiver_email' => $receiver_5->email,
                            'regarding'      => $row['perihal'],
                            'file'           => 'document/'.$row['nama_file'],
                            'viewer'         => $row['view'],
                            'disposisi_set'  => $row['status_disposisi'],
                            'description'    => $row['keterangan']
                        ]);
                    }
                }
            } else {
                if ($row['email_penerima'] != null) {
                    $receiver_6 = Receiver::where('email', '=', $row['email_penerima'])->first();
                    if ($receiver_6) {
                        Sender::create([
                            'user_id'   => 0,
                            'name'      => $row['nama_pengirim'],
                            'email'     => $row['email_pengirim'],
                            'lembaga'   => $row['lembaga_pengirim'],
                        ]);
                        // $sender_4 = Sender::where('email', '=', $row['email_pengirim'])->latest()->first();
                        $sender_4 = Sender::all()->last();
                        Document::create([
                            'type'           => 'masuk',
                            'letter_number'  => $row['no_surat'],
                            'letter_date'    => $row['tanggal_surat'],
                            'date_received'  => $row['tanggal_diterima'],
                            'sender_id'      => $sender_4->id,
                            'sender_name'    => $sender_4->name,
                            'sender_email'   => $sender_4->email,
                            'receiver_id'    => $receiver_6->id,
                            'receiver_name'  => $receiver_6->name,
                            'receiver_email' => $receiver_6->email,
                            'regarding'      => $row['perihal'],
                            'file'           => 'document/'.$row['nama_file'],
                            'viewer'         => $row['view'],
                            'disposisi_set'  => $row['status_disposisi'],
                            'description'    => $row['keterangan']
                        ]);
                    } else {
                        Sender::create([
                            'user_id'   => 0,
                            'name'      => $row['nama_pengirim'],
                            'email'     => $row['email_pengirim'],
                            'lembaga'   => $row['lembaga_pengirim'],
                        ]);
                        // $sender_5 = Sender::where('email', '=', $row['email_pengirim'])->latest()->first();
                        $sender_5 = Sender::all()->last();
                        Receiver::create([
                            'user_id'   => 0,
                            'name'      => $row['tujuan_atau_penerima'],
                            'email'     => $row['email_penerima'],
                            'lembaga'   => 'Teknik Komputer',
                        ]);
                        // $receiver_7 = Receiver::where('email', '=', $row['email_penerima'])->latest()->first();
                        $receiver_7 = Receiver::all()->last();
                        Document::create([
                            'type'           => 'masuk',
                            'letter_number'  => $row['no_surat'],
                            'letter_date'    => $row['tanggal_surat'],
                            'date_received'  => $row['tanggal_diterima'],
                            'sender_id'      => $sender_5->id,
                            'sender_name'    => $sender_5->name,
                            'sender_email'   => $sender_5->email,
                            'receiver_id'    => $receiver_7->id,
                            'receiver_name'  => $receiver_7->name,
                            'receiver_email' => $receiver_7->email,
                            'regarding'      => $row['perihal'],
                            'file'           => 'document/'.$row['nama_file'],
                            'viewer'         => $row['view'],
                            'disposisi_set'  => $row['status_disposisi'],
                            'description'    => $row['keterangan']
                        ]);
                    }
                } else {
                    Sender::create([
                        'user_id'   => 0,
                        'name'      => $row['nama_pengirim'],
                        'email'     => $row['email_pengirim'],
                        'lembaga'   => $row['lembaga_pengirim'],
                    ]);
                    // $sender_6 = Sender::where('email', '=', $row['email_pengirim'])->latest()->first();
                    $sender_6 = Sender::all()->last();
                    Receiver::create([
                        'user_id'   => 0,
                        'name'      => $row['tujuan_atau_penerima'],
                        'email'     => $row['email_penerima'],
                        'lembaga'   => 'Teknik Komputer',
                    ]);
                    // $receiver_8 = Receiver::where('email', '=', $row['email_penerima'])->latest()->first();
                    $receiver_8 = Receiver::all()->last();
                    Document::create([
                        'type'           => 'masuk',
                        'letter_number'  => $row['no_surat'],
                        'letter_date'    => $row['tanggal_surat'],
                        'date_received'  => $row['tanggal_diterima'],
                        'sender_id'      => $sender_6->id,
                        'sender_name'    => $sender_6->name,
                        'sender_email'   => $sender_6->email,
                        'receiver_id'    => $receiver_8->id,
                        'receiver_name'  => $receiver_8->name,
                        'receiver_email' => $receiver_8->email,
                        'regarding'      => $row['perihal'],
                        'file'           => 'document/'.$row['nama_file'],
                        'viewer'         => $row['view'],
                        'disposisi_set'  => $row['status_disposisi'],
                        'description'    => $row['keterangan']
                    ]);
                }
            }
        }
    }
    
}
