<dialog class="modal" id="modal_create_alternative">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Add New Alternative</h3>
        <form method="POST" action="{{ route('admin.alternative.store') }}">
            @csrf
            <div class="grid gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Name *</legend>
                    <input 
                        class="input validator w-full @error('name') input-error @enderror" 
                        name="name" 
                        type="text" 
                        placeholder="Enter alternative name"
                        value="{{ old('name') }}"
                        required 
                        maxlength="150"
                    />
                    @error('name')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label text-alt-text">Required - Maximum 150 characters</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Type *</legend>
                    <select class="select validator w-full @error('type') select-error @enderror" name="type" required>
                        <option value="">Select Type</option>
                        <option value="matic" @selected(old('type') === 'matic')>Matic</option>
                        <option value="maxi series" @selected(old('type') === 'maxi series')>Maxi Series</option>
                        <option value="classy" @selected(old('type') === 'classy')>Classy</option>
                        <option value="sport" @selected(old('type') === 'sport')>Sport</option>
                        <option value="offroad" @selected(old('type') === 'offroad')>Offroad</option>
                        <option value="moped" @selected(old('type') === 'moped')>Moped</option>
                    </select>
                    @error('type')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label text-alt-text">Required - Select motorcycle type</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Model</legend>
                    <input 
                        class="input validator w-full @error('model') input-error @enderror" 
                        name="model" 
                        type="text" 
                        placeholder="Enter model name"
                        value="{{ old('model') }}"
                        maxlength="255"
                    />
                    @error('model')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label text-alt-text">Optional - Maximum 255 characters</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Year</legend>
                    <input 
                        class="input validator w-full @error('year') input-error @enderror" 
                        name="year" 
                        type="number" 
                        placeholder="Enter year"
                        value="{{ old('year') }}"
                        min="1900"
                        max="{{ date('Y') + 1 }}"
                        maxlength="4"
                    />
                    @error('year')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label text-alt-text">Optional - 4 digits (1900 - {{ date('Y') + 1 }})</p>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Description</legend>
                    <textarea 
                        class="textarea validator w-full @error('description') textarea-error @enderror" 
                        name="description" 
                        placeholder="Enter description"
                        rows="3"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="label text-alt-text">Optional - Additional information about the alternative</p>
                </fieldset>
            </div>
            <div class="modal-action">
                <button class="btn" type="button" onclick="modal_create_alternative.close()">Cancel</button>
                <button class="btn btn-primary" type="submit">
                    <x-lucide-plus class="w-4 h-4 mr-1" />
                    Create Alternative
                </button>
            </div>
        </form>
    </div>
    <form class="modal-backdrop" method="dialog">
        <button>close</button>
    </form>
</dialog>