<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card - {{ $member->member_id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            margin: 0;
        }

        .id-card {
            width: 5.4cm; 
            height: 8.6cm;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            overflow: hidden;
            position: relative;
            background-image: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            border: 1px solid #d1d5db;
        }

        /* Banner at top */
        .id-header {
            background: linear-gradient(135deg, #4f46e5, #3730ae);
            color: #fff;
            text-align: center;
            padding: 15px 10px;
            position: relative;
        }

        .id-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .id-header p {
            margin: 3px 0 0;
            font-size: 9px;
            opacity: 0.8;
        }

        /* Profile pic placeholder */
        .profile-container {
            text-align: center;
            margin-top: -25px; /* overlap header */
            position: relative;
            z-index: 2;
        }

        .profile-pic {
            width: 70px;
            height: 70px;
            background: #cbd5e1;
            border-radius: 50%;
            border: 4px solid #fff;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #475569;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Details */
        .id-details {
            text-align: center;
            padding: 10px 15px;
        }

        .id-details h2 {
            margin: 5px 0 2px;
            font-size: 18px;
            font-weight: 800;
            color: #111827;
        }

        .id-details .member-id {
            color: #4f46e5;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            text-align: center;
            margin-top: 10px;
        }

        .info-item {
            font-size: 10px;
            color: #4b5563;
        }

        .info-item strong {
            display: block;
            color: #111827;
            font-size: 11px;
            font-weight: 700;
        }

        .id-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #1e293b;
            color: white;
            text-align: center;
            padding: 8px 0;
            font-size: 9px;
            letter-spacing: 0.5px;
        }

        .status-badge {
            display: inline-block;
            background: {{ $member->status == 'active' ? '#16a34a' : '#dc2626' }};
            color: white;
            font-size: 9px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .print-btn {
            padding: 12px 25px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            margin-bottom: 30px;
        }

        @media print {
            body { background: white; padding: 0; }
            .print-btn { display: none; }
            .id-card { box-shadow: none; border: 1px solid #000; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn">Print ID Card</button>

    <!-- CR80 Standard Vertical Wallet Size -->
    <div class="id-card">
        <div class="id-header">
            <h3>{{ $member->gym->gym_name ?? 'Fitness Center' }}</h3>
            <p>MEMBER IDENTIFICATION</p>
        </div>

        <div class="profile-container">
            <!-- If we had standard images, we'd use <img src=""> here. Failing that, use initials -->
            <div class="profile-pic">
                {{ strtoupper(substr($member->name, 0, 2)) }}
            </div>
        </div>

        <div class="id-details">
            <h2>{{ $member->name }}</h2>
            <div class="member-id">{{ $member->member_id }}</div>

            <div class="info-grid">
                <div class="info-item">
                    <strong>Phone</strong>
                    {{ $member->mobile }}
                </div>
                <div class="info-item">
                    <strong>Validity</strong>
                    {{ \Carbon\Carbon::parse($member->start_date)->format('d M y') }} - {{ \Carbon\Carbon::parse($member->end_date)->format('d M y') }}
                </div>
            </div>

            <div class="status-badge">
                {{ $member->status }}
            </div>
        </div>

        <div class="id-footer">
            {{ $member->gym->mobile ?? 'Contact Gym Reception' }}
        </div>
    </div>

</body>
</html>
