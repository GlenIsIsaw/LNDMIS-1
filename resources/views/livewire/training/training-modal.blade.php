
<!-- Show Training Modal -->
<div wire:ignore.self class="modal fade" id="showTrainingModal" tabindex="-1" aria-labelledby="showTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTrainingModalLabel" class="text-break">Show {{$certificate_title}}</h5>
                <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">

                <img class="img-fluid" src="{{ url('storage/users/'.$name.'/'.$certificate) }}">

            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteTrainingModal" tabindex="-1" aria-labelledby="deleteTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTrainingModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Confirmation Training Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationTrainingModal" tabindex="-1" aria-labelledby="createConfirmationTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createConfirmationTrainingModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <h6>Are you sure you want to save your Input?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Confirmation Training Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationTrainingModal" tabindex="-1" aria-labelledby="editConfirmationTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editConfirmationTrainingModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <h6>Are you sure you want to edit your training info?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Submit Training Modal -->
<div wire:ignore.self class="modal fade" id="submitTrainingModal" tabindex="-1" aria-labelledby="submitTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitTrainingModalLabel">Submit {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    <h4>Are you sure you want to submit your input ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove Submit Training Modal -->
<div wire:ignore.self class="modal fade" id="removeSubmissionTrainingModal" tabindex="-1" aria-labelledby="removeSubmissionTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeSubmissionTrainingModalLabel">Remove Submission of {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="removeSubmit">
                <div class="modal-body">
                    <h4>Are you sure you want to remove your submission ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Remove Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Atendance Modal -->
<div wire:ignore.self class="modal fade" id="deleteAttendanceModal" tabindex="-1" aria-labelledby="deleteAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAttendanceModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyAttendanceForm">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print Atendance Modal -->
<div wire:ignore.self class="modal fade" id="printAttendanceModal" tabindex="-1" aria-labelledby="printAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAttendanceModalLabel">Print Attendance Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAttendanceForm">
                <div class="modal-body">
                    <h4>Are you sure you want to print this Attendance Form ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Confirmation Attendance Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationAttendanceModal" tabindex="-1" aria-labelledby="createConfirmationAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createConfirmationAttendanceModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeAttendanceForm">
                <div class="modal-body">
                    <h6>Are you sure you want to save your Input?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Confirmation Training Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationAttendanceModal" tabindex="-1" aria-labelledby="editConfirmationAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editConfirmationAttendanceModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateAttendanceForm">
                <div class="modal-body">
                    <h6>Are you sure you want to edit your Attendance Form info?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<!-- Approve Training Modal -->
<div wire:ignore.self class="modal fade" id="approveTrainingModal" tabindex="-1" aria-labelledby="approveTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveTrainingModalLabel">Approve the Submitted Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Approve this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="showCommentModal" tabindex="-1" aria-labelledby="showCommentModalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCommentModalLabel">Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Comment:</label>
                        <p>{{$comment}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Reject Training Modal -->
<div wire:ignore.self class="modal fade" id="rejectTrainingModal" tabindex="-1" aria-labelledby="rejectTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectTrainingModalLabel">Reject the Submitted Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="reject">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Reject this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Printall Modal -->
<div wire:ignore.self class="modal fade" id="printTrainingModal" tabindex="-1" aria-labelledby="printTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printTrainingModalLabel">Print Approved Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAll">
                <div class="modal-body">
                    <h6>Range</h6>
                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control">
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control">
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print All</button>
                </div>
            </form>
        </div>
    </div>
</div>