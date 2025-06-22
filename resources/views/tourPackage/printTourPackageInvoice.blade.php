<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Package Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" media="all">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            color: #333;
            background-color: #f8f9fa;
        }

        .invoice-box {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
            margin: 30px auto;
            max-width: 900px;
        }

        .section-title {
            border-left: 5px solid #007bff;
            padding-left: 10px;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 1.2rem;
            color: #007bff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .table th {
            background-color: #e9ecef;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .totals td {
            font-weight: 600;
        }

        .badge-section {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .logo {
            height: 50px;
        }

        ul {
            padding-left: 18px;
        }
        @media print {
            @page {
                margin: 1in 0.5in .5in 0.5in; /* top, right, bottom, left */
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
            }

            .invoice-box {
                margin: 10 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }
            .section-title {
                color: #007bff !important;
                border-left-color: #007bff !important;
            }

            .table th {
                background-color: #e9ecef !important;
            }

            .badge {
                background-color: #007bff !important; /* Bootstrap secondary */
                color: #fff !important;
                padding: 0.25em 0.4em;
                font-size: 75%;
                border-radius: 0.2rem;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            a[href]:after {
                content: "";
            }
            i.fas {
                font-family: "Font Awesome 5 Free" !important;
                font-weight: 900 !important;
                display: inline-block;
            }

            /* Optional: avoid hiding it due to print optimizations */
            /** {*/
            /*    -webkit-print-color-adjust: exact !important;*/
            /*    print-color-adjust: exact !important;*/
            /*}*/
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <table class="w-100 mb-4" style="table-layout: fixed;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                @if($company->logo)
                    <img src="{{ url($company->logo) }}" class="logo" alt="Logo">
                @else
                    <h4>{{ $company->company_name }}</h4>
                @endif
            </td>
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <strong>{{ $company->company_name }}</strong><br>
                Phone: {{ $company->company_pnone }}<br>
                Email: {{ $company->company_email }}<br>
                Address: {{ $company->address }}
            </td>
        </tr>
    </table>

    <div class="text-center mb-3">
        <h4><strong>Tour Package Invoice</strong></h4>
        <span class="badge badge-secondary">Invoice Date: {{ date('d M Y') }}</span>
    </div>

    <!-- Package Info -->
    <div class="section-title">Package Details</div>
    <table class="table table-bordered">
        <tr><th>Package Name</th><td>{{ $package->title }}</td></tr>
        <tr><th>Package Code</th><td>{{ $package->p_code }}</td></tr>
        <tr><th>Duration</th><td>{{ $package->start_date }} to {{ $package->end_date }}</td></tr>
    </table>

    <!-- Guest Info -->
    <div class="section-title">Guest Details</div>
    @php $pax = json_decode($package->traveler); @endphp
    <table class="table table-bordered">
        <thead>
        <tr><th>#</th><th>Full Name</th></tr>
        </thead>
        <tbody>
        @for($i = 0; $i < $package->g_details; $i++)
            @php $passenger = DB::table('passengers')->where('id', $pax[$i])->first(); @endphp
            <tr><td>{{ $i + 1 }}</td><td>{{ $passenger->f_name . ' ' . $passenger->l_name }}</td></tr>
        @endfor
        </tbody>
    </table>

    <!-- Payment Info -->
    <div class="section-title">Payment Summary</div>
    <table class="table table-bordered">
        <tr>
            <td rowspan="6" style="width: 60%;">
                <strong>Payment Type:</strong> {{ $package->payment_type }}<br><br>
                <strong>Payment Info:</strong><br>{!! nl2br($package->pay_details) !!}
            </td>
            <td class="text-right">Price</td>
            <td class="text-right">{{ $package->p_c_details }}/-</td>
        </tr>
        <tr><td class="text-right">VAT</td><td class="text-right">{{ $package->p_vat }}/-</td></tr>
        <tr><td class="text-right">AIT</td><td class="text-right">{{ $package->p_ait }}/-</td></tr>
        <tr><td class="text-right">Grand Total</td><td class="text-right text-primary"><strong>{{ $package->p_c_details + $package->p_vat + $package->p_ait }}/-</strong></td></tr>
        <tr><td class="text-right">Due</td><td class="text-right">{{ $package->due }}/-</td></tr>
        <tr><td class="text-right">Paid</td><td class="text-right text-success"><strong>{{ $package->p_c_details + $package->p_vat + $package->p_ait - $package->due }}/-</strong></td></tr>
    </table>

    @php
        $sections = [
            'highlights' => 'Hotel Name',
            'day_title' => 'Day Wise Itinerary',
            'p_inclusions' => 'Package Inclusions',
            'p_exclusions' => 'Package Exclusions',
            'p_tnt' => 'Package Terms and Conditions',
            'p_policy' => 'Package Policy'
        ];

        $listKeys = ['p_inclusions', 'p_exclusions', 'p_tnt', 'p_policy'];
    @endphp

    @foreach ($sections as $key => $label)
        @if(!empty($package->$key))
            <div class="section-title">{{ $label }}</div>

            @if($key === 'day_title')
                @php
                    $d_titles = json_decode($package->day_title);
                    $d_ininaris = json_decode($package->dat_itinary);
                @endphp
                <table class="table table-bordered">
                    @foreach($d_titles as $i => $title)
                        <tr>
                            <td><strong>Day {{ $i+1 }}: {{ $title }}</strong></td>
                            <td>
                                <ul style="padding-left: 20px;">
                                    @foreach(explode("\n", $d_ininaris[$i]) as $line)
                                        <li style="list-style: none;">
                                            <i class="fas fa-check-circle text-success mr-1"></i> {{ $line }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </table>

            @elseif(in_array($key, $listKeys))
                @php
                    $html = json_decode($package->$key);
                    $text = strip_tags($html, '<div>');
                    $lines = array_filter(array_map('trim', explode('</div>', $text)));
                @endphp
                <ul style="padding-left: 20px;">
                    @foreach($lines as $line)
                        @php $cleanLine = strip_tags($line); @endphp
                        @if($cleanLine !== '')
                            <li style="list-style: none;">
                                <i class="fas fa-check-circle text-success mr-1"></i> {{ $cleanLine }}
                            </li>
                        @endif
                    @endforeach
                </ul>

            @else
                <p>{!! nl2br(json_decode($package->$key)) !!}</p>
            @endif
        @endif
    @endforeach
</div>
<script>
    window.addEventListener("load", window.print());
</script>
</body>
</html>
