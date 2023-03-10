<div class="card-header">
    <div class="fw-bold fs-3 text-uppercase">
        Upload Training    
    </div>
</div>
<div class="card-body">
        @if ($next == 0)
            @include('trainings.part.part1')
        @endif
        @if ($next == 1)
            @include('trainings.part.part2')
        @endif
        @if ($next == 2)
            @include('trainings.part.part3')
            @if ($photo)
                @php
                    $ext = $photo->getClientOriginalExtension();
                @endphp
                @if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'svg')
                    Uploaded Photo:
                    <img class="img-fluid rounded mx-auto d-block" width="500" height="500" src="{{ $photo->temporaryUrl() }}">
                @else
                    <h5>No Preview Available</h5>
                @endif
                
            @endif
            <div class="mt-3">
                <hr class="h-color mx-2 mt-3">
            <div class="float-end">
            <button type="button" class="btn btn-secondary" wire:click="back" id="back" wire:loading.attr="disabled">Back</button>
            <button type="button"  wire:click="backButton" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createConfirmationTrainingModal" class="btn btn-primary rounded-3 px-3 py-2 text-center"><i class="fas fa-save me-2"></i>Save</button>
            </div>
            </div>
        @endif
            

</div>