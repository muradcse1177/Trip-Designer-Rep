<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enrollment Confirmation</title>
</head>
<body>
<h2>Hello {{ $user->company_name }},</h2>

<p>🎉 Welcome to our learning platform! Your account has been successfully created.</p>


<p>You can now log in and start learning. Here are your credentials:</p>

<ul>
    <li><strong>Email:</strong> {{ $user->company_email }}</li>
    <li><strong>Password:</strong> {{ $password }}</li>
</ul>

<p>🔐 We recommend that you change your password after logging in for the first time.</p>

<p>
    👉 <a href="{{ url('all-login') }}">Click here to login</a>
</p>

<p>Best regards,<br>Team Trip Designer Academy</p>
</body>
</html>
