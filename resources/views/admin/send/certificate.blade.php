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
        <h2>Certificate</h2>
        <p>Dear {{ ucfirst($details['name']) }},</p>
        <p>We sincerely extend our heartfelt gratitude to you for your esteemed presence and active participation at our
            recent event, {{ $details['title'] }}, held on {{ $details['date'] }}. Your enthusiasm and engagement truly
            enriched the event's atmosphere.</p>
        <p>As a token of our appreciation, we are thrilled to present you with a certificate recognizing your
            significant contribution to {{ $details['title'] }}. Your insights and contributions played a pivotal role
            in the
            success of the event, and we are genuinely grateful for your involvement.</p>
        <p>This certificate serves as a lasting memento of your dedication and commitment to making
            {{ $details['title'] }} a
            remarkable experience for all attendees. Your presence and valuable insights are greatly valued, and we hope
            to continue this collaborative journey in the future.</p>
        <p>We look forward to more opportunities to connect, learn, and grow together. Once again, thank you for being
            an integral part of {{ $details['title'] }} and for making it a truly memorable occasion.</p>
        <p>Thank you</p>
    </div>
</body>

</html>
