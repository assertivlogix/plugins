
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 0;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
            font-size: 16px;
            line-height: 24px;
            color: #555;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        /* PDF Specific Styles */
        body.pdf-mode {
            background-color: #fff;
        }
        body.pdf-mode .invoice-box {
            box-shadow: none;
            border: 1px solid #eee;
            border-radius: 0;
            max-width: 100%;
            width: 750px; /* Fixed width for A4 */
        }
        body.pdf-mode .header-bg {
            background: #4e73df; /* Solid color for PDF */
        }
        
        .header-bg {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            height: 10px;
            width: 100%;
        }
        .content-wrapper {
            padding: 40px;
        }
        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
            vertical-align: top;
        }
        .text-primary {
            color: #4e73df;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>
<body class="{{ request('download') ? 'pdf-mode' : '' }}">
    <div class="invoice-box" id="invoice-element">
        <div class="header-bg"></div>
        <div class="content-wrapper">
            <!-- Header -->
            <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 40px;">
                <tr>
                    <td style="vertical-align: top; width: 60%;">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 55px; vertical-align: middle; padding: 0;">
                                    <div style="background-color: #4e73df; color: #fff; width: 48px; height: 48px; border-radius: 8px; text-align: center; line-height: 48px; font-weight: bold; font-size: 24px;">A</div>
                                </td>
                                <td style="vertical-align: middle; padding: 0;">
                                    <div style="font-size: 24px; font-weight: bold; color: #2c3e50; line-height: 1.2;">Assertivlogix</div>
                                    <div style="font-size: 12px; color: #4e73df; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;">Plugins</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align: right; vertical-align: top; width: 40%;">
                        <h2 style="margin: 0 0 10px 0; color: #4e73df; font-size: 28px; font-weight: 700;">INVOICE</h2>
                        <div style="font-size: 14px; color: #666; line-height: 1.6;">
                            <strong>Invoice #:</strong> <span style="color: #2c3e50;">{{ $transaction->transaction_id }}</span><br>
                            <strong>Date:</strong> {{ $transaction->created_at->format('F d, Y') }}<br>
                            <div style="margin-top: 5px;">
                                <span style="background-color: {{ $transaction->status === 'completed' ? '#e1f5fe' : '#ffebee' }}; color: {{ $transaction->status === 'completed' ? '#0288d1' : '#c62828' }}; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">{{ $transaction->status }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Address Section -->
            <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 40px;">
                <tr>
                    <td style="vertical-align: top; width: 50%; padding-right: 20px;">
                        <h3 style="font-size: 11px; color: #858796; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px 0; font-weight: 600;">From</h3>
                        <div style="font-size: 14px; color: #5a5c69; line-height: 1.6; background: #f8f9fc; padding: 15px; border-radius: 8px; border-left: 4px solid #4e73df;">
                            <strong style="color: #2c3e50;">Assertivlogix Plugins</strong><br>
                            123 Tech Street<br>
                            Innovation City, IC 12345<br>
                            support@assertivlogix.com
                        </div>
                    </td>
                    <td style="vertical-align: top; width: 50%; padding-left: 20px;">
                        <h3 style="font-size: 11px; color: #858796; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px 0; font-weight: 600;">Bill To</h3>
                        <div style="font-size: 14px; color: #5a5c69; line-height: 1.6; background: #f8f9fc; padding: 15px; border-radius: 8px; border-left: 4px solid #1cc88a;">
                            <strong style="color: #2c3e50;">{{ $transaction->billing_name }}</strong><br>
                            {{ $transaction->billing_email }}
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Items Table -->
            <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: separate; border-spacing: 0; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #4e73df; color: white;">
                        <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase; font-weight: 600; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">Item Description</th>
                        <th style="padding: 15px; text-align: right; font-size: 12px; text-transform: uppercase; font-weight: 600; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 20px 15px; border-bottom: 1px solid #e3e6f0; color: #5a5c69;">
                            <div style="font-weight: bold; font-size: 15px; color: #2c3e50;">{{ $transaction->product_name }}</div>
                            <div style="color: #858796; font-size: 13px; margin-top: 4px;">{{ ucfirst($transaction->plan) }} Plan</div>
                            @if($transaction->period_start && $transaction->period_end)
                                 <div style="color: #858796; font-size: 12px; margin-top: 2px;">
                                    {{ $transaction->period_start->format('M d, Y') }} - {{ $transaction->period_end->format('M d, Y') }}
                                </div>
                            @endif
                        </td>
                        <td style="padding: 20px 15px; border-bottom: 1px solid #e3e6f0; color: #2c3e50; text-align: right; font-weight: bold; font-size: 15px;">
                            ${{ number_format($transaction->amount, 2) }}
                        </td>
                    </tr>
                    @if($transaction->discount_amount > 0)
                    <tr>
                        <td style="padding: 15px; border-bottom: 1px solid #e3e6f0; color: #858796;">
                            Discount <span style="font-size: 11px; background: #e74a3b; color: white; padding: 2px 6px; border-radius: 4px; margin-left: 5px;">{{ $transaction->discount_code }}</span>
                        </td>
                        <td style="padding: 15px; border-bottom: 1px solid #e3e6f0; color: #1cc88a; text-align: right; font-weight: bold;">
                            -${{ number_format($transaction->discount_amount, 2) }}
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <!-- Total Section -->
            <table cellpadding="0" cellspacing="0" style="width: 100%;">
                <tr>
                    <td style="width: 60%;"></td>
                    <td style="width: 40%;">
                        <div style="background-color: #f8f9fc; padding: 20px; border-radius: 8px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="text-align: left; color: #5a5c69; font-size: 14px; padding: 5px 0;">Total Amount</td>
                                    <td style="text-align: right; color: #4e73df; font-size: 24px; font-weight: 800; padding: 5px 0;">${{ number_format($transaction->amount, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Footer -->
        <div style="background-color: #f8f9fc; padding: 20px; text-align: center; color: #858796; font-size: 13px; border-top: 1px solid #e3e6f0;">
            <p style="margin: 0 0 5px 0;">Thank you for your business!</p>
            <p style="margin: 0;">If you have any questions, please contact <strong style="color: #4e73df;">support@assertivlogix.com</strong></p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        window.onload = function() {
            // Check if download is requested
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('download')) {
                // Small delay to ensure styles and fonts are loaded
                setTimeout(() => {
                    const element = document.getElementById('invoice-element');
                    const filename = 'invoice_{{ $transaction->transaction_id }}.pdf';
                    const opt = {
                        margin: 10,
                        filename: filename,
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { 
                            scale: 2, 
                            useCORS: true, 
                            logging: false, 
                            allowTaint: true, 
                            backgroundColor: '#ffffff',
                            windowWidth: 800
                        },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                    };
                    
                    // Access the internal jsPDF object to save directly
                    // This is often more reliable for filenames than the wrapper's save()
                    html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                        pdf.save(filename+'.pdf');
                        
                        // Optional: Close window after a delay
                        // setTimeout(() => window.close(), 2000);
                    }).catch(function(err) {
                        console.error('PDF generation error:', err);
                        // Fallback to simple save if the above fails
                        html2pdf().set(opt).from(element).save(filename);
                    });
                }, 500);
            }
        };
    </script>
</body>
</html>
