<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $member->member_id }}</title>
    <!-- [Google Fonts] -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        .invoice-container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
            width: 100%;
        }
        .header .gym-details h2 {
            margin: 0;
            color: #4f46e5;
            font-weight: 800;
            font-size: 28px;
        }
        .header .gym-details p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }
        .header .invoice-details {
            text-align: right;
        }
        .invoice-details h1 {
            margin: 0;
            color: #111827;
            font-size: 32px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .invoice-details p {
            margin: 5px 0 0;
            color: #4b5563;
        }
        .section-title {
            margin-top: 30px;
            font-size: 16px;
            font-weight: 700;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        .member-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            width: 100%;
        }
        .member-info div {
            width: 48%;
        }
        .member-info p {
            margin: 8px 0;
            font-size: 15px;
        }
        .member-info strong {
            display: inline-block;
            width: 120px;
            color: #6b7280;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .table th {
            background-color: #f9fafb;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            font-size: 13px;
        }
        .table td {
            font-size: 15px;
            color: #111827;
        }
        .totals-wrapper {
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }
        .totals {
            margin-top: 30px;
            width: 300px;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 16px;
        }
        .totals-row.grand {
            font-weight: 800;
            font-size: 20px;
            color: #4f46e5;
            border-bottom: none;
            border-top: 2px solid #e5e7eb;
            padding-top: 15px;
        }
        .footer {
            margin-top: 80px;
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .print-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 15px;
            background: #4f46e5;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        @media print {
            body { 
                background: white; 
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .invoice-container { 
                box-shadow: none; 
                margin: 0; 
                padding: 0; 
                width: 100%; 
                max-width: 100%; 
            }
            .print-btn { display: none !important; }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn">Print Invoice</button>

    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="gym-details">
                <h2>{{ $member->gym->gym_name ?? 'Gym Partner' }}</h2>
                <p>{{ $member->gym->address ?? 'Gym Address' }}</p>
                <p>Phone: {{ $member->gym->mobile ?? '' }}</p>
            </div>
            <div class="invoice-details" style="text-align: right;">
                <h1>INVOICE</h1>
                <p><strong>Date:</strong> {{ date('d M, Y') }}</p>
                <p><strong>Invoice No:</strong> #INV-{{ $member->id }}{{ rand(100,999) }}</p>
            </div>
        </div>

        <!-- Member Info -->
        <div class="section-title">BILL TO</div>
        <div class="member-info">
            <div>
                <p><strong>Member Name:</strong> <span style="font-weight:700; color:#111827;">{{ $member->name }}</span></p>
                <p><strong>Member ID:</strong> {{ $member->member_id }}</p>
                <p><strong>Mobile:</strong> {{ $member->mobile }}</p>
            </div>
            <div>
                <p><strong>Join Date:</strong> {{ \Carbon\Carbon::parse($member->start_date)->format('d M, Y') }}</p>
                <p><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($member->end_date)->format('d M, Y') }}</p>
                <p><strong>Status:</strong> <span style="text-transform:uppercase; font-weight:700; color: {{ $member->status == 'active' ? '#16a34a' : '#dc2626' }};">{{ $member->status }}</span></p>
            </div>
        </div>

        <!-- Fees Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align:right;">Duration</th>
                    <th style="text-align:right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gym Membership Plan</td>
                    <td style="text-align:right;">{{ $member->plan_duration }}</td>
                    <td style="text-align:right;">₹ {{ number_format($member->total_fees, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-wrapper">
            <div class="totals">
                <div class="totals-row">
                    <span>Total Amount:</span>
                    <span>₹ {{ number_format($member->total_fees, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span>Amount Paid:</span>
                    <span style="color:#16a34a; font-weight:bold;">- ₹ {{ number_format($member->amount_paid, 2) }}</span>
                </div>
                <div class="totals-row grand">
                    <span>Pending Dues:</span>
                    <span style="color: {{ $member->pending_amount > 0 ? '#dc2626' : '#16a34a' }};">₹ {{ number_format($member->pending_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Thank you for being a part of {{ $member->gym->gym_name ?? 'our gym' }}!<br>
            For any queries, please approach the reception.
        </div>
    </div>

</body>
</html>
