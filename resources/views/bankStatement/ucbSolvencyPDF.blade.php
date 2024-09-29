<!DOCTYPE html>
<html>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<body>
<img style="margin-bottom: 70px;" src="{{url('public/ucb_logo.png')}}" height="90" width="180">
<?php
$six_digit_random_number = random_int(100000, 999999);
$ac_balance_w = convertNumberToWord($ac_balance);
?>
<div style="margin-left:60px; margin-bottom: 190px;">
    <p>{{ $date }}</p>
    <p style="margin-bottom: 40px;">{{ 'Ref # '.$six_digit_random_number }}</p>
    <h3 align="center" style="margin-bottom: 45px;"><u><b>To Whom It May Concern</b></u></h3>
    <p style="margin-bottom: 40px;">
        This is to certify that {{ ' '.strtoupper($name).' ' }} , {{' '.strtoupper($address).' '}} has been maintaining a {{' '.($ac_type).' '}} bearing number
        {{' '.($ac_no).' '}} with United Commercial Bank PLC, Pragati Sarani Branch.
    </p>
    <p style="margin-bottom: 40px;">
        The balance of the above mentioned account  at the end of {{ ' '.$e_date.' ' }} is BDT {{ ' '.$ac_balance.' ' }} ({{'Taka '. $ac_balance_w}}).
    </p>
    <p style="margin-bottom: 40px;">
        The certificate has been issued at the request of the customer(s) and Banks's responsibility is limited to the content of this certificate only.
    </p>
    <p style="margin-bottom: 120px;">
        For United Commercial Bank PLC:
    </p>
    <p>Authorised Signature <span style="margin-left: 300px;">Authorised Signature</span></p>
</div>
<h2 style="color: red;">United Commercial Bank PLC</h2>
<p style="margin-top: -20px"><b>Corporate Office:</b> Plot-CWS(A)-1 Road No-34</p>
<p style="margin-top: -15px">Gulshan Avenue, Dhaka-1212, Bangladesh.</p>
</body>
</html>

<?php
    function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }
?>
