<?php

namespace App\Http\Livewire\Training;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\AttendanceForm;
use App\Models\ListOfTraining;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class TrainingShow extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $name,$comment , $certificate_type, $certificate_title,$seminar_type, $level, $date_covered, $specify_date, $venue, $sponsors, $num_hours, $type, $certificate, $status , $attendance_form ,$ListOfTraining_id, $user_id, $photo,$mySignature, $checkmySignature, $currentUrl, $toggle, $fileType, $idp_Competency, $idp_id;
    public $certificate_type_others, $level_others, $type_others, $seminar_type_others;
    public $approved, $pending, $notSubmitted, $rejected;
    public $competency, $knowledge_acquired, $outcome, $personal_action, $att_id;
    public $filter_status,$filter_certificate_type, $filter_level, $filter_type, $search, $start_date, $end_date, $filter_certificate_title;
    protected $queryString = ['search','filter_status','filter_certificate_type', 'filter_level', 'filter_type','start_date', 'end_date','filter_certificate_title'];
    

    public $query = [];
    public $table = 'My Trainings';

    public $state = null;
    public $next = null;

     protected $listeners = [
        'createTraining' => 'createButton',
        'clearTraining' => 'clear',
        'passTraining' => 'passTable',
        'refreshComponent' => '$refresh',
        'toggle' => 'open'
    ];
    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
    public function countStatus(){
        $this->approved = ListOfTraining::where('status', 'Approved')->where('user_id', auth()->user()->id)->count();
        $this->notSubmitted = ListOfTraining::where('status', 'Not Submitted')->where('user_id', auth()->user()->id)->count();
        $this->rejected = ListOfTraining::where('status', 'Rejected')->where('user_id', auth()->user()->id)->count();
        $this->pending = ListOfTraining::where('status', 'Pending')->where('user_id', auth()->user()->id)->count();
    }

    public function approvedTraining(){
        $this->clear();
        $this->table = 'Approved Trainings';
    }
    public function myTraining(){
        $this->clear();
        $this->table = 'My Trainings';
    }
    public function submittedTraining(){
        $this->clear();
        $this->table = 'Submitted Trainings';
    }
    

    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function next(){
        ++$this->next;
    }
    public function back(){
        --$this->next;
    }
    public function part($num){
        $this->next = $num;
    }

    public function createButton(){
        $this->next = 0;
        $this->state = 'createTraining';
    }
    public function updateButton(){
        $this->next = 0;
        $this->state = 'editTraining';
    }
    public function createAttButton(){
        $this->next = 0;
        $this->state = 'createAttendance';

    }
    public function editAttButton(){
        $this->next = 0;
        $this->state = 'editAttendance';

    }
    public function showAttButton(){
        $this->state = 'showAttendance';

    }
    public function clear(){
        $this->next = null;
        $this->state = null;
        $this->confirm = false;
    }
    public function backButton(){
        $this->resetInput();
        $this->clear();
    }
    
    public function checkCoord(){
        if(auth()->user()->role_as == 0)
        {
            return true;
        }
        else{ 
            return false;
        }
    }
    public function passTable($string){
        $this->table = $string;
    }
    public function checkTable(){
        if($this->checkCoord()){
            $this->table = 'My Trainings';
        }
        if($this->table == 'My Trainings'){

            $this->query = ['users.id',auth()->user()->id];
        }
        if($this->table == 'Submitted Trainings'){

            $this->query = ['status','Pending'];
        }
        if($this->table == 'Approved Trainings'){

            $this->query = ['status','Approved'];
        }
    } 
    public function checkUpdatedTable(){
        if($this->table == 'My Trainings'){
            $this->clear();
            $this->query = ['users.id',auth()->user()->id];
        }
        if($this->table == 'Submitted Trainings'){
            $this->clear();
            $this->query = ['status','Pending'];
        }
        if($this->table == 'Approved Trainings'){
            $this->clear();
            $this->query = ['status','Approved'];
        }
    }

    public function part1(){
        $validatedData = $this->validate([
            'certificate_title' => 'required',
            'level' => 'required',
            'level_others' => Rule::requiredIf($this->level == 'Others'),
            'date_covered' => 'required',
            'certificate_type' => 'required',
            'certificate_type_others' => Rule::requiredIf($this->certificate_type == 'Others'),
            'seminar_type' => 'required',
            'seminar_type_others' => Rule::requiredIf($this->seminar_type == 'Others'),
        ]);
        ++$this->next;
    }
    public function part2(){
        $validatedData = $this->validate([
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'type_others' => Rule::requiredIf($this->type == 'Others'),
            
        ]);
        ++$this->next;
    }
    
    public function store()
    {   
        $validatedData = $this->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
            $this->next = 0;
            $this->user_id = auth()->user()->id;
            $list = new ListOfTraining();
            $list->user_id = $this->user_id;
            if($this->certificate_type == 'Others'){
                $list->certificate_type = "Others: ".$this->certificate_type_others;
            }else {
                $list->certificate_type = $this->certificate_type;
            }
            if($this->seminar_type == 'Others'){
                $list->seminar_type = "Others: ".$this->seminar_type_others;
            }else {
                $list->seminar_type = $this->seminar_type;
            }
            if($this->level == 'Others'){
                $list->level = "Others: ".$this->level_others;
            }else {
                $list->level = $this->level;
            }
            if($this->type == 'Others'){
                $list->type = "Others: ".$this->type_others;
            }else {
                $list->type = $this->type;
            }
            $list->certificate_title = $this->certificate_title;
            $list->date_covered = $this->date_covered;
            $list->specify_date = $this->specify_date;
            $list->venue = $this->venue;
            $list->sponsors = $this->sponsors;
            $list->num_hours = $this->num_hours;
            $list->certificate = 'No Image';

            $list->save();

            if($validatedData['photo']){
                $ext = $this->photo->getClientOriginalExtension();
                $user = User::find($this->user_id);
                $lists = ListOfTraining::find($list->id);
                $filename = date('Ymd').$lists->id.".".$ext;
                $folderPath = storage_path('app/public/users/'.$this->user_id);
                if(!is_dir($folderPath))
        		{
        			mkdir($folderPath, 0755, true);
        		}
                
                $validatedData['photo']->storeAs('public/users/'.$this->user_id, $filename);
                $lists->certificate = $filename;
                $lists->save();
            }

            
            session()->flash('message','Training Added Successfully');
            $this->backButton();
            $this->dispatchBrowserEvent('close-modal');
        
    }

    public function fileType($filename){
        $array = explode(".", $filename);
        return strtolower(end($array));

    }
    public function show(int $id)
    {
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                            ->where('list_of_trainings.id', $id)
                                            ->first();
        
        if($lists){
            $this->certificate_type = $lists->certificate_type;
            

            $this->level = $lists->level;

            $this->type = $lists->type;

            $this->name = $lists->name;
            $this->certificate_title = $lists->certificate_title;
            
            $this->date_covered = $lists->date_covered;
            $this->venue = $lists->venue;
            $this->sponsors = $lists->sponsors;
            $this->num_hours = $lists->num_hours;
            $this->fileType = $this->fileType($lists->certificate);
            $this->certificate = $lists->certificate;
            $this->status = $lists->status;
            $this->attendance_form = $lists->attendance_form;
            $this->ListOfTraining_id = $lists->training_id;
            $this->user_id = $lists->user_id;
        }else{
            return redirect()->to('/training')->with('message','No results found');
        }
    }
    public function downloadCert(){
        $ext = explode(".", $this->certificate);
        return response()->download(storage_path("app/public/users/".$this->user_id."/".$this->certificate), $this->certificate_title.".".end($ext));
    }
    public function edit(int $id)
    {

        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status', 'seminar_type')
                                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                            ->where('list_of_trainings.id', $id)
                                            ->first();
        
        if($lists){
            
            $this->name = $lists->name;
            $this->certificate_type = $lists->certificate_type;
            $this->seminar_type = $lists->seminar_type;
            $this->certificate_title = $lists->certificate_title;
            $this->level = $lists->level;
            $this->date_covered = $lists->date_covered;
            $this->venue = $lists->venue;
            $this->sponsors = $lists->sponsors;
            $this->num_hours = $lists->num_hours;
            $this->type = $lists->type;
            $this->certificate = $lists->certificate;
            $this->fileType = $this->fileType($lists->certificate);
            $this->status = $lists->status;
            $this->attendance_form = $lists->attendance_form;
            $this->ListOfTraining_id = $lists->training_id;
            $this->user_id = $lists->user_id;
            $this->certificate = $lists->certificate;
            $this->updateButton();
        }else{
            return redirect()->to('/training')->with('message','No results found');
        }
    }
 
    public function update()
    {
        //dd($this->user_id);
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if($this->certificate_type == 'Others'){
            $list->certificate_type = "Others: ".$this->certificate_type_others;
        }else {
            $list->certificate_type = $this->certificate_type;
        }
        if($this->seminar_type == 'Others'){
            $list->seminar_type = "Others: ".$this->seminar_type_others;
        }else {
            $list->seminar_type = $this->seminar_type;
        }
        if($this->level == 'Others'){
            $list->level = "Others: ".$this->level_others;
        }else {
            $list->level = $this->level;
        }
        if($this->type == 'Others'){
            $list->type = "Others: ".$this->type_others;
        }else {
            $list->type = $this->type;
        }
        $list->user_id = $this->user_id;
        $list->certificate_title = $this->certificate_title;
        //$list->level = $this->level;
        $list->date_covered = $this->date_covered;
        $list->specify_date = $this->specify_date;
        //$list->certificate_type = $this->certificate_type;
        //$list->seminar_type = $this->seminar_type;
        $list->venue = $this->venue;
        $list->sponsors = $this->sponsors;
        //$list->type = $this->type;
        $list->num_hours = $this->num_hours;

        if($this->photo){
            $ext = $this->photo->getClientOriginalExtension();
            File::delete(storage_path('app/public/users/'.$this->user_id.'/'.$list->certificate));
            $filename = date('Ymd').$list->id.".".$ext;
            $this->photo->storeAs('public/users/'.$this->user_id, $filename);
            $list->certificate = $filename;

        }
        $list->save();
        
        session()->flash('message','ListOfTraining Updated Successfully');
        $this->backButton();
        
        $this->dispatchBrowserEvent('close-modal');

        
    }

    public function delete(int $id)
    {
        $this->ListOfTraining_id = $id;
    }

    public function destroy()
    {
        $list = ListOfTraining::where('list_of_trainings.id','=',$this->ListOfTraining_id)
                        ->first();
        File::delete(storage_path('app/public/users/'.$list->user_id.'/'.$list->certificate));
        ListOfTraining::find($this->ListOfTraining_id)->delete();
        session()->flash('message','ListOfTraining Deleted Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function createAttendanceForm($id){
        $test = ListOfTraining::select('idps.user_id As idp_id')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('idps', 'idps.user_id', '=', 'list_of_trainings.user_id')
            ->where('list_of_trainings.id', $id)
            ->where('year', date('Y'))
            ->first();
        if($test){
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','certificate_title','competency', 'idps.id As idp_id')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->join('idps', 'idps.user_id', '=', 'list_of_trainings.user_id')
                                    ->where('list_of_trainings.id', $id)
                                    ->where('year', date('Y'))
                                    ->first();
            if($lists){
                $this->ListOfTraining_id = $lists->training_id;
                $this->idp_competency = json_decode($lists->competency, true);
                $this->idp_id = $lists->idp_id;
                $this->name = $lists->name;
                $this->certificate_title = $lists->certificate_title;
                $this->createAttButton();
                //dd($lists);
            }else{
                $this->backButton();
                session()->flash('message','Some Error Happened');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else {
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','certificate_title')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                //->join('idps', 'idps.user_id', '=', 'list_of_trainings.user_id')
                ->where('list_of_trainings.id', $id)
                ->first();
                $this->ListOfTraining_id = $lists->training_id;
                $this->idp_competency = [];
                $this->idp_id = null;
                $this->name = $lists->name;
                $this->certificate_title = $lists->certificate_title;
                $this->createAttButton();

                session()->flash('message','You have no IDP this Year');
                $this->dispatchBrowserEvent('close-modal');
        }
        
    }

    public function part1_att(){
        $validatedData = $this->validate([
            'ListOfTraining_id' => 'required',
            'competency' => 'required',
            'knowledge_acquired' => 'required',
        ]);
        ++$this->next;
    }
    public function storeAttendanceForm(){
        $this->next = 0;
        $validatedData = $this->validate([
            'outcome' => 'required',
            'personal_action' => 'required'
        ]);
        //dd($validatedData);
        $list = new AttendanceForm();
        if(strpos($this->competency, '#')){
            $array = explode('#', $this->competency);
            $list->idp_id = $array[0];
            //dd($array);
            $list->competency = end($array);
        }else {
            $list->competency =$this->competency;
        }
        $list->list_of_training_id = $this->ListOfTraining_id;
        
        $list->knowledge_acquired =$this->knowledge_acquired;
        $list->outcome =$this->outcome;
        $list->personal_action =$this->personal_action;

        $train = ListOfTraining::find($this->ListOfTraining_id);
        $train->attendance_form = 1;
        
        $list->save();
        $train->save();
        session()->flash('message','Attendance Form Added Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function showAttendanceForm($id){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','competency','attendance_forms.id as att_id','knowledge_acquired','outcome','personal_action','attendance_form','status')
                                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                                ->where('list_of_trainings.id', $id)
                                ->first();
        if($lists){
            $this->name = $lists->name;
            $this->certificate_type = $lists->certificate_type;
            $this->certificate_title = $lists->certificate_title;
            $this->level = $lists->level;
            $this->date_covered = $lists->date_covered;
            $this->venue = $lists->venue;
            $this->sponsors = $lists->sponsors;
            $this->num_hours = $lists->num_hours;
            $this->type = $lists->type;
            $this->certificate = $lists->certificate;
            $this->status = $lists->status;
            $this->attendance_form = $lists->attendance_form;
            $this->ListOfTraining_id = $lists->training_id;
            $this->user_id = $lists->user_id;
            $this->att_id = $lists->att_id;
            $this->certificate = $lists->certificate;
            $this->competency = $lists->competency;
            $this->knowledge_acquired = $lists->knowledge_acquired;
            $this->outcome = $lists->outcome;
            $this->personal_action = $lists->personal_action;

            
            $this->showAttButton();
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }
    public function editAttendanceForm($id){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','competency','attendance_forms.id as att_id','knowledge_acquired','outcome','personal_action','attendance_form','status', 'idp_id')
                                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                                ->where('list_of_trainings.id', $id)
                                ->first();
        if($lists){
            $this->att_id = $lists->att_id;
            $this->name = $lists->name;
            $this->ListOfTraining_id = $lists->training_id;
            $this->competency = $lists->competency;
            $this->knowledge_acquired = $lists->knowledge_acquired;
            $this->outcome = $lists->outcome;
            $this->personal_action = $lists->personal_action;
            if($lists->idp_id){
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','certificate_title','competency', 'idps.id As idp_id')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->join('idps', 'idps.user_id', '=', 'list_of_trainings.user_id')
                                    ->where('list_of_trainings.id', $id)
                                    ->where('year', date('Y'))
                                    ->first();
                $this->ListOfTraining_id = $lists->training_id;
                $this->idp_competency = json_decode($lists->competency, true);
                $this->idp_id = $lists->idp_id;
                $this->name = $lists->name;
                $this->certificate_title = $lists->certificate_title;
                $this->editAttButton();
                //dd($lists);

        }else {
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','certificate_title')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                //->join('idps', 'idps.user_id', '=', 'list_of_trainings.user_id')
                ->where('list_of_trainings.id', $id)
                ->first();
                $this->ListOfTraining_id = $lists->training_id;
                $this->idp_competency = [];
                $this->idp_id = null;
                $this->name = $lists->name;
                $this->certificate_title = $lists->certificate_title;
                $this->createAttButton();

                session()->flash('message','This training is not Connected to an IDP');
                $this->editAttButton();
                $this->dispatchBrowserEvent('close-modal');
        }
            
        }else{
            return redirect()->to('/training')->with('message','No results found');
        }
    }
    public function updateAttendanceForm(){
        $validatedData = $this->validate([
            'ListOfTraining_id' => 'required',
            'competency' => 'required',
            'knowledge_acquired' => 'required',
            'outcome' => 'required',
            'personal_action' => 'required'
        ]);

        $list = AttendanceForm::find($this->att_id);
        if(strpos($this->competency, '#')){
            $array = explode('#', $this->competency);
            $list->idp_id = $array[0];
            //dd($array);
            $list->competency = end($array);
        }else {
            $list->competency =$this->competency;
        }
        $list->knowledge_acquired =$this->knowledge_acquired;
        $list->outcome =$this->outcome;
        $list->personal_action =$this->personal_action;

        
        $list->save();
        session()->flash('message','Attendance Form Updated Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function deleteAttendanceForm(int $id)
    {
        $this->att_id = $id;
    }
    public function destroyAttendanceForm(){
        $check = AttendanceForm::select('list_of_trainings.id as training_id','certificate_title','attendance_forms.id as att_id','competency','knowledge_acquired','outcome','personal_action','attendance_form')       
                            ->join('list_of_trainings', 'list_of_trainings.id', '=', 'attendance_forms.list_of_training_id')
                            ->where('list_of_trainings.id', $this->att_id)
                            ->first();
        $lists = ListOfTraining::find($check->training_id);

        $lists->attendance_form = 0;
        $lists->status = 'Not Submitted';

        $lists->save();
        AttendanceForm::where('id',$this->att_id)->delete();
        session()->flash('message','Attendance Form Deleted Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
        
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->certificate_type = '';
        $this->certificate_type_others = '';
        $this->certificate_title = '';
        $this->level = '';
        $this->level_others = '';
        $this->date_covered = '';
        $this->venue = '';
        $this->sponsors = '';
        $this->num_hours = '';
        $this->type = '';
        $this->type_others = '';
        $this->certificate = '';
        $this->status = '';
        $this->attendance_form = '';
        $this->ListOfTraining_id = '';
        $this->user_id = '';
        $this->photo = '';
        $this->competency ='';
        $this->knowledge_acquired ='';
        $this->outcome ='';
        $this->personal_action ='';
        $this->comment ='';
        $this->mySignature = '';
        $this->checkmySignature = '';
        $this->fileType = '';
        $this->specify_date = '';
        $this->seminar_type_others = '';
        $this->seminar_type = '';
        $this->resetErrorBag();
    }
    public function resetFilter(){
        $this->start_date =null;
        $this->end_date =null;
        $this->search = null;
        $this->filter_status = null;
        $this->filter_certificate_type = null;
        $this->filter_certificate_title = null;
        $this->filter_level = null;
        $this->filter_type = null;
        $this->emitSelf('refreshComponent');
    }
    public function reject(){
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if(!$this->checkCoord())
        {
            if($list->status = 'Pending'){
                $list->status = 'Rejected';
                $list->comment = $this->comment;
                $list->save();
                session()->flash('message','Rejected the Submission');
                $this->dispatchBrowserEvent('close-modal');
            }else{
                session()->flash('message','The Training is not Submitted');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else {
            session()->flash('message','You do not have the authority to approve this');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function approve(){
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if(!$this->checkCoord())
        {
            if($list->status = 'Pending'){
                $list->status = 'Approved';
                $list->comment = $this->comment;
                $list->save();
                session()->flash('message','Approved the Submission');
                $this->dispatchBrowserEvent('close-modal');
            }else{
                session()->flash('message','The Training is not Submitted');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else{
            session()->flash('message','You do not have the authority to approve this');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function submit(){
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if($list->user_id == auth()->user()->id)
        {
            if ($list->status == 'Not Submitted' || $list->status == 'Rejected'){
                if ($list->attendance_form == 1) {
                    session()->flash('message',$list->certificate_title.' Submitted');
                    $this->dispatchBrowserEvent('close-modal');
                    $list->status = 'Pending';
                    $list->save();
                }else{
                    session()->flash('message','No Attendance Form/Cannot submit');
                    $this->dispatchBrowserEvent('close-modal');
                }
            }else{
                session()->flash('message','The training has already been submitted or accepted');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else{
            session()->flash('message','You do not have the authority to submit this');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function close(){
        $this->dispatchBrowserEvent('close-modal');
    }
    public function removeSubmit(){
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if($list->user_id == auth()->user()->id)
        {
            if ($list->status == 'Pending') {
                session()->flash('message','Removed the Submission of '.$list->certificate_title);
                $this->dispatchBrowserEvent('close-modal');
                $list->status = 'Not Submitted';
                $list->save();
            }else{
                session()->flash('message','You can no longer Remove the Submission');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else{
            session()->flash('message','You have no authority to Remove the Submission');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function signature(int $id){
        $this->ListOfTraining_id = $id;
        $training = AttendanceForm::join('list_of_trainings', 'list_of_trainings.id', '=', 'attendance_forms.list_of_training_id')
                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                            ->where('list_of_trainings.id', $id)
                            ->first();

            if($training->signature){
                $this->checkmySignature = true;
            }else{
                $this->checkmySignature = false;
            }
    }
    public function split($string){
        $date = str_split($string, 10);
        return $date[0];
    }
     public function xmlEntities($str)
    {
        $xml = array('&#8217;','&#8216;','&#96;','&#8245;','&#8242;','&#39;','&#92;','&#46;','&#41;','&#40;','&#8208;','&#47;','&#8211;','&#8212;','&#34;','&#38;','&#60;','&#62;','&#160;','&#161;','&#162;','&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;','&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;','&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;','&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;','&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;','&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;','&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;','&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;','&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;','&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;','&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;','&#251;','&#252;','&#253;','&#254;','&#255;');
        $html = array('&rsquo;','&lsquo;','&grave;','&bprime;','&prime;','&apos;','&bsol;','&period;','&rpar;','&lpar;','&hyphen;','&sol;','&ndash;','&mdash;','&quot;','&amp;','&lt;','&gt;','&nbsp;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;');
        $str = str_replace($html,$xml,$str);
        $str = str_ireplace($html,$xml,$str);
        return $str;
    }
    public function printAttendanceForm(){


        $training = DB::table('list_of_trainings')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('colleges', 'colleges.id', '=', 'users.college_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('list_of_trainings.id', $this->ListOfTraining_id)
        ->select('name', 'certificate_title', 'date_covered','college_name', 'level','venue','sponsors','competency','knowledge_acquired','outcome','personal_action','users.id As user_id','signature', 'attendance_forms.created_at As date_created')
        ->first();
    
        $array = [
            'name' => $training->name,
            'certificate_title' => $this->xmlEntities(htmlentities($training->certificate_title)),
            'date_covered' => $training->date_covered,
            'venue' => $this->xmlEntities(htmlentities($training->venue)),
            'sponsors' => $this->xmlEntities(htmlentities($training->sponsors)),
            'competency' => $training->competency,
            'knowledge_acquired' => $this->xmlEntities(htmlentities($training->knowledge_acquired)),
            'outcome' => $this->xmlEntities(htmlentities($training->outcome)),
            'personal_action' => $this->xmlEntities(htmlentities($training->personal_action))
        ];

        $templateProcessor = new TemplateProcessor(storage_path('Attendance-Report.docx'));
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }
            $templateProcessor->setValue('college',$training->college_name);

            //dd($training->signature);
            if ($training->signature) {
                $templateProcessor->setImageValue('esign', array('path' => public_path('storage/users/'.$training->user_id.'/'.$training->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
            }else {
                $templateProcessor->setValue('esign', ' ');
            }
            
            $templateProcessor->setValue('edate',$this->split($training->date_created));

                
                
                $templateProcessor->setValue('ssign'," ");
                $templateProcessor->setValue('sdate'," ");
        $path = storage_path('app/public/users/'.$training->user_id.'/'.$training->name.'_'.$training->certificate_title.'_Attendance_Report.docx');
        ob_clean();
        $templateProcessor->saveAs($path);
        
        $this->dispatchBrowserEvent('close-modal');
        return response()->download($path)->deleteFileAfterSend(true);
        //exit;
    }
    public function showComment(int $id){
        $lists = ListOfTraining::select('comment')
                ->where('list_of_trainings.id', $id)
                ->first();
        $this->comment = $lists->comment;
    }
    public static function date($date){
        $pieces = explode("-", $date);
        return $pieces;
    }
    public function updatedTable($value){
        $this->checkUpdatedTable();
    }
    public function updatingSearch($value){
        $this->resetPage();
    }
    public function updatingEndDate($value){
        $this->resetPage();
    }
    public function updatingFilterStatus($value){
        $this->resetPage();
    }
    public function updatingFilterLevel($value){
        $this->resetPage();
    }
    public function updatingFilterCertificateType($value){
        $this->resetPage();
    }
    public function updatingFilterCertificateTitle($value){
        $this->resetPage();
    }
    public function updatingFilterType($value){
        $this->resetPage();
    }

    public function mount()
    {
        $this->currentUrl = url()->current();
        //dd($this->currentUrl);
    }
    public function render()
    {
        $this->notification();
        $this->checkTable();
        $this->countStatus();
        $this->dispatchBrowserEvent('toggle');
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate','attendance_form','status','list_of_trainings.updated_at','role_as','comment','specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where($this->query[0],$this->query[1])
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->search)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('status', 'like', '%'.$this->filter_status.'%')
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('certificate_type', 'like', '%'.$this->filter_certificate_type.'%')
                ->where('type', 'like', '%'.$this->filter_type.'%')
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(2);
        }else {

            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate','attendance_form','status','list_of_trainings.updated_at','role_as','comment','specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where($this->query[0],$this->query[1])
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->search)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('status', 'like', '%'.$this->filter_status.'%')
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('certificate_type', 'like', '%'.$this->filter_certificate_type.'%')
                ->where('type', 'like', '%'.$this->filter_type.'%')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(2);
        }

                                    
        return view('livewire.training.training-show', ['trainings' => $lists]);
    }
}
