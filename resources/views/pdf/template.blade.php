{{-- <!DOCTYPE html>
<html>

<head>
    <title>Laporan Buy Request Agen PDF</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'poppins', 'sans-serif';
            background: white;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
            background: #fff;
            box-sizing: border-box;
        }


        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 120px;
        }

        .title {
            text-align: right;
            flex-grow: 1;
            /* Ensures the title takes up available space */
        }

        .title h2 {
            font-size: 18px;
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .info .row {
            flex-wrap: wrap;
            /* Allows wrapping if content exceeds space */
            gap: 10px;
            /* Adds spacing between elements */
        }

        .info p {
            margin: 0;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 10px;
            /* Adjusted font size */
            word-wrap: break-word;
        }

        table thead {
            background: #f9f9f9;
        }

        .totals {
            font-size: 14px;
            margin-top: 10px;
        }

        .signature {
            margin-top: 40px;
            font-size: 14px;
            color: #555;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-white py-4 px-8">
    <div class="page max-w-4xl mx-auto bg-white p-6 border border-gray-300">
        <div class="flex items-center justify-between mb-4">
            <img src="{{ asset('assets/images/logo/type_logo.png') }}" alt="" class="w-32">
            <div class="title">
                <h2 class="text-xl font-bold">LAPORAN BUY REQUEST AGEN</h2>
            </div>
        </div>

        <div class="mb-6 text-sm">
            <div class="flex justify-between">
                <p><span class="font-bold">Agen ID</span>:&nbsp; 1</p>
                <p class="text-right"><span class="font-bold">Tanggal laporan</span>: 31 Oktober 2023</p>
            </div>
            <div class="flex justify-between">
                <p><span class="font-bold">Agen Nama</span>:&nbsp; Sani</p>
                <p class="text-right"><span class="font-bold">Periode laporan</span>: Oktober 2023</p>
            </div>
        </div>

        <table class="w-full border border-gray-400 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">Nama Pembeli</th>
                    <th class="border px-2 py-1">Tipe Transaksi/Listing</th>
                    <th class="border px-2 py-1">Total(KT/KM)</th>
                    <th class="border px-2 py-1">Harga Sekitar(Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-2 py-1">Laptop</td>
                    <td class="border px-2 py-1">Merek X</td>
                    <td class="border px-2 py-1">10</td>
                    <td class="border px-2 py-1">5</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 text-sm">
            <p><span class="font-bold">Total Buy Request</span>: 3 Pembeli</p>
        </div>

        <div class="mt-6 text-sm">
            <p class="text-gray-600">[Nama dan Tanda Tangan Manajer Gudang]</p>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">
    @php
        use Carbon\Carbon;
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Laporan Buy Request</title>
    <style>
        body {
            font-family: 'poppins', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
            /* Ensures items are on opposite sides */
            align-items: center;
            /* Vertically centers the text */
            margin-bottom: 10px;
            /* Adds space between rows */
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .row p {
            margin: 0;
            /* Removes default margin */
            font-size: 16px;
            font-weight: bold;
        }

        .info {
            font-size: 14px;
            /* Adjust font size if needed */
        }

        .table-bordered {
            border-collapse: collapse;
            width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<?php
$listingType = [
        1 => 'Rumah',
        2 => 'Toko',
        3 => 'Apartemen',
        4 => 'Hotel',
        5 => 'Office',
        6 => 'Pabrik',
        7 => 'Gudang',
        8 => 'Gedung',
        9 => 'Soho',
        10 => 'Ruko',
        11 => 'Tanah',
        12 => 'Toko',
        13 => 'Villa',
    ];
?>

<body>
    <div class="container">
        <div class="header" style="display: flex; align-items: center;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/logo/type_logo.png'))) }}" alt="Dealkan Logo" style="height: 35px; width: 200px; margin-right: 10px;">
            <div class="title" style="display: inline;">
                <h1 style="margin-top: 20px;">LAPORAN BUY REQUEST AGEN</h1>
            </div>
        </div>
        <div class="container">
            <table class="table" style="margin-bottom: 20px; margin-top: 20px">

                <tbody>
                    <tr>
                        <td class="text-right"><strong>Periode Laporan</strong>:&nbsp;

                            @if ($dateStart == $dateEnd)
                                {{ \Carbon\Carbon::parse($dateStart)->translatedFormat('F Y') }}
                                @else
                                {{ \Carbon\Carbon::parse($dateStart)->translatedFormat('j F Y') }} -
                                {{ \Carbon\Carbon::parse($dateEnd)->translatedFormat('j F Y') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>Tanggal Pembuatan Laporan</strong>:&nbsp; {{ Carbon::now()->format('j F Y') }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <table class="table table-bordered" style="margin-bottom: 10px;">
            <thead>
                <tr>
                    <th colspan="8" style="text-align: center;">
                        <strong>Buy Request Detail</strong>
                    </th>
                </tr>
                <tr style="font-size: 12px;">
                    <th>Kode</th>
                    <th style="width: 100px">Tanggal</th>
                    <th style="width: 60px">Nama Agen</th>
                    <th style="width: 60px">Nama Pembeli</th>
                    <th>Tipe Transaksi/Listing</th>
                    <th>L.Tanah Sekitar</th>
                    <th style="width: 60px">L.Bangunan Sekitar</th>
                    <th>Harga Sekitar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buyRequests as $data)
                    <tr>
                        <td style="font-size: 12px;">{{ $data->requestID }}</td>
                        <td style="font-size: 12px;">{{ $data->created_at->format('j-F-Y') }}</td>
                        <td style="font-size: 12px;">{{ $data->agent_name }}</td>
                        <td style="font-size: 12px;">{{ $data->buyerName }}</td>
                        <td style="font-size: 12px;"> @if ($data->transaksiID == 1)
                            Dijual
                        @elseif ($data->transaksiID == 0)
                            Disewa
                        @else
                            Unknown
                        @endif / {{ $listingType[$data->listingType] ?? 'Unknown' }}</td>
                        <td style="font-size: 12px;">@if (isset($data->luasTanahMin) && isset($data->luasTanahMax))
                            {{ $data->luasTanahMin }} m<sup>2</sup><br> -
                            <br>{{ $data->luasTanahMax }}
                            m<sup>2</sup>
                        @else
                            0 m<sup>2</sup>
                        @endif</td>
                        <td style="font-size: 12px;">@if (isset($data->luasBangunanMin) && isset($data->luasBangunanMax))
                            {{ $data->luasBangunanMin }} m<sup>2</sup><br> -
                            <br>{{ $data->luasBangunanMax }} m<sup>2</sup>
                        @else
                            0 m<sup>2</sup>
                        @endif</td>
                        <td style="font-size: 12px;">
                            @if (isset($data->hargaJualMin) && isset($data->hargaJualMax))
                                Rp.{{ format_price($data->hargaJualMin) }}
                                <br> -
                                <br>Rp.{{ format_price($data->hargaJualMax) }}
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-sm">
            <p><span style="font-weight: bold">Total Buy Request</span>: {{$buyRequests->count()}} Pembeli</p>
        </div>

        {{-- <p style="text-align: center ; margin-bottom: 0">{{ Carbon::now()->format('j F Y') }}</p> --}}
        {{-- <p style="text-align: center">Mengetahui,</p>

        <div style="margin-top: 150px; display: flex; justify-content: space-between; align-items: flex-end;">
            <p style="text-align: center">(Ryo Luisada - Principal Of Dealkan)</p>
        </div> --}}
    </div>
</body>

</html>
