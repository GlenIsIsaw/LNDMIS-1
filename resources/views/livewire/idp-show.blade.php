
<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                @if ($click)
                    <div class="card">
                        @if($create)
                            @include('idp.create')
                        @endif
                        @if($update)
                            @include('idp.edit')
                        @endif
                        @if($show)
                            @include('idp.show')
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{$table}}
                                <button type="button" class="float-end" wire:click="resetFilter"><i class='fas fa-redo' wire:click="resetInput"></i></button>
                                <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search by Name" style="width: 230px" />
                            </h4>
                        </div>

                        <div class="card-header bg-transparent border-0">
                                
                                
                                <div class="float-end mx-2">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#filterIdpModal" class="btn-info text-white rounded-pill shadow fw-bold text-sm px-5 py-10">Filter</button>
                                </div>
                        </div>

                                <div class="card-body text-center">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="table-bordered">
                                            @if ($table != 'My IDPs')
                                                <th scope="col">Name</th>
                                            @endif
                                            <th scope="col">Competency</th>
                                            <th scope="col">Completion Status</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-danger">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($idps as $idp)
                                            <tr>
                                                @if ($table != 'My IDPs')
                                                    <td>{{$idp->name}}</td>
                                                @endif
                                                <td>
                                                    <ol class="list-group list-group-numbered">
                                                        @foreach ($idp->competency as $item)
                                                            <li class="list-group-item">{{$item}}</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>
                                                    <ol class="list-group list-group-numbered">
                                                        @foreach ($idp->status as $item)
                                                            <li class="list-group-item">{{$item}}</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>{{ $idp->created_at }}</td>
                                                <td>{{ $idp->updated_at }}</td>
                                                <td>{{ $idp->submit_status }}</td>
                                                <td>
                                                    <div class="d-grid gap-3">
                                                    <button type="button" wire:click="show({{$idp->idp_id}})" class="btn-info  btn-lg rounded-pill shadow fw-bold text-white px-5 py-10">View</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#printIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success btn-lg rounded-pill shadow fw-bold px-5 py-10">Print</button>
                                                    @if ($idp->comment)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$idp->idp_id}})" class="btn-info btn-lg rounded-pill shadow fw-bold px-5 py-10 ">View Comment</button>
                                                    @endif


                                                    @if ($idp->submit_status != 'Approved')
                                                        @if ($idp->submit_status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success btn-lg rounded-pill shadow fw-bold px-5 py-10">Approve</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Reject</button>
                                                            @endif    
                                                        @endif

                                                            @if ($idp->submit_status == 'Not Submitted' || $idp->submit_status == 'Rejected')
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#submitIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-success btn-lg rounded-pill shadow fw-bold px-5 py-10">Submit</button>
                                                            @endif
                                                            @if($idp->submit_status != 'Pending')
                                                                <button type="button" wire:click="edit({{$idp->idp_id}})" class="btn-primary btn-lg rounded-pill shadow fw-bold px-5 py-10">Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Delete</button>
                                                            @endif
                                                            
                                                            @if ($idp->submit_status == 'Pending')
                                                                @if (auth()->user()->role_as == 0)
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn-danger btn-lg rounded-pill shadow fw-bold px-5 py-10">Remove Submission</button>
                                                                @endif    
                                                            @endif
                                                    @endif
                                                    
                                                </td>
                                            </div>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">No Record Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{ $idps->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('livewire.idp.idp-modal')
    @include('livewire.main-modal')
</div>