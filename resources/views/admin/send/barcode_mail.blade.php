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
            <h3>QrCode Attendance</h3>
        </div>
        <h2><b>Dear, {{ ucfirst($details['name']) }} !</b></h2>
        <p>
            We are excited to inform you that your registration for the {{ ucfirst($details['title']) }} has been
            successfully received. Thank you for choosing to be a part of this event!
        </p>
        <h3>Event Details:</h3>
        <ul>
            <li><strong>Event Name:</strong> {{ $details['title'] }}</li>
            <li><strong>Date:</strong> {{ $details['date'] }}</li>
            <li><strong>Time:</strong> {{ $details['start_time'] }}</li>
        </ul>
        <p>To ensure a smooth check-in process, please present the following QR code to the event staff upon your
            arrival:</p>
        <center>
            <img src="{{ $message->embed($details['qrcode_link']) }}" alt="Barcode">
        </center>
        <p>Our staff will use the QR code for verification of your attendance at the event. Your cooperation is greatly
            appreciated.</p>
        <p>If you have any questions or require further assistance, please do not hesitate to contact us.</p>
        <p>We hope this information is useful for you.<br>Thank you.<br>Best Regards,</p>
        <br>
        <p>PT. Boxity Central Indonesia | #togetherWithBoxityERP</p>
    </div>
</body>

</html>
