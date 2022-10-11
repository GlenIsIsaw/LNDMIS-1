


<div>


    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                @if ($click)
                    <div class="card">
                        @if ($create)
                            @include('trainings.create')
                        @endif
                        @if ($update)
                            @include('trainings.edit')
                        @endif
                        @if ($createAttendanceForm)
                            @include('attendanceForm.create')
                        @endif
                        @if ($editAttendanceForm)
                            @include('attendanceForm.edit')
                        @endif
                        @if ($showAttendanceForm)
                            @include('attendanceForm.show')
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{$table}}
                                <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                
                                
                            </h4>
                            
                        </div>

                        
                        <div class="card-header bg-transparent border-0">
                            <div class="float-end mx-2">
                                <label>Sort By</label>
                                <select wire:model="filterStatus" class="text-center text-center border border-dark border-2 rounded">
                                    <option value="All">Default</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Not Submitted">Not Submitted</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                                
                            

                        <div class="card-body">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            @if ($table != "My Trainings")
                                                <th scope="col">Name</th>
                                            @endif
                                            
                                            <th scope="col">Certificate Title</th>
                                            <th scope="col">Date Covered</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Number of Hours</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Sponsors</th>
                                            <th scope="col">Attendance Report</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trainings as $training)
                                            <tr>
                                                @if ($table != "My Trainings")
                                                    <td>{{$training->name}}</td>
                                                @endif
                                                <td class="text-break">{{$training->certificate_title}}</td>
                                                <td class="text-break">{{ $training->date_covered }}</td>
                                                <td>{{ $training->level }}</td>
                                                <td class="text-break">{{ $training->num_hours }}</td>
                                                <td class="text-break">{{ $training->venue }}</td>
                                                <td>{{ $training->sponsors }}</td>
                                                @if ($training->attendance_form == 0)
                                                    <td><button type="button" wire:click="createAttendanceForm({{$training->training_id}})" class="btn btn-warning">Create</button></td>
                                                @else
                                                    <td>
                                                        <button type="button" wire:click="showAttendanceForm({{$training->training_id}})" class="btn btn-success">View</button>
                                                        @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                            <button type="button" wire:click="editAttendanceForm({{$training->training_id}})" class="btn btn-primary">Edit</button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal" wire:click="deleteAttendanceForm({{$training->training_id}})" class="btn btn-danger">Delete</button>
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{ $training->status }}</td>

                                                <td>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#showTrainingModal" wire:click="show({{$training->training_id}})" class="btn btn-warning">View</button>


                                                    @if ($training->status != 'Approved')
                                                        @if ($training->status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-success">Approve</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-danger">Reject</button>
                                                            @endif    
                                                        @endif

                                                            @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
                                                                @if ($training->attendance_form == 1) 
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#submitTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-success">Submit</button>
                                                                @endif
                                                                
                                                            @endif
                                                            @if ($training->status == 'Pending')
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-danger">Remove Submission</button>
                                                            @else
                                                                <button type="button" wire:click="edit({{$training->training_id}})" class="btn btn-primary">Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteTrainingModal" wire:click="delete({{$training->training_id}})" class="btn btn-danger mx-2">Delete</button>
                                                            @endif
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty    
                                            <tr>
                                                <td colspan="10">No Record/s Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $trainings->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('livewire.training.training-modal')
</div>
    
    

