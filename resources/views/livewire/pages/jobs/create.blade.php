<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>
        {{-- TODO: Add form here --}}
        <div >
            @if (session()->has('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            <div class="flex flex-col lg:flex-row gap-8">
              <!-- Job Details -->
              <div class="lg:w-2/3 space-y-6 p-4 rounded overflow-hidden shadow-lg">
                <h2 class="text-lg font-medium text-gray-900">Job details</h2>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                  <input type="text" wire:model="jobTitle" placeholder="Job Title" class="w-full border p-2 rounded">
                  @error('jobTitle') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                  <textarea wire:model="description" placeholder="Job Description" class="w-full border p-2 rounded"></textarea>
                 @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                    <input type="text" wire:model="experience" placeholder="Experience (e.g., 1-3 Yrs)" class="w-full border p-2 rounded">
                    @error('experience') <span class="text-red-500">{{ $message }}</span> @enderror
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                    <input type="text" wire:model="salary" placeholder="Salary" class="w-full border p-2 rounded">
                    @error('salary') <span class="text-red-500">{{ $message }}</span> @enderror
                  </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" wire:model="location" placeholder="Location" class="w-full border p-2 rounded">
                    @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Extra Info</label>
                    <input type="text" wire:model="extraInfo" placeholder="Extra Info" class="w-full border p-2 rounded">
                    @error('extraInfo') <span class="text-red-500">{{ $message }}</span> @enderror
                    <p class="mt-1 text-sm text-gray-500">Please use comma seperated values</p>
                  </div>
                </div>
              </div>

              <!-- Company Details and Skills -->
              <div class="lg:w-1/3 space-y-6 p-4 rounded overflow-hidden shadow-lg">
                <div>
                  <h2 class="text-lg font-medium text-gray-900 mb-4">Company details</h2>

                  <div class="space-y-4">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                      <input type="text" wire:model="companyName" placeholder="Company Name" class="w-full border p-2 rounded">
                      @error('companyName') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                      <input type="file" wire:model="logo" class="w-full border p-2 rounded">
                        @error('logo') <span class="text-red-500">{{ $message }}</span> @enderror

                        <!-- Live Preview -->
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="mt-2 w-24 h-24 object-cover rounded">
                        @endif
                    </div>
                  </div>
                </div>

                <div>
                  <h2 class="text-lg font-medium text-gray-900 mb-4">Skills</h2>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <select wire:model="selectedSkills" multiple class="w-full border p-2 rounded">
                        @if (!empty($skills) && is_array($skills))
                            @foreach ($skills as $skill)
                                <option value="{{ $skill['id'] }}">{{ $skill['name'] }}</option>
                            @endforeach
                        @else
                            <option disabled>No skills available</option>
                        @endif
                    </select>
                    @error('selectedSkills') <span class="text-red-500">{{ $message }}</span> @enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-8">
              <button wire:click="save"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
              >
                Save
              </button>
            </div>
          </div>
    </div>
</div>





