<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('owner.bills.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow">
                        ← Back
                    </a>
                </div>
                <form action="{{ route('owner.bills.update', $bill->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="flat_id" class="block text-gray-700 font-medium mb-1">Select Flat</label>
                        <select name="flat_id" id="flat_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required>
                            <option value="">-- Select Flat --</option>
                            @foreach($flats as $flat)
                                <option value="{{ $flat->id }}" {{ $bill->flat_id == $flat->id ? 'selected' : '' }}>
                                    {{ $flat->flat_number }} - {{ $flat->building->name ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('flat_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="bill_category_id" class="block text-gray-700 font-medium mb-1">Bill Category</label>
                        <select name="bill_category_id" id="bill_category_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required>
                            <option value="">-- Select Category --</option>
                            @foreach($billCategories as $category)
                                <option value="{{ $category->id }}" {{ $bill->bill_category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('bill_category_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="month" class="block text-gray-700 font-medium mb-1">Month - Year</label>
                        <input type="text" name="month" id="month"
                               value="{{ $bill->month }}" placeholder="September - 2025"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               placeholder="e.g., September 2025" required>
                        <x-input-error :messages="$errors->get('month')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700 font-medium mb-1">Amount</label>
                        <input type="number" step="0.01" name="amount" id="amount"
                               value="{{ $bill->amount }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="note" class="block text-gray-700 font-medium mb-1">Note</label>
                        <input type="text" name="notes" id="note"
                               value="{{ $bill->notes }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-4">
                        <x-primary-button class="bg-blue-700 hover:bg-blue-800">
                            Update
                        </x-primary-button>

                        <a href="{{ route('owner.bills.index') }}" class="ml-2">
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
