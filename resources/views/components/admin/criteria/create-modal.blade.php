@props(['nextCode'])
<dialog class="modal" id="modal_create">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Add New Criteria</h3>
        <form method="POST" action="">
            @csrf
            <div class="grid gap-2">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Code</legend>
                    <input type="text" class="input w-full" name="code" value="{{ $nextCode }}" readonly />
                    <p class="label">Auto-generated</p>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Name</legend>
                    <input type="text" class="input w-full" name="name" placeholder="Enter criteria name" required />
                    <p class="label">Required</p>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Type</legend>
                    <select class="select w-full" name="type" required>
                        <option value="">Select Type</option>
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                    <p class="label">Required</p>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Unit</legend>
                    <input type="text" class="input w-full" name="unit" placeholder="Enter measurement unit" />
                    <p class="label">Optional</p>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Description</legend>
                    <textarea class="textarea w-full" name="description" rows="3" placeholder="Enter criteria description"></textarea>
                    <p class="label">Optional</p>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Active</legend>
                    <label class="label cursor-pointer">
                        <input class="checkbox" name="active" type="checkbox" checked />
                        <span class="label-text">Enable this criteria</span>
                    </label>
                </fieldset>
            </div>
            <div class="modal-action">
                <button class="btn" type="button" onclick="modal_create.close()">Cancel</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <form class="modal-backdrop" method="dialog">
        <button>close</button>
    </form>
</dialog>