<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\AttendanceForm;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class TrainingShow extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $name,$comment , $certificate_type, $certificate_title, $level, $date_covered, $venue, $sponsors, $num_hours, $type, $certificate, $status , $attendance_form ,$ListOfTraining_id, $user_id, $photo;
    public $competency, $knowledge_acquired, $outcome, $personal_action, $att_id;
    public $filter_status,$filter_certificate_type, $filter_level, $filter_type, $search, $start_date, $end_date, $filter_certificate_title;
    protected $queryString = ['search','filter_status','filter_certificate_type', 'filter_level', 'filter_type','start_date', 'end_date','filter_certificate_title'];
    

    public $query = [];
    public $table = 'Approved Trainings';

    public $click = false;
    public $create = false;
    public $update = false;
    public $createAttendanceForm = false;
    public $editAttendanceForm = false;
    public $showAttendanceForm = false;

    protected $listeners = [
        'createTraining' => 'createButton',
        'clearTraining' => 'clear',
        'passTraining' => 'passTable',
        'refreshComponent' => '$refresh'
    ];


    public $next = 0;

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
        $this->click = true;
        $this->create = true;
        $this->update = false;
        $this->createAttendanceForm = false;
        $this->editAttendanceForm = false;
        $this->showAttendanceForm = false;
    }
    public function updateButton(){
        $this->next = 0;
        $this->click = true;
        $this->create = false;
        $this->update = true;
        $this->createAttendanceForm = false;
        $this->editAttendanceForm = false;
        $this->showAttendanceForm = false;
    }
    public function createAttButton(){
        $this->click = true;
        $this->create = false;
        $this->update = false;
        $this->createAttendanceForm = true;
        $this->editAttendanceForm = false;
        $this->showAttendanceForm = false;
    }
    public function editAttButton(){
        $this->click = true;
        $this->create = false;
        $this->update = false;
        $this->createAttendanceForm = false;
        $this->editAttendanceForm = true;
        $this->showAttendanceForm = false;
    }
    public function showAttButton(){
        $this->click = true;
        $this->create = false;
        $this->update = false;
        $this->createAttendanceForm = false;
        $this->editAttendanceForm = false;
        $this->showAttendanceForm = true;
    }
    public function clear(){
        $this->next = 0;
        $this->check = true;
        $this->click = false;
        $this->create = false;
        $this->update = false;
        $this->createAttendanceForm = false;
        $this->editAttendanceForm = false;
        $this->showAttendanceForm = false;
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
    protected function rules()
    {
        return [
            'certificate_title' => 'required',
            'level' => 'required',
            'date_covered' => 'required',
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'certificate_type' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'

        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    
    public function store()
    {   
            $this->next = 0;
            $this->user_id = auth()->user()->id;
            $validatedData = $this->validate();
            $list = new ListOfTraining();
            $list->user_id = $this->user_id;
            $list->certificate_title = $this->certificate_title;
            $list->level = $this->level;
            $list->date_covered = $this->date_covered;
            $list->certificate_type = $this->certificate_type;
            $list->venue = $this->venue;
            $list->sponsors = $this->sponsors;
            $list->type = $this->type;
            $list->num_hours = $this->num_hours;
            $list->certificate = 'No Image';

            $list->save();

            if($validatedData['photo']){
                $user = User::find($this->user_id);
                $lists = ListOfTraining::find($list->id);
                $filename = date('Ymd').$lists->id;
                $validatedData['photo']->storeAs('public/users/'.$user->name, $filename);
                $lists->certificate = $filename;
                $lists->save();
            }

            
            session()->flash('message','Training Added Successfully');
            $this->backButton();
            $this->dispatchBrowserEvent('close-modal');
        
    }

    public function show(int $id)
    {
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
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
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }
    public function edit(int $id)
    {

        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
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
            $this->certificate = $lists->certificate;
            $this->updateButton();
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }

    public function update()
    {
        $validatedData = $this->validate([            
            'user_id' => 'required',
            'certificate_title' => 'required',
            'level' => 'required',
            'date_covered' => 'required',
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'certificate_type' => 'required',
        ]);
        $list = ListOfTraining::find($this->ListOfTraining_id);
        $list->user_id = $this->user_id;
        $list->certificate_title = $this->certificate_title;
        $list->level = $this->level;
        $list->date_covered = $this->date_covered;
        $list->certificate_type = $this->certificate_type;
        $list->venue = $this->venue;
        $list->sponsors = $this->sponsors;
        $list->type = $this->type;
        $list->num_hours = $this->num_hours;

        if($this->photo){
            $user = User::find($this->user_id);
            File::delete(storage_path('app/public/users/'.$user->name.'/'.$list->certificate));
            $filename = date('Ymd').$list->id;
            $this->photo->storeAs('public/users/'.$user->name, $filename);
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
        $list = ListOfTraining::join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('list_of_trainings.id','=',$this->ListOfTraining_id)
                        ->first();
        File::delete(storage_path('app/public/users/'.$list->name.'/'.$list->certificate));
        ListOfTraining::find($this->ListOfTraining_id)->delete();
        session()->flash('message','ListOfTraining Deleted Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function createAttendanceForm($id){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','certificate_title')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('list_of_trainings.id', $id)
                                    ->first();
        if($lists){
            $this->ListOfTraining_id = $lists->training_id;
            $this->name = $lists->name;
            $this->certificate_title = $lists->certificate_title;
            $this->createAttButton();
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }

    public function storeAttendanceForm(){
        $this->next = 0;
        $validatedData = $this->validate([
            'ListOfTraining_id' => 'required',
            'competency' => 'required',
            'knowledge_acquired' => 'required',
            'outcome' => 'required',
            'personal_action' => 'required'
        ]);
        $list = new AttendanceForm();
        $list->list_of_training_id = $this->ListOfTraining_id;
        $list->competency =$this->competency;
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
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','competency','attendance_forms.id as att_id','knowledge_acquired','outcome','personal_action','attendance_form','status')
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
            $this->editAttButton();
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
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
        $list->competency =$this->competency;
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
        $this->certificate_title = '';
        $this->level = '';
        $this->date_covered = '';
        $this->venue = '';
        $this->sponsors = '';
        $this->num_hours = '';
        $this->type = '';
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
    
    public function printAttendanceForm(){


        $training = DB::table('list_of_trainings')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('colleges', 'colleges.id', '=', 'users.college_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('list_of_trainings.id', $this->ListOfTraining_id)
        ->select('name', 'certificate_title', 'date_covered','college_name', 'level','venue','sponsors','competency','knowledge_acquired','outcome','personal_action')
        ->first();
        

        $array = [
            'name' => $training->name,
            'certificate_title' => $training->certificate_title,
            'date_covered' => $training->date_covered,
            'venue' => $training->venue,
            'sponsors' => $training->sponsors,
            'competency' => $training->competency,
            'knowledge_acquired' => $training->knowledge_acquired,
            'outcome' => $training->outcome,
            'personal_action' => $training->personal_action
        ];

        $templateProcessor = new TemplateProcessor(storage_path('Attendance-Report.docx'));
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }
            $templateProcessor->setValue('college',$training->college_name);

                $templateProcessor->setValue('esign'," ");
                $templateProcessor->setValue('edate'," ");
                $templateProcessor->setValue('ssign'," ");
                $templateProcessor->setValue('sdate'," ");

        $templateProcessor->saveAs($training->name.'_'.$training->certificate_title.'_Attendance_Report.docx');
        $this->dispatchBrowserEvent('close-modal');
        return response()->download(public_path($training->name.'_Attendance_Report.docx'))->deleteFileAfterSend(true);
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
    public function printAll(){

        $s_date = Carbon::parse($this->start_date)->toDateTimeString();
        $e_date = Carbon::parse($this->end_date)->toDateTimeString();
        
        $listObject = DB::table('list_of_trainings')
                        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->join('colleges', 'colleges.id', '=', 'users.college_id')
                        ->where('college_id',auth()->user()->college_id)
                        ->whereBetween('list_of_trainings.date_covered',[$s_date,$e_date])
                        ->where('teacher', 'Yes')
                        ->orderBy('name','asc')
                        ->select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                        ->get();
        $grouped = $listObject->groupBy('name');
        $list = $grouped->toArray();
        $templateProcessor = new TemplateProcessor(storage_path('Certificate.docx'));

        $templateProcessor->setValue('deptname',auth()->user()->college_name);
        $templateProcessor->setValue('year',date('Y'));
        $templateProcessor->setValue('daterange',strftime("%B",strtotime($this->start_date)).' to '.strftime("%B",strtotime($this->end_date)).' '.date('Y'));


        $replacements = array();
        $i = 0;
        foreach($list as $name => $cert) {
            $replacements[] = array(
                'name' => $name,
                'certificate_title' => '${certificate_title_'.$i.'}',
                'date_covered' => '${date_covered_'.$i.'}',
                'level' => '${level_'.$i.'}',
                'num_hours' => '${num_hours_'.$i.'}'
    );
                $i++;
}
        $templateProcessor->cloneBlock('table', count($replacements), true, false, $replacements);

        $i = 0;
        foreach($list as $group) 
        {
            $values = array();
            foreach($group as $row) 
            {
                $values[] = array(
                    "certificate_title_{$i}" => $row->certificate_title,
                    "date_covered_{$i}" => $row->date_covered,
                    "level_{$i}" => $row->level,
                    "num_hours_{$i}" => $row->num_hours);
            }
            $templateProcessor->cloneRowAndSetValues("certificate_title_{$i}", $values);

            $i++;
        }
        $listObject = DB::table('users')
                        ->join('list_of_trainings', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('college_id',auth()->user()->college_id)
                        ->whereBetween('list_of_trainings.date_covered',[$s_date,$e_date])
                        ->where('teacher', 'No')
                        ->orderBy('name','asc')
                        ->select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                        ->get();

        $grouped = $listObject->groupBy('name');

        $list = $grouped->toArray();

        $replacements = array();
        $i = 0;
        foreach($list as $name => $cert) {
            $replacements[] = array(
                'name2' => $name,
                'certificate_title2' => '${certificate_title2_'.$i.'}',
                'date_covered2' => '${date_covered2_'.$i.'}',
                'level2' => '${level2_'.$i.'}',
                'num_hours2' => '${num_hours2_'.$i.'}'
    );
                $i++;
}
        $templateProcessor->cloneBlock('table2', count($replacements), true, false, $replacements);

        $i = 0;
        foreach($list as $group) 
        {
            $values = array();
            foreach($group as $row) 
            {
                $values[] = array(
                    "certificate_title2_{$i}" => $row->certificate_title,
                    "date_covered2_{$i}" => $row->date_covered,
                    "level2_{$i}" => $row->level,
                    "num_hours2_{$i}" => $row->num_hours);
            }
            $templateProcessor->cloneRowAndSetValues("certificate_title2_{$i}", $values);

            $i++;
        }
        $templateProcessor->setValue('facultypercentage',100 .'%');
        $templateProcessor->setValue('nonpercentage',100 .'%');
        $templateProcessor->setValue('coordname',auth()->user()->name);

        $templateProcessor->setValue('coordsignature'," ");
        $templateProcessor->saveAs('ListOfTrainings.docx');
        return response()->download(public_path('ListOfTrainings.docx'))->deleteFileAfterSend(true);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
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
    public function render()
    {
        $this->notification();
        $this->checkTable();
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate','attendance_form','status','list_of_trainings.updated_at','role_as','comment')
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
                ->paginate(3);
        }else {

            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate','attendance_form','status','list_of_trainings.updated_at','role_as','comment')
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
                ->paginate(3);
        }

                                    
        return view('livewire.training-show', ['trainings' => $lists]);
    }
}