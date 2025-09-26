<h2>New Bill Created</h2>
<p>Hello,</p>
<p>A new bill has been created for your flat:</p>

<ul>
    <li><strong>Flat:</strong> {{ $bill->flat->flat_number ?? '-' }}</li>
    <li><strong>Category:</strong> {{ $bill->billCategory->name ?? '-' }}</li>
    <li><strong>Amount:</strong> {{ number_format($bill->amount, 2) }} BDT</li>
    <li><strong>Status:</strong> {{ ucfirst($bill->status) }}</li>
</ul>
