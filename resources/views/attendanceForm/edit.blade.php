<div class="card-header">
	<h4>
        Edit Attendance Form    
    </h4>
</div>
<div class="card-body">
    <form wire:submit.prevent="updateAttendanceForm">
        @if ($next == 0)
            @include('attendanceForm.part.part1')
        @endif
        @if ($next == 1)
            @include('attendanceForm.part.part2')
            <button type="button" data-bs-toggle="modal" data-bs-target="#editConfirmationAttendanceModal" class="btn btn-primary">Save</button>
        @endif   
    </form>
</div>
