<h3>Dear {{ $user->company_name }},</h3>
<p>Thank you for enrolling in {{ $order->product_name }}.</p>

<p><strong>Your Login Credentials:</strong><br>
    Email: {{ $user->company_email }}<br>
    Password: {{ $password }}</p>

<p><strong>Order Summary:</strong><br>
    Amount: {{ $order->amount }} BDT<br>
    Transaction ID: {{ $order->transaction_id }}</p>

<p>We look forward to seeing you in class!</p>
