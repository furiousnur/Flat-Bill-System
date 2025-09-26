<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Flat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('owner.flats.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow">
                        ← Back
                    </a>
                </div>
                <form action="{{ route('owner.flats.update', $flat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="building_id" class="block text-gray-700 font-medium mb-1">Select Building</label>
                        <select name="building_id" id="building_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">-- Select Building --</option>
                            @foreach($buildings as $building)
                                <option value="{{ $building->id }}"
                                    {{ $flat->building_id == $building->id ? 'selected' : '' }}>
                                    {{ $building->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('building_id')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="flat_number" class="block text-gray-700 font-medium mb-1">Flat Number</label>
                        <input type="text" name="flat_number" id="flat_number"
                               value="{{ old('flat_number', $flat->flat_number) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('flat_number')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="flat_owner_name" class="block text-gray-700 font-medium mb-1">Flat Owner Name</label>
                        <input type="text" name="flat_owner_name" id="flat_owner_name"
                               value="{{ old('flat_owner_name', $flat->flat_owner_name) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('flat_owner_name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="flat_owner_contact" class="block text-gray-700 font-medium mb-1">Flat Owner Contact</label>
                        <input type="text" name="flat_owner_contact" id="flat_owner_contact"
                               value="{{ old('flat_owner_contact', $flat->flat_owner_contact) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('flat_owner_contact')" class="mt-2" />
                    </div>
                    <div class="flex items-center space-x-4">
                        <x-primary-button class="bg-blue-700 hover:bg-blue-800">
                            Update
                        </x-primary-button>

                        <a href="{{ route('owner.flats.index') }}" class="ml-2">
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
