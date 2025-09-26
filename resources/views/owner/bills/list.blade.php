<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 text-sm"
                >
                    {{ session('success') }}
                </p>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Bill List</h3>
                        <a href="{{ route('owner.bills.create') }}">
                            <x-primary-button class="bg-gray-500 hover:bg-gray-600">
                                Add New
                            </x-primary-button>
                        </a>
                    </div>

                    {{-- Bills Table --}}
                    <table class="w-full border border-gray-200 text-center">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">House Owner Name</th>
                                <th class="px-4 py-2 border">Building Name</th>
                                <th class="px-4 py-2 border">Flat Number</th>
                                <th class="px-4 py-2 border">Bill Category</th>
                                <th class="px-4 py-2 border">Month</th>
                                <th class="px-4 py-2 border">Amount</th>
                                <th class="px-4 py-2 border">Due Amount</th>
                                <th class="px-4 py-2 border">Created At</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bills as $bill)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        {{ $loop->iteration + ($bills->currentPage() - 1) * $bills->perPage() }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $bill->houseOwner->name }}</td>
                                    <td class="px-4 py-2 border">{{ $bill->flat->building->name ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $bill->flat->flat_number ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $bill->billCategory->name ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $bill->month }}</td>
                                    <td class="px-4 py-2 border">{{ number_format($bill->amount, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ number_format($bill->due_amount, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ $bill->created_at->format('d M, Y') }}</td>
                                    <td class="px-4 py-2 border">
                                        <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                            <a href="{{ route('owner.bills.edit', $bill->id) }}" class="inline-block">
                                                Edit
                                            </a>
                                        </x-primary-button>
                                        <form action="{{ route('owner.bills.destroy', $bill->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="bg-red-600 hover:bg-red-700 ml-2" onclick="return confirm('Are you sure you want to delete this bill?')">
                                                Delete
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-2 border text-center">No Bills found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $bills->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
