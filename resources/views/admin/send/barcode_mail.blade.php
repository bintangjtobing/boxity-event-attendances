<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Boxity</title>
    <style type="text/css">
        body {
            font-family: "Poppins", sans-serif;
        }

        p {
            color: black;
        }

        h3 {
            color: black;
        }

        .center {
            text-align: center;
        }

        .klik {
            color: #7364DB;
            text-decoration: none;
        }

        .container {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .image {
            width: 300px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="center">
            <h1>QrCode Attendance</h1>
        </div>
        <h2><b>Halo, {{ ucfirst($details['name']) }} !</b></h2>
        <p>
            Dengan senang hati kami informasikan bahwa pendaftaran Anda untuk {{ ucfirst($details['title']) }} telah
            berhasil diterima.
        </p>
        <h3>Event Details:</h3>
        <ul>
            <li><strong>Nama Acara :</strong> {{ $details['title'] }}</li>
            <li><strong>Tanggal :</strong> {{ $details['date'] }}</li>
            <li><strong>Waktu :</strong> {{ $details['start_time'] }}</li>
        </ul>
        <p>Untuk memastikan kelancaran proses check-in, harap tunjukkan kode QR berikut kepada staf acara pada saat
            kedatangan Anda :</p>
        <center>
            <img src="{{ $message->embed($details['qrcode_link']) }}" alt="QrCode">
        </center>
        <p>Kami harap informasi ini bermanfaat bagi Anda.</p>
        <p>Terima Kasih<br>Salam,<br><br>{{ ucfirst($details['title']) }}</p>
        {{-- <br>
        <p>PT. Boxity Central Indonesia | #togetherWithBoxityERP</p> --}}
    </div>
</body>

</html>
