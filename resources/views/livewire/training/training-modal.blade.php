
<!-- Show Training Modal -->
<div wire:ignore.self class="modal fade" id="showTrainingModal" tabindex="-1" aria-labelledby="showTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="showTrainingModalLabel" class="text-break">Show {{$certificate_title}}</h5>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-info text-white float-start text-uppercase py-1" style="background-image: linear-gradient(
                    to bottom, #43C6AC,
                    #191654);" wire:click="downloadCert"><i class="fas fa-download me-2"></i>Download</button>
                @if ($state == 'editTraining')
                    <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                    ><i class="fas fa-times"></i></button>
                @else
                    <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="backButton"><i class="fas fa-times"></i></button>
                @endif
                </div>
            </div>
            <div class="modal-body">

                @if ($show)
                    @if ($fileType == "pdf")
                    <div class="container" style="  width:50px; 
                    height: 50px;
                    position:absolute;
                    left:50%;
                    top:50%;
                    margin-top:-25px; 
                    margin-left:-25px;">
                        <iframe class="responsive-iframe" style="  position: absolute;
                        top: 0;
                        left: 0;
                        bottom: 0;
                        right: 0;
                        width: 100%;
                        height: 250px;
                        border: none;" src="{{ url('storage/users/'.$user_id.'/'.$certificate) }}?{{ rand() }}"></iframe>
                    </div>

                    @else
                        <img class="img-fluid justify-center" style="justify-center" src="{{ url('storage/users/'.$user_id.'/'.$certificate) }}?{{ rand() }}">
                    @endif
                @endif
                
              

                

            </div>
        </div>
    </div>
</div>
<!-- View Training Modal -->
<div wire:ignore.self class="modal fade" id="viewTrainingModal" tabindex="-1" aria-labelledby="viewTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="viewTrainingModalLabel" class="text-break">Show {{$certificate_title}}</h5>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="backButton"><i class="fas fa-times"></i></button>

                </div>
            </div>
            <div class="modal-body">
                <table class="table table-borderd table-striped table-responsive">
                    <tbody class="table-responsive">
                        @if ($table != 'My Trainings')
                            <tr>
                                <th>Name</th>
                                <td>{{$name}}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Certificate Type</th>
                            <td>{{$certificate_type}}</td>
                        </tr>
                        <tr>
                            <th>Certificate Title</th>
                            <td>{{$certificate_title}}</td>
                        </tr>
                        <tr>
                            <th>Date Conducted</th>
                            <td>{{$date_covered}}</td>
                        </tr>
                        <tr>
                            <th>Venue</th>
                            <td>{{$venue}}</td>
                        </tr>
                        <tr>
                            <th>Sponsors</th>
                            <td>{{$sponsors}}</td>
                        </tr>
                        <tr>
                            <th>Number of Hours</th>
                            <td>{{$num_hours}}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>{{$level}}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{$type}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View Attendance Report Training Modal -->
<div wire:ignore.self class="modal fade" id="viewAttModal" tabindex="-1" aria-labelledby="viewAttModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="viewAttModalLabel" class="text-break">Show {{$certificate_title}} Attendance Report</h5>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-danger px-3 mx-2 float-end" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="backButton"><i class="fas fa-times"></i></button>

                </div>
            </div>
            <div class="modal-body">
                <table class="table table-borderd table-striped table-responsive">
                    <tbody class="table-responsive">
                        <tr>
                            <th style="width: 35%">Name</th>
                            <td>{{$name}}</td>
                        </tr>
                        <tr>
                            <th>Title of Intervention Attended</th>
                            <td>{{$certificate_title}}</td>
                        </tr>
                        <tr>
                            <th>Date Conducted</th>
                            <td>{{$date_covered}}</td>
                        </tr>
                        <tr>
                            <th>Venue</th>
                            <td>{{$venue}}</td>
                        </tr>
                        <tr>
                            <th>Sponsors</th>
                            <td>{{$sponsors}}</td>
                        </tr>
                            <th>Specific Competency to Develop/Enhance</th>
                            <td>{{$competency}}</td>
                        </tr>
                        <tr>
                            <th>Knowledge Acquired</th>
                            <td>{{$knowledge_acquired}}</td>
                        </tr>
                        <tr>
                            <th>Outcome</th>
                            <td>{{$outcome}}</td>
                        </tr>
                        <tr>
                            <th>Personal Action</th>
                            <td>{{$personal_action}}</td>
                        </tr>
                    </tbody>
                </table>
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
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="deleteTrainingModalLabel">Delete {{$certificate_title}}</h5>
                
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body text-capitalize fw-bold fs-6">
                    <h6 class="fs-6 fw-bold text-capitalize">Are you sure you want to delete this data ?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
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
                <h5 class="modal-title fw-bold text-uppercase fs-4" id="createConfirmationTrainingModalLabel">Confirmation</h5>
                
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <h6 class="text-capitalize fs-6 fw-bold">Are you sure you want to save your Input?</h6>
                    @if(count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
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
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="editConfirmationTrainingModalLabel">Confirmation</h5>
               
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body fw-bold text-uppercase">
                    <h6 class="fs-6 text-capitalize fw-bold">Are you sure you want to edit your training info?</h6>
                    @if(count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
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
                <h5 class="modal-title fw-bold text-uppercase fs-4" id="submitTrainingModalLabel">Submit {{$certificate_title}}</h5>
                
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body fw-bold text-capitalize fs-6">
                    <h6 class="fs-6 fw-bold text-capitalize">Are you sure you want to submit your input ?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
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
                <h5 class="modal-title fs-4 text-uppercase fw-bold" id="removeSubmissionTrainingModalLabel">Cancel the Submission</h5>
               
            </div>
            <form wire:submit.prevent="removeSubmit">
                <div class="modal-body">
                    <h4 class="fs-6 fw-bold text-capitalize">Are you sure you want to cancel your submission ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Cancel Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Attendance Modal -->
<div wire:ignore.self class="modal fade" id="deleteAttendanceModal" tabindex="-1" aria-labelledby="deleteAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-4 text-uppercase fw-bold" id="deleteAttendanceModalLabel">Delete {{$certificate_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyAttendanceForm">
                <div class="modal-body">
                    <h4 class="fs-6 text-capitalize fw-bold">Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print Attendance Modal -->
<div wire:ignore.self class="modal fade" id="printAttendanceModal" tabindex="-1" aria-labelledby="printAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="printAttendanceModalLabel">Download Attendance Form</h5>
                
            </div>
            <form wire:submit.prevent="printAttendanceForm">
                <div class="modal-body text-capitalize fs-6 fw-bold">
                    <h6 class="fs-6 fw-bold text-capitalize">Are you sure you want to Download this Attendance Form ?</h6>
                    
                    @if ($checkmySignature)
                        <label class="ps-4 fs-6">
                            <input type="checkbox" wire:model="mySignature" class="fw-light fs-6">
                            Include My Signature
                        </label>
                    @endif

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
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
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="createConfirmationAttendanceModalLabel">Confirmation</h5>
                
            </div>
            <form wire:submit.prevent="storeAttendanceForm">
                <div class="modal-body text-capitalize fs-6 fw-bold">
                    <h6>Are you sure you want to save your Input?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
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
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="editConfirmationAttendanceModalLabel">Confirmation</h5>
                
            </div>
            <form wire:submit.prevent="updateAttendanceForm">
                <div class="modal-body">
                    <h6 class="fs-6 fw-bold text-capitalize">Are you sure you want to edit your Attendance Form info?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="approveTrainingModalLabel">Approve the Submitted Training</h5>
                
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4 class="fs-6 text-capitalize fw-bold">Are you sure you want to Approve this Submission ?</h4>
                        <hr class="h-color mx-2 mt-3">
                        <label class="mb-3 fw-bold text-capitalize fs-5">Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control border-3 border-dark"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Comment Training Modal -->
<div wire:ignore.self class="modal fade" id="showCommentModal" tabindex="-1" aria-labelledby="showCommentModalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold fs-4" id="showCommentModalLabel">Comment</h5>
                
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        
                        <p class="fs-4 lh-base text-md-start">{{$comment}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Reject Training Modal -->
<div wire:ignore.self class="modal fade" id="rejectTrainingModal" tabindex="-1" aria-labelledby="rejectTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase fw-bold fs-5" id="rejectTrainingModalLabel">Disapprove the Submitted Training</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="reject">
                <div class="modal-body">
                    <div class="mb-3">
                        <h6 class="fs-6 text-capitalize fw-bold">Are you sure you want to Disapprove this submission?</h6>
                        <hr class="h-color mx-2 mt-3">
                        <label class="fw-bold text-capitalize fs-5 mb-3">Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control border-3 border-dark"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Disapprove</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Filter Modal -->
<div wire:ignore.self class="modal fade" id="filterTrainingModal" tabindex="-1" aria-labelledby="filterTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="filterTrainingModalLabel">Filter Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @if ($table != 'My Trainings')
                        <div class="mb-3">
                            <label  class="fw-bold">Search by Certificate Title:</label>
                            <input type="search" wire:model="filter_certificate_title" class="form-control border border-dark border-3 rounded-3" placeholder="Search..." />
                        </div>
                    @endif
 
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Status:</label>
                        <select wire:model="filter_status" class="form-control border border-dark border-3 rounded-3">
                            <option value="">...</option>
                            <option value="Approved">Approved</option>
                            <option value="Not Submitted">Not Submitted</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        @php
                            $data = [];
                            foreach ($filter as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'certificate_type'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp

                        <label class="fw-bold">Sort by Certificate Type:</label>
                        <select type="text" wire:model="filter_certificate_type" class="form-control border border-dark border-3 rounded-3">
                                    <option value="">...</option>
                                    @foreach (array_unique($data) as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach

                        </select>
                    </div>
                    <div class="mb-3">
                        @php
                            $data = [];
                            foreach ($filter as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'level'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp
                        <label class="fw-bold">Sort by Level:</label>
                        <select wire:model="filter_level" class="form-control border border-dark border-3 rounded-3">
                            <option value="">...</option>
                            @foreach (array_unique($data) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @php
                        $data = [];
                            foreach ($filter as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'type'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp
                        <label class="fw-bold">Sort by Type:</label>
                        <select wire:model="filter_type" class="form-control border border-dark border-3 rounded-3">
                            <option value="">...</option>
                            @foreach (array_unique($data) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <label class="fw-bold">Sort by Date Covered:</label>    
                    <div class="mx-3 my-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border border-dark border-3 rounded-3"> 

                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-dark border-3 rounded-3">
                    </div>
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>