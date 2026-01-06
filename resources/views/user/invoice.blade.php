<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background: white;
        }
        .invoice {
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
            padding: 20px;
            background: white;
        }
        .header-line {
            height: 5px;
            background: #4e73df;
            width: 100%;
            margin-bottom: 20px;
        }
        .header {
            margin-bottom: 30px;
        }
        .header table {
            width: 100%;
        }
        .logo {
            width: 40px;
            height: 40px;
            background: #4e73df;
            color: white;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            font-size: 20px;
        }
        .company {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }
        .tagline {
            font-size: 10px;
            color: #4e73df;
            text-transform: uppercase;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #4e73df;
            text-align: right;
        }
        .invoice-details {
            text-align: right;
            font-size: 11px;
            color: #666;
            margin-top: 10px;
        }
        .status {
            display: inline-block;
            padding: 4px 10px;
            background: #d4edda;
            color: #155724;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5px;
        }
        .section {
            margin: 25px 0;
        }
        .section-title {
            font-size: 10px;
            color: #858796;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .address {
            background: #f8f9fc;
            padding: 12px;
            border-left: 3px solid #4e73df;
            font-size: 11px;
            line-height: 1.6;
        }
        .address strong {
            display: block;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .items {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items th {
            background: #4e73df;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        .items th:last-child {
            text-align: right;
        }
        .items td {
            padding: 12px 10px;
            border-bottom: 1px solid #e3e6f0;
            font-size: 11px;
        }
        .items td:last-child {
            text-align: right;
            font-weight: bold;
        }
        .item-name {
            font-weight: bold;
            color: #2c3e50;
            font-size: 12px;
        }
        .item-detail {
            color: #858796;
            font-size: 10px;
            margin-top: 3px;
        }
        .total-box {
            background: #f8f9fc;
            padding: 15px;
            border: 1px solid #e3e6f0;
        }
        .total-table {
            width: 100%;
        }
        .total-label {
            font-size: 12px;
            color: #5a5c69;
        }
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #4e73df;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e3e6f0;
            text-align: center;
            font-size: 11px;
            color: #858796;
        }
    </style>
</head>
<body>
    <div class="invoice" id="invoice-element">
        <div class="header-line"></div>
        
        <div class="header">
            <table>
                <tr>
                    <td style="width: 60%;">
                        <table>
                            <tr>
                                <td style="width: 50px; vertical-align: middle;">
                                    <div class="logo">A</div>
                                </td>
                                <td style="vertical-align: middle;">
                                    <div class="company">Assertivlogix</div>
                                    <div class="tagline">Plugins</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 40%; text-align: right; vertical-align: top;">
                        <div class="invoice-title">INVOICE</div>
                        <div class="invoice-details">
                            <strong>Invoice #:</strong> {{ $transaction->transaction_id }}<br>
                            <strong>Date:</strong> {{ $transaction->created_at->format('F d, Y') }}<br>
                            <span class="status">{{ strtoupper($transaction->status) }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; padding-right: 15px; vertical-align: top;">
                        <div class="section-title">From</div>
                        <div class="address">
                            <strong>Assertivlogix Plugins</strong>
                            123 Tech Street<br>
                            Innovation City, IC 12345<br>
                            sales@assertivlogix.com
                        </div>
                    </td>
                    <td style="width: 50%; padding-left: 15px; vertical-align: top;">
                        <div class="section-title">Bill To</div>
                        <div class="address" style="border-left-color: #1cc88a;">
                            <strong>{{ $transaction->billing_name }}</strong>
                            {{ $transaction->billing_email }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th style="width: 70%;">Item Description</th>
                    <th style="width: 30%;">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="item-name">{{ $transaction->product_name }}</div>
                        <div class="item-detail">{{ ucfirst($transaction->plan) }} Plan</div>
                        @if($transaction->period_start && $transaction->period_end)
                            <div class="item-detail">
                                {{ $transaction->period_start->format('M d, Y') }} - {{ $transaction->period_end->format('M d, Y') }}
                            </div>
                        @endif
                    </td>
                    <td>${{ number_format($transaction->amount, 2) }}</td>
                </tr>
                @if($transaction->discount_amount > 0)
                <tr>
                    <td>
                        <div class="item-detail">Discount 
                            <span style="background: #e74a3b; color: white; padding: 2px 5px; font-size: 9px;">{{ $transaction->discount_code }}</span>
                        </div>
                    </td>
                    <td style="color: #1cc88a;">-${{ number_format($transaction->discount_amount, 2) }}</td>
                </tr>
                @endif
            </tbody>
        </table>

        <table style="width: 100%;">
            <tr>
                <td style="width: 60%;"></td>
                <td style="width: 40%;">
                    <div class="total-box">
                        <table class="total-table">
                            <tr>
                                <td class="total-label">Total Amount</td>
                                <td class="total-amount">${{ number_format($transaction->amount, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer">
            <p style="margin: 5px 0;">Thank you for your business!</p>
            <p style="margin: 5px 0;">If you have any questions, please contact <strong style="color: #4e73df;">sales@assertivlogix.com</strong></p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        if (window.location.search.includes('download=true')) {
            setTimeout(function() {
                var element = document.getElementById('invoice-element');
                var opt = {
                    margin: 0.5,
                    filename: 'invoice_{{ $transaction->transaction_id }}.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { 
                        scale: 2,
                        useCORS: true,
                        letterRendering: true,
                        backgroundColor: '#ffffff'
                    },
                    jsPDF: { 
                        unit: 'in', 
                        format: 'letter', 
                        orientation: 'portrait'
                    }
                };
                html2pdf().set(opt).from(element).save();
            }, 1000);
        }
    </script>
</body>
</html>
