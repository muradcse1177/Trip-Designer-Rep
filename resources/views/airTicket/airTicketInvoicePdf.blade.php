<!DOCTYPE html>
<html>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    hr{
        border-top: 1px blue;
    }

    /*table, td, th {*/
    /*    border: 1px solid;*/
    /*}*/

    /*table {*/
    /*    width: 100%;*/
    /*    border-collapse: collapse;*/
    /*}*/
</style>
<body>
<center><div><h2><b>Electronic Ticket/Invoice</b></h2></div></center>
<hr>
<table style="width: 100%;" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <img src="{{url($company->logo)}}" height="50" width="100%"/>
        </td>
        <td align="right">
            <div>
                <h4><b>{{$company->company_name}}</b></h4>
                <p>Phone: {{$company->company_pnone}}</p>
                <p style="margin-top: -10px">Email:{{$company->company_email}}</p>
                <p style="margin-top: -10px">Address: {{$company->address}}</p>
            </div>
        </td>
    </tr>
</table>
<hr>
<table width="100%">
    <tr>
        <td >
            <p><b>Airline PNR: </b>{{$ticket->airline_pnr}}</p>
        </td>
        <td align="center">
            <p><b>Reservation PNR: </b>{{$ticket->reservation_pnr}}</p>
        </td>
        <td align="right">
            <p><b>Issue Date: </b>{{$ticket->issue_date}}</p>
        </td>
        <td align="right">
            <b>Status: Confirmed</b>
        </td>
    </tr>
</table>
<hr>
<?php
$pax = json_decode($ticket->pax_name);
$t_number = json_decode($ticket->t_number);
$luggage = json_decode($ticket->luggage);
$a_from = json_decode($ticket->a_from);
$a_to = json_decode($ticket->a_to);
$d_time = json_decode($ticket->d_time);
$a_time = json_decode($ticket->a_time);
$airlines = json_decode($ticket->airlines);
$f_number = json_decode($ticket->f_number);
?>
<table width="100%">
    <tr>
        <td colspan="3">
            <div style="text-align: center; padding: 12px 0; background-color: #C0C0C0;">
               <b style="margin-top: 10px; color: #000000;">Passenger Details</b>
            </div>
        </td>
    </tr>
    <th align="left">Name</th>
    <th align="left">Ticket Number</th>
    <th align="left">Baggage</th>
    @for($i=0; $i<$ticket->pax_number; $i++)
            <?php
            $passenger = DB::table('passengers')->where('id',$pax[$i])->first();
            ?>
        <tr>
            <td>{{$passenger->f_name.' '.$passenger->l_name}}</td>
            <td>{{$t_number[$i]}}</td>
            <td>{{$luggage[$i]}}</td>
        </tr>
    @endfor
</table>
<table width="100%">
    <tr class="all">
        <td colspan="6">
            <div style="text-align: center; padding: 12px 0; background-color: #C0C0C0;">
                <b style="margin-top: 10px; color: #000000;">Flight Details</b>
            </div>
        </td>
    </tr>
    <th align="left">Airlines</th>
    <th align="left">Flight Number</th>
    <th align="left">From</th>
    <th align="left">To</th>
    <th align="left">Departure</th>
    <th align="left">Arrival</th>
    @for($i=0; $i<count($f_number); $i++)
        <tr>
            <td>{{$airlines[$i]}}</td>
            <td>{{$f_number[$i]}}</td>
            <td>{{$a_from[$i]}}</td>
            <td>{{$a_to[$i]}}</td>
            <td>{{$d_time[$i]}}</td>
            <td>{{$a_time[$i]}}</td>
        </tr>
    @endfor
</table>
<table width="100%">
    <tr>
        <td>
            <div style="text-align: center; padding: 12px 0; background-color: #C0C0C0;">
                <b style="margin-top: 10px; color: #000000;">Payments Details</b>
            </div>
        </td>
    </tr>
</table>
<table width="98%"  align="center" style="border: 1px solid; border-collapse: collapse; margin-top: 10px; ">
    <tr>
        <td rowspan="5" style="border: 1px solid;">
            <div>
                <p><b>Payment Type: </b>{{$ticket->payment_type}}</p>
                <div><b>Payment Details:</b><br> {!! nl2br($ticket->p_details) !!}</div>
            </div>
        </td>
        <td align="right" style="border: 1px solid;">Ticket Price</td>
        <td  align="right" style="border: 1px solid;">{{$ticket->c_price.'/-'}}</td>
    </tr>
    <tr>
        <td align="right" style="border: 1px solid;">VAT</td>
        <td  align="right" style="border: 1px solid;">{{$ticket->vat.'/-'}}</td>
    </tr>
    <tr>
        <td align="right" style="border: 1px solid;">AIT</td>
        <td  align="right" style="border: 1px solid;">{{$ticket->ait.'/-'}}</td>
    </tr>
    <tr>
        <td align="right" style="border: 1px solid;"><b style="color: purple;">Grand Total</b></td>
        <td  align="right" style="border: 1px solid;"><b style="color: purple;">{{$ticket->c_price + $ticket->vat + $ticket->ait.'/-'}}</b></td>
    </tr>
    <tr>
        <td align="right" style="border: 1px solid;">Due Amount</td>
        <td  align="right" style="border: 1px solid;">{{$ticket->due_amount.'/-'}}</td>
    </tr>
</table>
<table width="100%" style="margin-top: 10px;">
    <tr>
        <td>
            <div style="text-align: center; padding: 12px 0; background-color: #C0C0C0;">
                <b style="margin-top: 10px; color: #000000;">Terms and Conditions</b>
            </div>
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td>
            {!! nl2br($airTicketTnT->tnt) !!}}
        </td>
    </tr>
</table>
</body>
</html>

