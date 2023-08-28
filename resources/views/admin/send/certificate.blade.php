<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Boxity</title>
    <style type="text/css">
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Certificate</h1>
        <p>{{ ucfirst($details['name']) }} yang terhormat!</p>
        <p>Terima kasih atas kehadiran dan partisipasi aktif Anda di {{ ucfirst($details['title']) }} kami baru-baru
            ini, yang
            diadakan pada tanggal {{ $details['date'] }}. Antusiasme dan keterlibatan Anda benar-benar memperkaya
            suasana acara.</p>
        <p>Sebagai bentuk apresiasi kami, dengan senang hati kami mempersembahkan kepada Anda sertifikat yang mengakui
            kontribusi signifikan Anda pada Acara Pengujian Hari ini.</p>
        <p>Sekali lagi, terima kasih telah menjadi bagian integral dari {{ ucfirst($details['title']) }}, dan
            menjadikannya acara yang
            benar-benar berkesan.</p>
        <p>Kami harap informasi ini bermanfaat bagi Anda.<br>Terima Kasih<br>Salam,</p>
        <br>
        <p>{{ ucfirst($details['title']) }}</p>
        {{-- <p>PT. Boxity Central Indonesia | #togetherWithBoxityERP</p> --}}
    </div>
</body>

</html>
