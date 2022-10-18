@extends('layouts.app')

@section('content')

<div>
    <livewire:main />
</div>

@section('script')
<script>

    let toggle = true;
    document.getElementById("menu-toggle").addEventListener("click", function() {
        toggle = false; 
        if (toggle) {
            document.getElementById('trainings-card').className = 'w-100 p-3';
        }else{
            document.getElementById('trainings-card').className = 'vw-100 p-3 px-5';
        }
    });
    window.addEventListener('close-modal', event => {

        $('#deleteTrainingModal').modal('hide');
        $('#updateTrainingModal').modal('hide');
        $('#deleteAttendanceModal').modal('hide');
        $('#printAttendanceModal').modal('hide');
        $('#updateAttendanceModal').modal('hide');
        $('#showAttendanceModal').modal('hide');
        $('#submitTrainingModal').modal('hide'); 
        $('#submitTrainingModal').modal('hide');
        $('#approveTrainingModal').modal('hide');
        $('#rejectTrainingModal').modal('hide');
        $('#removeSubmissionTrainingModal').modal('hide');
        $('#deleteIdpModal').modal('hide');
        $('#submitIdpModal').modal('hide');
        $('#printIdpModal').modal('hide');
        $('#approveIdpModal').modal('hide');
        $('#rejectIdpModal').modal('hide');
        $('#removeSubmissionIdpModal').modal('hide');
        $('#notificationModal').modal('hide');
        $('#createConfirmationTrainingModal').modal('hide');
        $('#editConfirmationTrainingModal').modal('hide');
        $('#createConfirmationAttendanceModal').modal('hide');
        $('#editConfirmationAttendanceModal').modal('hide');
        $('#createConfirmationIdpModal').modal('hide');
        $('#editConfirmationIdpModal').modal('hide');
        $('#printTrainingModal').modal('hide');
        
    })
    window.addEventListener('show-notification', event => {
        $('#notificationModal').modal('show');
    })
    window.addEventListener('confirmation-create-training', event => {
        $('#createConfirmationTrainingModal').modal('show');
    })


</script>
@endsection
@endsection