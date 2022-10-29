<?php

namespace App\Imports;

use App\Models\Document;
use App\Models\Receiver;
use App\Models\Sender;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocumentOutImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            if ($row['email_penerima'] != null) {
                $receiver = Receiver::where('email', '=', $row['email_penerima'])->first();
                if ($receiver) {
                    if ($row['email_pengirim'] != null) {
                        $sender = Sender::where('email', '=', $row['email_pengirim'])->first();
                        if ($sender) {
                            Document::create([
                                'type'              => 'keluar',
                                'letter_number'     => $row['no_surat'],
                                'letter_date'       => $row['tanggal_surat'],
                                'receiver_id'       => $receiver->id,
                                'receiver_name'     => $receiver->name,
                                'receiver_email'    => $receiver->email,
                                'sender_id'         => $sender->id,
                                'sender_name'       => $sender->name,
                                'sender_email'      => $sender->email,
                                'regarding'         => $row['perihal'],
                                'file'              => 'document/'.$row['nama_file'],
                                'viewer'            => $row['view'],
                                'description'       => $row['keterangan'],
                            ]);
                        } else {
                            Sender::create([
                                'user_id'   => 0,
                                'name'      => $row['nama_pengirim'],
                                'email'     => $row['email_pengirim'],
                                'lembaga'   => 'Teknik Komputer',
                            ]);
                            $sender_1 = Sender::all()->last();
                            Document::create([
                                'type'              => 'keluar',
                                'letter_number'     => $row['no_surat'],
                                'letter_date'       => $row['tanggal_surat'],
                                'receiver_id'       => $receiver->id,
                                'receiver_name'     => $receiver->name,
                                'receiver_email'    => $receiver->email,
                                'sender_id'         => $sender_1->id,
                                'sender_name'       => $sender_1->name,
                                'sender_email'      => $sender_1->email,
                                'regarding'         => $row['perihal'],
                                'file'              => 'document/'.$row['nama_file'],
                                'viewer'            => $row['view'],
                                'description'       => $row['keterangan'],
                            ]);
                        }
                    } else {
                        Sender::create([
                            'user_id'   => 0,
                            'name'      => $row['nama_pengirim'],
                            'email'     => $row['email_pengirim'],
                            'lembaga'   => 'Teknik Komputer',
                        ]);
                        $sender_2 = Sender::all()->last();
                        Document::create([
                            'type'              => 'keluar',
                            'letter_number'     => $row['no_surat'],
                            'letter_date'       => $row['tanggal_surat'],
                            'receiver_id'       => $receiver->id,
                            'receiver_name'     => $receiver->name,
                            'receiver_email'    => $receiver->email,
                            'sender_id'         => $sender_2->id,
                            'sender_name'       => $sender_2->name,
                            'sender_email'      => $sender_2->email,
                            'regarding'         => $row['perihal'],
                            'file'              => 'document/'.$row['nama_file'],
                            'viewer'            => $row['view'],
                            'description'       => $row['keterangan'],
                        ]);
                    }
                } else {
                    if ($row['email_pengirim'] != null) {
                        $sender_3 = Sender::where('email', '=', $row['email_pengirim'])->first();
                        if ($sender_3) {
                            Receiver::create([
                                'user_id'   => 0,
                                'name'      => $row['tujuan_atau_penerima'],
                                'email'     => $row['email_penerima'],
                                'lembaga'   => $row['lembaga_tujuan'],
                            ]);
                            $receiver_1 = Receiver::all()->last();
                            Document::create([
                                'type'              => 'keluar',
                                'letter_number'     => $row['no_surat'],
                                'letter_date'       => $row['tanggal_surat'],
                                'receiver_id'       => $receiver_1->id,
                                'receiver_name'     => $receiver_1->name,
                                'receiver_email'    => $receiver_1->email,
                                'sender_id'         => $sender_3->id,
                                'sender_name'       => $sender_3->name,
                                'sender_email'      => $sender_3->email,
                                'regarding'         => $row['perihal'],
                                'file'              => 'document/'.$row['nama_file'],
                                'viewer'            => $row['view'],
                                'description'       => $row['keterangan'],
                            ]);
                        } else {
                            Receiver::create([
                                'user_id'   => 0,
                                'name'      => $row['tujuan_atau_penerima'],
                                'email'     => $row['email_penerima'],
                                'lembaga'   => $row['lembaga_tujuan'],
                            ]);
                            $receiver_2 = Receiver::all()->last();
                            Sender::create([
                                'user_id'   => 0,
                                'name'      => $row['nama_pengirim'],
                                'email'     => $row['email_pengirim'],
                                'lembaga'   => 'Teknik Komputer',
                            ]);
                            $sender_4 = Sender::all()->last();
                            Document::create([
                                'type'              => 'keluar',
                                'letter_number'     => $row['no_surat'],
                                'letter_date'       => $row['tanggal_surat'],
                                'receiver_id'       => $receiver_2->id,
                                'receiver_name'     => $receiver_2->name,
                                'receiver_email'    => $receiver_2->email,
                                'sender_id'         => $sender_4->id,
                                'sender_name'       => $sender_4->name,
                                'sender_email'      => $sender_4->email,
                                'regarding'         => $row['perihal'],
                                'file'              => 'document/'.$row['nama_file'],
                                'viewer'            => $row['view'],
                                'description'       => $row['keterangan'],
                            ]);
                        }
                    } else {
                        Receiver::create([
                            'user_id'   => 0,
                            'name'      => $row['tujuan_atau_penerima'],
                            'email'     => $row['email_penerima'],
                            'lembaga'   => $row['lembaga_tujuan'],
                        ]);
                        $receiver_3 = Receiver::all()->last();
                        Sender::create([
                            'user_id'   => 0,
                            'name'      => $row['nama_pengirim'],
                            'email'     => $row['email_pengirim'],
                            'lembaga'   => 'Teknik Komputer',
                        ]);
                        $sender_5 = Sender::all()->last();
                        Document::create([
                            'type'              => 'keluar',
                            'letter_number'     => $row['no_surat'],
                            'letter_date'       => $row['tanggal_surat'],
                            'receiver_id'       => $receiver_3->id,
                            'receiver_name'     => $receiver_3->name,
                            'receiver_email'    => $receiver_3->email,
                            'sender_id'         => $sender_5->id,
                            'sender_name'       => $sender_5->name,
                            'sender_email'      => $sender_5->email,
                            'regarding'         => $row['perihal'],
                            'file'              => 'document/'.$row['nama_file'],
                            'viewer'            => $row['view'],
                            'description'       => $row['keterangan'],
                        ]);
                    }
                }
            } else {
                if ($row['email_pengirim'] != null) {
                    $sender_6 = Sender::where('email', '=', $row['email_pengirim'])->first();
                    if ($sender_6) {
                        Receiver::create([
                            'user_id'   => 0,
                            'name'      => $row['tujuan_atau_penerima'],
                            'email'     => $row['email_penerima'],
                            'lembaga'   => $row['lembaga_tujuan'],
                        ]);
                        $receiver_4 = Receiver::all()->last();
                        Document::create([
                            'type'              => 'keluar',
                            'letter_number'     => $row['no_surat'],
                            'letter_date'       => $row['tanggal_surat'],
                            'receiver_id'       => $receiver_4->id,
                            'receiver_name'     => $receiver_4->name,
                            'receiver_email'    => $receiver_4->email,
                            'sender_id'         => $sender_6->id,
                            'sender_name'       => $sender_6->name,
                            'sender_email'      => $sender_6->email,
                            'regarding'         => $row['perihal'],
                            'file'              => 'document/'.$row['nama_file'],
                            'viewer'            => $row['view'],
                            'description'       => $row['keterangan'],
                        ]);
                    } else {
                        Receiver::create([
                            'user_id'   => 0,
                            'name'      => $row['tujuan_atau_penerima'],
                            'email'     => $row['email_penerima'],
                            'lembaga'   => $row['lembaga_tujuan'],
                        ]);
                        $receiver_5 = Receiver::all()->last();
                        Sender::create([
                            'user_id'   => 0,
                            'name'      => $row['nama_pengirim'],
                            'email'     => $row['email_pengirim'],
                            'lembaga'   => 'Teknik Komputer',
                        ]);
                        $sender_7 = Sender::all()->last();
                        Document::create([
                            'type'              => 'keluar',
                            'letter_number'     => $row['no_surat'],
                            'letter_date'       => $row['tanggal_surat'],
                            'receiver_id'       => $receiver_5->id,
                            'receiver_name'     => $receiver_5->name,
                            'receiver_email'    => $receiver_5->email,
                            'sender_id'         => $sender_7->id,
                            'sender_name'       => $sender_7->name,
                            'sender_email'      => $sender_7->email,
                            'regarding'         => $row['perihal'],
                            'file'              => 'document/'.$row['nama_file'],
                            'viewer'            => $row['view'],
                            'description'       => $row['keterangan'],
                        ]);
                    }
                } else {
                    Receiver::create([
                        'user_id'   => 0,
                        'name'      => $row['tujuan_atau_penerima'],
                        'email'     => $row['email_penerima'],
                        'lembaga'   => $row['lembaga_tujuan'],
                    ]);
                    $receiver_6 = Receiver::all()->last();
                    Sender::create([
                        'user_id'   => 0,
                        'name'      => $row['nama_pengirim'],
                        'email'     => $row['email_pengirim'],
                        'lembaga'   => 'Teknik Komputer',
                    ]);
                    $sender_8 = Sender::all()->last();
                    Document::create([
                        'type'              => 'keluar',
                        'letter_number'     => $row['no_surat'],
                        'letter_date'       => $row['tanggal_surat'],
                        'receiver_id'       => $receiver_6->id,
                        'receiver_name'     => $receiver_6->name,
                        'receiver_email'    => $receiver_6->email,
                        'sender_id'         => $sender_8->id,
                        'sender_name'       => $sender_8->name,
                        'sender_email'      => $sender_8->email,
                        'regarding'         => $row['perihal'],
                        'file'              => 'document/'.$row['nama_file'],
                        'viewer'            => $row['view'],
                        'description'       => $row['keterangan'],
                    ]);
                }
            }
        }
    }
}
