<h2>New Inquiry Received</h2>
<p><strong>Name:</strong> {{ $inquiry->name }}</p>
<p><strong>Email:</strong> {{ $inquiry->email }}</p>
<p><strong>Phone:</strong> {{ $inquiry->phone ?? 'Not provided' }}</p>
<p><strong>Type:</strong> {{ ucfirst($inquiry->type) }}</p>
<p><strong>Message:</strong></p>
<p>{{ $inquiry->message }}</p>
<hr>
<p>Log in to the admin panel to respond.</p>