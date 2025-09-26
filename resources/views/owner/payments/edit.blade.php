<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bill Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('owner.payments.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow">
                        ← Back
                    </a>
                </div>

                <form action="{{ route('owner.payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Bill</label>
                        <input type="text" value="{{ $payment->bill->flat->flat_number ?? '-' }} | {{ $payment->bill->billCategory->name ?? '-' }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" disabled>
                        <input type="hidden" name="bill_id" value="{{ $payment->bill_id }}">
                    </div>


                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700 font-medium mb-1">Payment Amount</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               placeholder="Enter amount paid"
                               min="0"
                               step="0.01"
                               required>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="block text-gray-700 font-medium mb-1">Payment Method</label>
                        <select name="payment_method" id="payment_method"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                required>
                            <option value="">-- Select Payment Method --</option>
                            <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="bank_transfer" {{ $payment->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="mobile_payment" {{ $payment->payment_method == 'mobile_payment' ? 'selected' : '' }}>Mobile Payment</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="paid_at" class="block text-gray-700 font-medium mb-1">Payment Date</label>
                        <input type="date" name="paid_at" id="paid_at"
                               value="{{ old('paid_at', \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d')) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('paid_at')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-4 mt-6">
                        <x-primary-button class="bg-blue-700 hover:bg-blue-800">
                            Update Payment
                        </x-primary-button>

                        <a href="{{ route('owner.payments.index') }}">
                            <x-danger-button class="bg-gray-500 hover:bg-gray-600">
                                Cancel
                            </x-danger-button>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
