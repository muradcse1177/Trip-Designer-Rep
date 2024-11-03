<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trip designer | Invoice Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('public/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('public/dist/css/adminlte.min.css')}}">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <img src="{{$domain.'/'.@$agent_info->logo}}" width="160" height="60">
                    <small class="float-right">{{$invoice->date}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info" >
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>{{$agent_info->company_name}}</strong><br>
                    Phone: {{$company_info->phone_code.$company_info->company_pnone}}<br>
                    Email: {{$company_info->company_email}}<br>
                    Address: {{@$company_info->address}}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{$invoice->name}}</strong><br>
                    Phone: {{$invoice->phone}}<br>
                    Email: {{$invoice->email}}<br>
                    Address: {{$invoice->address}}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice {{$invoice->invoice_id}}</b><br>

                <b>Date</b> {{$invoice->date}}<br>
                <b>Payment Due:</b> {{$invoice->due_amount}}<br>
                <b>Account:</b> {{$invoice->acc_number}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>S.L</th>
                        <th>Purpose</th>
                        <th>Passengers</th>
                        <th>Reference</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $purposes = json_decode($invoice->purpose);
                        $pax_numbers = json_decode($invoice->pax_number);
                        $amounts = json_decode($invoice->amount);
                        $references = json_decode($invoice->reference);
                        $i=0;
                        $sum =0;
                    ?>
                    @foreach($purposes as $p)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$purposes[$i]}}</td>
                            <td>{{$pax_numbers[$i]}}</td>
                            <td>{{$references[$i]}}</td>
                            <td>{{$amounts[$i].' '.$c_info->symbol}}</td>
                            <?php
                                $sum = $sum + $amounts[$i];
                                $i++;
                            ?>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="lead">Payment Methods:</p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"> Payment Methods: {{@$invoice->p_method}}</p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"> Account Number:{{@$invoice->acc_number}}</p>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="table-responsive  float-right">
                    <table class="table">
                        <tr>
                            <th style="width:50%; text-align: right;">Subtotal:</th>
                            <td style="text-align: right;">{{$sum.' '.$c_info->symbol}}</td>
                        </tr>
                        <tr>
                            <th style="text-align: right;">Tax</th>
                            <td style="text-align: right;">{{'0.00 '. $c_info->symbol}}</td>
                        </tr>
                        <tr>
                            <th style="text-align: right;">Due Amount:</th>
                            <td style="text-align: right;">{{$invoice->due_amount.' '.$c_info->symbol}}</td>
                        </tr>
                        @if(($invoice->due_amount>0))
                            <tr>
                                <th style="text-align: right;">Amount Need to be Paid:</th>
                                <td style="text-align: right; color: red;"><b>{{$invoice->due_amount.' '.$c_info->symbol}}</b></td>
                            </tr>
                        @else
                            <tr>
                                <th style="text-align: right;"> Total Paid Amount:</th>
                                <td style="text-align: right; color: red;"><b>{{$sum.' '.$c_info->symbol}}</b></td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <div class="float-left">
                    <p class="lead">---------------------------</p>
                    <p class="lead">Customer Signature</p>
                </div>

            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="float-right">
                    <p class="lead">----------------------------</p>
                    <p class="lead">Authorised Signature</p>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="row" style="text-align: center;">
            <div class="col-12">
                <p class="lead"> This is software generated invoice and authorised by <b>Trip Designer</b>. No need to extra signature.</p>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
    window.addEventListener("load", window.print());
</script>
</body>
</html>
