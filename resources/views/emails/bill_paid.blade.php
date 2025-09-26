<h2>Bill Payment Received</h2>
<p>Hello,</p>
<p>Your payment has been received:</p>

<ul>
    <li><strong>Flat:</strong> {{ $bill->flat->flat_number ?? '-' }}</li>
    <li><strong>Category:</strong> {{ $bill->billCategory->name ?? '-' }}</li>
    <li><strong>Amount Paid:</strong> {{ number_format($payment->amount, 2) }} BDT</li>
    <li><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</li>
    <li><strong>Date:</strong> {{ $payment->paid_at }}</li>
</ul>

<p>Remaining Due: {{ number_format($bill->due_amount, 2) }} BDT</p>
