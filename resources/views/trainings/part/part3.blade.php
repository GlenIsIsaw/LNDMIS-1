
@if ($state == 'editTraining')
<label>
    <input type="checkbox" wire:model="editCert" >
        Edit the Current Certificate
</label><br>

@else
    @php
        $editCert = 1;
    @endphp
@endif

@if ($editCert)
    <div class="mb-3">
        <label class="fw-bold">Attach the Certificate</label><span class="text-danger fw-bold">*</span>
        <div
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        >
            <input type="file" wire:model="photo" accept="image/*" class="form-control border border-3 border-secondary">
            <div wire:loading wire:target="photo">
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
            
        </div>
        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
    
    </div> 
@endif


