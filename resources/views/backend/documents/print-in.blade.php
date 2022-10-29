<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            line-height: 1.2em;
            font-size: 12pt;
            margin: 0;

        }

        body {
            margin-left: 4;
        }

        .font-arial {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif
        }

        .font-cambria {
            font-family: Cambria, Georgia, serif
        }

        .text-center {
            text-align: center
        }

        .margin-bottom {
            margin-bottom: 1.2em
        }

        table {
            border-collapse: collapse;
            width: 100%
        }

        table.line-height-table {
            line-height: 2em
        }

        table .col-center {
            text-align: center
        }

        #header table td {
            padding: 5px
        }

        img.center {
            display: block;
            margin: 0 auto
        }

        img.logo {
            width: 93px;
            height: 123px
        }

        img.certificate {
            padding: 0 10px;
            width: 110px;
            height: 64px
        }

        .head-info td {
            vertical-align: top;
            font-size: 8pt
        }

        .yth {
            padding: 20px 0
        }

        .align-top {
            vertical-align: top
        }
    </style>
</head>

<body style="margin: 20px 50px">
    <section class="font-cambria text-center">
        <div class="yth">
            <h2>DATA SURAT MASUK<br>Departemen Teknik Komputer</h2>
            @if ($awal == null && $akhir == null)
                <h3>Per Tanggal {{ date('d-m-y') }}</h3>
            @else
                <h3>Dari Tanggal {{ $awal }} hingga {{ $akhir }}</h3>
            @endif
        </div>
    </section>
    <section>
        <table border="1" class="bordered highlight table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th width="65">Nomor Surat</th>
                    <th width="65">Tanggal Surat</th>
                    <th width="65">Tanggal Diterima</th>
                    <th>Pengirim</th>
                    <th>Tujuan</th>
                    <th width="250">Perihal</th>
                    <th>Status</th>
                    <th width="100">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($document as $key => $data)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $data->letter_number }}</td>
                        <td class="text-center">{{ $data->letter_date }}</td>
                        <td class="text-center">{{ $data->date_received }}</td>
                        <td>{{ $data->sender_name }}</td>
                        <td>{{ $data->receiver_name }}</td>
                        <td>{{ $data->regarding }}</td>
                        @if ($data->viewer == 'public')
                            <td class="text-center">Public</td>
                        @elseif ($data->viewer == 'mahasiswa')
                            <td class="text-center">Mahasiswa</td>
                        @elseif ($data->viewer == 'alumni')
                            <td class="text-center">Alumni</td>
                        @elseif ($data->viewer == 'ahasiswa-alumni')
                            <td class="text-center">Mahasiswa & Alumni</td>
                        @elseif ($data->viewer == 'private')
                            <td class="text-center">Private</td>
                        @elseif ($data->viewer == 'secret')
                            <td class="text-center">Rahasia</td>
                        @endif
                        <td>{{ $data->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>
