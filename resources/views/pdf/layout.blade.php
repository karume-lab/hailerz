<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Hailerz Document' }}</title>
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            color: #111827;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #223757;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .content {
            padding: 40px;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            margin-top: 50px;
            clear: both;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #223757;
            border-bottom: 2px solid #223757;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 8px 0;
            vertical-align: top;
        }
        table td.label {
            font-weight: bold;
            width: 30%;
            color: #555;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background: #f0f0f0;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        @php
            $logoPath = public_path('images/logo.webp');
            $mime = 'image/webp';
        @endphp
        @if(file_exists($logoPath))
            <img src="data:{{ $mime }};base64,{{ base64_encode(file_get_contents($logoPath)) }}" alt="Hailerz Logo">
        @endif
        <h1>Hailerz</h1>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Hailerz. All rights reserved.
    </div>
</body>
</html>
