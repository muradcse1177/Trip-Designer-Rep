<!DOCTYPE html>
<html>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<body>
<center><p style="font-size: 15px; margin-top: -10px; "><b>United Commercial Bank PLC</b></p></center>
<center><p style="font-size: 15px; margin-top: -10px; "><b>Uttara Branch</b></p></center>
<center><p style="margin-bottom: 15px;  font-size: 15px; margin-top: -10px; "><b>Statement Of Account</b></p></center>
<table style="margin-bottom: 30px; width:100%;">
    <tr>
        <td style="font-size: 12px;"><b>Name</b></td>
        <td style="font-size: 12px;"><b>:</b></td>
        <td style="font-size: 12px;">{{$name}}</td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>Customer ID </b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$c_id}}</td>
    </tr>
    <tr>
        <td style="font-size: 12px;"><b>Joint Name</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$j_name}}</td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>A/C No</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;" >{{$ac_no}}</td>
    </tr>
    <tr>
        <td style="font-size: 12px;"><b>F/H/P</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$fhp}}</td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>Prev. A/C No</b></td>
        <td style="font-size: 12px;"><b>:</b></td>
        <td style="font-size: 12px;">{{$ac_no}}</td>
    </tr>
    <tr>
        <td style="font-size: 12px;"><b>Address</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$address}}</td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>A/C Type</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$ac_type}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>Currency</b></td>
        <td style="font-size: 12px;"><b>:</b></td>
        <td style="font-size: 12px;">{{$currency}}</td>
    </tr>
    <tr>
        <td style="font-size: 12px;"><b>City</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$city}}</td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>A/C Status</b></td>
        <td style="font-size: 12px;"><b>:</b></td>
        <td style="font-size: 12px;">{{$a_status}}</td>
    </tr>
    <tr>
        <td style="font-size: 12px;"><b>Phone</b></td>
        <td style="font-size: 12px;"><b>:</b></td>
        <td style="font-size: 12px;">{{$phone}}</td>
        <td width="120px"></td>
        <td style="font-size: 12px;"><b>Period</b></td>
        <td style="font-size: 12px;"><b>: </b></td>
        <td style="font-size: 12px;">{{$s_date}}&nbsp; To &nbsp;{{$e_date}}</td>
    </tr>
</table>

<table style="width:100%; border-collapse: collapse; border: 1px solid;">
    <tr>
        <td style="font-size: 12px; border: 1px solid;"><b>Trans. Date</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Cheque#</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Ref.</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Narration</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Trans. Details</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Debit</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Credit</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>Balance</b></td>
    </tr>
    <?php
        $rows = DB::table('statement')->orderBy('date')->get();
        $total = $f_balance;
        $j=0;
        $t_d=0;
        $t_c=0;
    ?>
    @foreach($rows as $row)

        <?php
            if($row->debit>0){
                $total = $total - $row->debit;
                $t_d =  $t_d +$row->debit;
            }
            if($row->credit>0){
                $total = $total + $row->credit;
                $t_c =  $t_c + $row->credit;
            }
        ?>
        @if($j==0)
            <tr>
                <td style="font-size: 12px; border: 1px solid;">Balance Forward</td>
                <td style="font-size: 12px; border: 1px solid;"></td>
                <td style="font-size: 12px; border: 1px solid;"></td>
                <td style="font-size: 12px; border: 1px solid;"></td>
                <td style="font-size: 12px; border: 1px solid;"></td>
                <td style="font-size: 12px; border: 1px solid;"></td>
                <td style="font-size: 12px; border: 1px solid;"></td>
                <td style="font-size: 12px; border: 1px solid;">{{number_format((float)$f_balance, 2, '.', '')}}</td>
            </tr>
        @else
        <tr>
            <td style="font-size: 12px; border: 1px solid;">{{$row->date}}</td>
            <td style="font-size: 12px; border: 1px solid;"></td>
            <td style="font-size: 12px; border: 1px solid;">{{$row->ref}}</td>
            <td style="font-size: 12px; border: 1px solid;">
                <?php
                    $narrations  = json_decode($row->narration);
                ?>
                @foreach($narrations as $narration)
                    {{$narration}}<br>
                @endforeach
            </td>
            <td style="font-size: 12px; border: 1px solid;">{{$row->details}}</td>
            <td style="font-size: 12px; border: 1px solid;">{{number_format((float)$row->debit, 2, '.', '')}}</td>
            <td style="font-size: 12px; border: 1px solid;">{{number_format((float)$row->credit, 2, '.', '')}}</td>
            <td style="font-size: 12px; border: 1px solid;">{{number_format((float)$total, 2, '.', '')}}</td>
        </tr>
        @endif
        <?php
            $j++;
        ?>
    @endforeach
    <tr>
        <td style="font-size: 12px; border: 1px solid;" colspan="5" align="right"><b>Total</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>{{number_format((float)$t_d, 2, '.', '')}}</b></td>
        <td style="font-size: 12px; border: 1px solid;"><b>{{number_format((float)$t_c, 2, '.', '')}}</b></td>
        <td style="font-size: 12px; border: 1px solid;"></td>
    </tr>
</table>
</body>
</html>

