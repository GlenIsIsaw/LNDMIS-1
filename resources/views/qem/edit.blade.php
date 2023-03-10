<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Edit Quantified Evaluation Matrix  
    </div>
    <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
    wire:click="backButton"></button>
</div>
<div class="card-body">
    @if ($next == 0)
        @include('qem.part.part1')
    @endif
    @if ($next == 1)
        @include('qem.part.part2')
    @endif
    @if ($next == 2)
        @include('qem.part.part3')
    @endif
    @if ($next == 3)
        @include('qem.part.part4')
        <hr class="h-color mx-2 mt-3">
        <button type="button" class="btn btn-secondary" wire:click="back" id="back" wire:loading.attr="disabled">Back</button>
        <div class="float-end">
        
            <button type="button" class="btn btn-danger" wire:click="backButton" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationQemModal" class="btn btn-primary">Save</button>
        </div>
    @endif
</div>