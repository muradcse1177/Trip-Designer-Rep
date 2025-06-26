<h3>New Course Enrollment</h3>

<p>User: {{ $user->company_name }}</p>
<p>Email: {{ $user->company_email }}</p>
<p>Phone: {{ $user->company_pnone }}</p>

<p>Course: {{ $order->product_name }}<br>
    Amount: {{ $order->amount }}<br>
    Transaction ID: {{ $order->transaction_id }}</p>
