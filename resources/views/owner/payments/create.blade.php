<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Bill Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('owner.payments.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow">
                        ← Back
                    </a>
                </div>

                <form action="{{ route('owner.payments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="bill_id" class="block text-gray-700 font-medium mb-1">Select Bill</label>
                        <select name="bill_id" id="bill_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                required>
                            <option value="">-- Select Bill --</option>
                            @foreach($bills as $bill)
                                <option value="{{ $bill->id }}" {{ old('bill_id') == $bill->id ? 'selected' : '' }}>
                                    {{ $bill->flat->flat_number ?? '-' }} | {{ $bill->billCategory->name ?? '-' }} | {{ number_format($bill->due_amount, 2) }} BDT
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('bill_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700 font-medium mb-1">Payment Amount</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
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
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="mobile_payment" {{ old('payment_method') == 'mobile_payment' ? 'selected' : '' }}>Mobile Payment</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="paid_at" class="block text-gray-700 font-medium mb-1">Payment Date</label>
                        <input type="date" name="paid_at" id="paid_at" value="{{ old('paid_at', now()->format('Y-m-d')) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('paid_at')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-4 mt-6">
                        <x-primary-button class="bg-blue-700 hover:bg-blue-800">
                            Record Payment
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
