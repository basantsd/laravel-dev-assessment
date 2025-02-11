<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>

        <div class="flex gap-8">
            <!-- Skills List -->
            <div class="flex-grow">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b">
                        <h2 class="text-sm font-medium text-gray-500">NAME</h2>
                    </div>

                    <div class="divide-y">
                        @foreach($skills as $skill)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50">
                            <span class="text-gray-900">{{ $skill->name }}</span>
                            <div class="flex gap-4">
                                <button wire:click="edit({{ $skill->id }})"
                                    class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button wire:click="delete({{ $skill->id }})"
                                    class="text-red-600 hover:text-red-800">Delete</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Add / Edit Skill -->
            <div class="w-80">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium mb-4">
                            {{ $isEditing ? 'Edit Skill' : 'Add New Skill' }}
                        </h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" wire:model="name" placeholder="Skill name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <button wire:click="{{ $isEditing ? 'update' : 'save' }}"
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ $isEditing ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
