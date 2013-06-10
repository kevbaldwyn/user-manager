<p>Dear {{ $first_name }}</p>
<p>Please follow <a href="{{ URL::route('users.activate') }}?token={{ $activation_code }}">this link</a> to activate your account</p>