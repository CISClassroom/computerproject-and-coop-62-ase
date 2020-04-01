<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members as proposal;
use DB;
use Carbon\Carbon;
use Auth;

class proposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postform(Request $req)
    {
        $project_name= $req->input('project_name');
        $follower_name= $req->input('follower_name');
        $objective= $req->input('objective');
        $vehicle= $req->input('vehicle');
        $registration_fee= $req->input('registration_fee');
        $Attachments= $req->input('Attachments');
        $Allowances_fee= $req->input('Allowances_fee');
        $Allowances_detail= $req->input('Allowances_detail');
        $Accommodation_fee= $req->input('Accommodation_fee');
        $Accommodation_deail= $req->input('Accommodation_deail');
        $Travel_expenses= $req->input('Travel_expenses');
        $Travel_deail= $req->input('Travel_deail');
        $Other_expenses= $req->input('Other_expenses');
        $Other_deail= $req->input('Other_deail');
        $Num_people= $req->input('Num_people');
        $Place= $req->input('Place');
        $Activity_code= $req->input('Activity_code');
        $Status= 'เสนอแผน';
        $Project_cost= $req->input('Project_cost');
        $Own_cost= $req->input('Own_cost');
        $Bosses_opinion= $req->input('Bosses_opinion');
        $Bosses_aproval_result= $req->input('Bosses_aproval_result');
        $dean_opinion= $req->input('dean_opinion');
        $dean_aproval_result= $req->input('dean_aproval_result');
        $Staff_aproval_result= $req->input('Staff_aproval_result');
        $Apoval_date= $req->input('Apoval_date');
        $Activity= $req->input('Activity');
        $date= carbon::now();
        $Start_date= $req->input('Start_date');
        $end_date= $req->input('end_date');
        $type= $req->input('Status1');
        $note= $req->input('note');
        $file= $req->file('file');
        $file_Allowances= $req->file('file_Allowances');
        $file_Accommodation= $req->file('file_Accommodation');
        $file_Travel= $req->file('file_Travel');
        $file_Other= $req->file('file_Other');
        //dd($file,$file_Allowances,$file_Accommodation,$file_Travel,$file_Other);
        
        if ($req->hasFile('file')) {
            // dd('ok');
            $allowedfileExtension = ['doc', 'docx'];
            $file = $req->file('file');
            //ดึงชื่อไฟล์
            $filename = $file->getClientOriginalName();
            //ดึงนามสกุลไฟล์
            $extension = $file->getClientOriginalExtension();
            //ตรวจว่า นามสกุลไฟล์ ตรงกับที่ออนุญาติ
            $check = in_array($extension, $allowedfileExtension);

            if ($check) { //ตรวจเช็คไฟล์ว่านามสกุลตรงกันไหม 
                $newfilename = 'ASE_A' . Carbon:: now()->format('YmdHis');
                $fileresult = $file->storeAs('fileuploads', $newfilename . '.' . $extension);
                $file = $newfilename . '.' .$extension;
                //display alert message

            }

        }//ไฟล์2
            if ($req->hasFile('file_Allowances')) {
            // dd('ok');
            $allowedfileExtension = ['doc', 'docx'];
            $file_Allowances = $req->file('file_Allowances');
            //ดึงชื่อไฟล์
            $filename = $file_Allowances->getClientOriginalName();
            //ดึงนามสกุลไฟล์
            $extension = $file_Allowances->getClientOriginalExtension();
            //ตรวจว่า นามสกุลไฟล์ ตรงกับที่ออนุญาติ
            $check = in_array($extension, $allowedfileExtension);
         
            if ($check) { //ตรวจเช็คไฟล์ว่านามสกุลตรงกันไหม 
                $newfilename = 'ASE_B' . Carbon:: now()->format('YmdHis');
                $fileresult = $file_Allowances->storeAs('fileuploads', $newfilename . '.' . $extension);
                $file_Allowances = $newfilename . '.' .$extension;
                //display alert message
               
            }

        }//ไฟล์3
        if ($req->hasFile('file_Accommodation')) {
            // dd('ok');
            $allowedfileExtension = ['doc', 'docx'];
            $file_Accommodation = $req->file('file_Accommodation');
            //ดึงชื่อไฟล์
            $filename = $file_Accommodation->getClientOriginalName();
            //ดึงนามสกุลไฟล์
            $extension = $file_Accommodation->getClientOriginalExtension();
            //ตรวจว่า นามสกุลไฟล์ ตรงกับที่ออนุญาติ
            $check = in_array($extension, $allowedfileExtension);

            if ($check) { //ตรวจเช็คไฟล์ว่านามสกุลตรงกันไหม 
                $newfilename = 'ASE_C' . Carbon:: now()->format('YmdHis');
                $fileresult = $file_Accommodation->storeAs('fileuploads', $newfilename . '.' . $extension);
                $file_Accommodation = $newfilename . '.' .$extension;
                //display alert message

            }

        }
        //ไฟล์4
        if ($req->hasFile('file_Travel')) {
            // dd('ok');
            $allowedfileExtension = ['doc', 'docx'];
            $file_Travel = $req->file('file_Travel');
            //ดึงชื่อไฟล์
            $filename = $file_Travel->getClientOriginalName();
            //ดึงนามสกุลไฟล์
            $extension = $file_Travel->getClientOriginalExtension();
            //ตรวจว่า นามสกุลไฟล์ ตรงกับที่ออนุญาติ
            $check = in_array($extension, $allowedfileExtension);

            if ($check) { //ตรวจเช็คไฟล์ว่านามสกุลตรงกันไหม 
                $newfilename = 'ASE_D' . Carbon:: now()->format('YmdHis');
                $fileresult = $file_Travel->storeAs('fileuploads', $newfilename . '.' . $extension);
                $file_Travel = $newfilename . '.' .$extension;
                //display alert message
                 //dd($file_Travel); 
            }

        }
        //ไฟล์5
        if ($req->hasFile('file_Other')) {
            // dd('ok');
            $allowedfileExtension = ['doc', 'docx'];
            $file_Other = $req->file('file_Other');
            //ดึงชื่อไฟล์
            $filename = $file_Other->getClientOriginalName();
            //ดึงนามสกุลไฟล์
            $extension = $file_Other->getClientOriginalExtension();
            //ตรวจว่า นามสกุลไฟล์ ตรงกับที่ออนุญาติ
            $check = in_array($extension, $allowedfileExtension);

            if ($check) { //ตรวจเช็คไฟล์ว่านามสกุลตรงกันไหม 
                $newfilename = 'ASE_E' . Carbon:: now()->format('YmdHis');
                $fileresult = $file_Other->storeAs('fileuploads', $newfilename . '.' . $extension);
                $file_Other = $newfilename . '.' .$extension;
                //display alert message 
                //dd($file_Other,$file_Travel);
            }

        }

    $data = array ('project_name'=>$project_name,
        'follower_name'=>$follower_name,
        'objective'=>$objective,
        'vehicle'=>$vehicle,
        'registration_fee'=>$registration_fee,
        'Attachments'=>$Attachments,
        'Allowances_fee' =>$Allowances_fee,
        'Allowances_detail'=>$Allowances_detail,
        'Accommodation_fee'=>$Accommodation_fee,
        'Accommodation_deail'=>$Accommodation_deail,
        'Travel_expenses'=>$Travel_expenses,
        'Travel_deail'=>$Travel_deail,
        'Other_expenses'=>$Other_expenses,
        'Other_deail'=>$Other_deail,
        'Num_people'=>$Num_people,
        'Place'=>$Place,
        'Activity_code' =>$Activity_code,
        'Status'=>$Status,
        'Project_cost'=>$Project_cost,
        'Own_cost'=>$Own_cost,
        'Bosses_opinion'=>$Bosses_opinion,
        'Bosses_aproval_result'=>$Bosses_aproval_result,
        'dean_opinion'=>$dean_opinion,
        'dean_aproval_result'=>$dean_aproval_result,
        'Staff_ aproval_result'=>$Staff_aproval_result,
        'Apoval_date'=>$Apoval_date,
        'Activity'=>$Activity,
        'date'=>$date,
        'Start_date'=>$Start_date,
        'user_id'=>Auth::id(),
        'end_date'=>$end_date,
        'type'=>$type,
        'note'=>$note,
        'file'=>$file,
        'file_Allowances'=>$file_Allowances,
        'file_Accommodation'=>$file_Accommodation,
        'file_Travel'=>$file_Travel,
    	'file_Other'=>$file_Other);
      
        $newproposalid = proposal::postform($data);

        //create new userspend $newproposalid $newproposalid $newproposalid
        $data = array ('id_proposal'=>$newproposalid,
                        'user_id'=>Auth::id(),
                        'amount'=>$Project_cost);
        
        //dd($data); 
        DB::table('user_spend')
        ->insert($data);
      
        
        

        $users = DB::table('users')->where('id','!=',Auth::id())->get();
       
        $budget = DB::table('budget')
            -> where('year','=',2563)
            ->get();
        $amount = $budget->toArray()[0]->amount;

        //dd($newproposalid,$users);
        return view ('borrow',
            ['users' => $users->toArray(),
             'amount'=>$amount,
             'id_proposal'=>$newproposalid]);
        
    }
    
    public function staff()
    {
        $proposal = proposal::all()->toArray();
        $proposal = DB::table('proposal')
                ->orderBy('date', 'desc')
                ->where('id_proposal','=',Auth::id())
                ->get();
        $date = $proposal->toArray();
        //dd($data);
        return view ('staff',['proposal' => $proposal]);
    }

    public function borrow()
    {
        $proposal = proposal::all()->toArray();
        return view ('borrow',['proposal' => $proposal]);
    }

    public function indexuser()
    {
        
        $proposal = DB::table('proposal')
                ->orderBy('date', 'desc')
                ->where('id_proposal','=',Auth::id())
                ->get();
        $data = $proposal->toArray();
    
        $budget = DB::table('budget')
                -> where('year','=',2563)
                ->get();
        $amount = $budget->toArray()[0]->amount;

        $user_spend = DB::table('user_spend')
                ->where('id','=',Auth::id())
                ->get();
        //TODO sent user_spend 
        return view ('indexuser',['proposal' => $data,'user_spend'=> $user_spend,'budget'=>$budget]);
    }

    public function dean()
    {
      
        $proposal = DB::table('proposal')
        ->orderBy('date', 'desc')
        ->where('id_proposal','=',Auth::id())
        ->get();
        $data = $proposal->toArray();
        //dd($data);
        return view ('dean',['proposal' => $proposal]);
    }


    public function petition1()
    {
        $proposal = proposal::all()->toArray();
        return view ('petition1',['proposal' => $proposal]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,['develop_budget_id' => 'required','year' =>'required','Budget' =>'required','deleted_at' =>'required','created_at' =>'required','updated_at' =>'required']);
        // $user = new User(
        // [
        //     'develop_budget_id' => $request->get('develop_budget_id'),
        //     'year' => $request->get('year'),
        //     'Budget' => $request->get('Budget'),
        //     'deleted_at' => $request->get('deleted_at'),
        //     'created_at' => $request->get('created_at'),
        //     'updated_at' => $request->get('updated_at')
        // ]
        // );
        
        // $user->save();
        // return redirect()->route('proposal.Budget')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    


    public function show($id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //=
       $staff = staff::find($id);
       return view('edit',compact('staff','id'));  
       
        $indexuser = indexuser::find($id);
       return view('edit',compact('indexuser','','id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user = User::fine($id_proposal);
        // $user->delete();
        // return redirect()->route('Budget')->with('success', 'ลบข้อมูลเรียบร้อย');
    }


    public function getproposal($id)
    {
        $proposal = DB::table('proposal')
        ->where('id_proposal','=',$id)
        ->get();
        //dd($proposal);
        return view('document',['proposal' => $proposal]);
    }


    public function upteproposal(Request $req)
    {
        $id_proposal= $req->input('id_proposal');
        $project_name= $req->input('project_name');
        $follower_name= $req->input('follower_name');
        $objective= $req->input('objective');
        $vehicle= $req->input('vehicle');
        $registration_fee= $req->input('registration_fee');
        $Attachments= $req->input('Attachments');
        $Allowances_fee= $req->input('Allowances_fee');
        $Allowances_detail= $req->input('Allowances_detail');
        $Accommodation_fee= $req->input('Accommodation_fee');
        $Accommodation_deail= $req->input('Accommodation_deail');
        $Travel_expenses= $req->input('Travel_expenses');
        $Travel_deail= $req->input('Travel_deail');
        $Other_expenses= $req->input('Other_expenses');
        $Other_deail= $req->input('Other_deail');
        $Num_people= $req->input('Num_people');
        $Place= $req->input('Place');
        $Activity_code= $req->input('Activity_code');
        $Status= $req->input('Status');
        $Project_cost= $req->input('Project_cost');
        $Own_cost= $req->input('Own_cost');
        $Bosses_opinion= $req->input('Bosses_opinion');
        $Bosses_aproval_result= $req->input('Bosses_aproval_result');
        $dean_opinion= $req->input('dean_opinion');
        $dean_aproval_result= $req->input('dean_aproval_result');
        $Staff_aproval_result= $req->input('Staff_aproval_result');
        $Apoval_date= $req->input('Apoval_date');
        $Activity= $req->input('Activity');
        $date= carbon::now();
        $Start_date= $req->input('Start_date');
        $end_date= $req->input('end_date');
        $type= $req->input('Status1');
        $note= $req->input('note');
        $file= $req->input('file');

        $data = array ('project_name'=>$project_name,
        'follower_name'=>$follower_name,
        'objective'=>$objective,
        'vehicle'=>$vehicle,
        'registration_fee'=>$registration_fee,
        'Attachments'=>$Attachments,
        'Allowances_fee' =>$Allowances_fee,
        'Allowances_detail'=>$Allowances_detail,
        'Accommodation_fee'=>$Accommodation_fee,
        'Accommodation_deail'=>$Accommodation_deail,
        'Travel_expenses'=>$Travel_expenses,
        'Travel_deail'=>$Travel_deail,
        'Other_expenses'=>$Other_expenses,
        'Other_deail'=>$Other_deail,
        'Num_people'=>$Num_people,
        'Place'=>$Place,
        'Activity_code' =>$Activity_code,
        'Status'=>'เสนอแผน',
        'Project_cost'=>$Project_cost,
        'Own_cost'=>$Own_cost,
        'Bosses_opinion'=>$Bosses_opinion,
        'Bosses_aproval_result'=>$Bosses_aproval_result,
        'dean_opinion'=>$dean_opinion,
        'dean_aproval_result'=>$dean_aproval_result,
        'Staff_ aproval_result'=>$Staff_aproval_result,
        'Apoval_date'=>$Apoval_date,
        'Activity'=>$Activity,
        'date'=>$date,
        'Start_date'=>$Start_date,
        'end_date'=>$end_date,
        'type'=> $type,
        'note'=>$note);

        if($req->hasFile('file')){

            $file = $req->file('file');
            $newfilename = 'ASE_A' .carbon::now()->format('YmdHis');
            $guessExtension = $file->guessExtension();
            $fileresult = $file->storeAs('fileuploads',$newfilename . '.' . $guessExtension);
            $newfilename = $file. '.' .$guessExtension;
            $data += array('file'=>$newfilename);
        }
        
       
        proposal::where('id_proposal',$id_proposal)
         ->update($data);
        return redirect()->route('indexuser');

    }


    public function getproposaluser($id)
    {
        $proposal = DB::table('proposal')
        ->where('id_proposal','=',$id)
        ->get();

        //dd($proposal);
        return view('detail',['proposal' => $proposal]);
    }
    public function getNotifications($id)
    {
        $proposal = DB::table('proposal')
        ->where('id_proposal','=',$id)   
        ->get();
        //dd($proposal);
        return view('request',['proposal' => $proposal]);
    }
    
    public function getdean()
    {
        $proposal = DB::table('proposal')
        ->where('Status','=',"อนุมัติ",'id_proposal','=',$id)
        ->get();
        //dd($proposal);
        return view('petition1',['proposal' => $proposal]);
    }

    public function getmydean($id)
    {
        $proposal = DB::table('proposal')
        ->where('id_proposal','=',$id)
        ->get();
        //dd($proposal);
        return view('petition1',['proposal' => $proposal]);
    }

    public function updatedean(Request $req)
    {
        $id_proposal= $req->input('id_proposal');
        $project_name= $req->input('project_name');
        $follower_name= $req->input('follower_name');
        $objective= $req->input('objective');
        $vehicle= $req->input('vehicle');
        $registration_fee= $req->input('registration_fee');
        $Attachments= $req->input('Attachments');
        $Allowances_fee= $req->input('Allowances_fee');
        $Allowances_detail= $req->input('Allowances_detail');
        $Accommodation_fee= $req->input('Accommodation_fee');
        $Accommodation_deail= $req->input('Accommodation_deail');
        $Travel_expenses= $req->input('Travel_expenses');
        $Travel_deail= $req->input('Travel_deail');
        $Other_expenses= $req->input('Other_expenses');
        $Other_deail= $req->input('Other_deail');
        $Num_people= $req->input('Num_people');
        $Place= $req->input('Place');
        $Activity_code= $req->input('Activity_code');
        $Status= $req->input('Status');
        $Project_cost= $req->input('Project_cost');
        $Own_cost= $req->input('Own_cost');
        $Bosses_opinion= $req->input('Bosses_opinion');
        $Bosses_aproval_result= $req->input('Bosses_aproval_result');
        $dean_opinion= $req->input('dean_opinion');
        $dean_aproval_result= $req->input('dean_aproval_result');
        $Staff_aproval_result= $req->input('Staff_aproval_result');
        $Apoval_date= $req->input('Apoval_date');
        $Activity= $req->input('Activity');
        $date= carbon::now();
        $Start_date= $req->input('Start_date');
        $end_date= $req->input('end_date');
        $type= $req->input('type');
        $note= $req->input('note');
        $file= $req->input('file');

        $data = array ('project_name'=>$project_name,
        'follower_name'=>$follower_name,
        'objective'=>$objective,
        'vehicle'=>$vehicle,
        'registration_fee'=>$registration_fee,
        'Attachments'=>$Attachments,
        'Allowances_fee' =>$Allowances_fee,
        'Allowances_detail'=>$Allowances_detail,
        'Accommodation_fee'=>$Accommodation_fee,
        'Accommodation_deail'=>$Accommodation_deail,
        'Travel_expenses'=>$Travel_expenses,
        'Travel_deail'=>$Travel_deail,
        'Other_expenses'=>$Other_expenses,
        'Other_deail'=>$Other_deail,
        'Num_people'=>$Num_people,
        'Place'=>$Place,
        'Activity_code' =>$Activity_code,
        'Status'=>$Status,
        'Project_cost'=>$Project_cost,
        'Own_cost'=>$Own_cost,
        'Bosses_opinion'=>$Bosses_opinion,
        'Bosses_aproval_result'=>$Bosses_aproval_result,
        'dean_opinion'=>$dean_opinion,
        'dean_aproval_result'=>$dean_aproval_result,
        'Staff_ aproval_result'=>$Staff_aproval_result,
        'Apoval_date'=>$Apoval_date,
        'Activity'=>$Activity,
        'date'=>$date,
        'Start_date'=>$Start_date,
        'end_date'=>$end_date,
        'type'=>$type,
        'note'=>$note,
        'file'=>$file);
        
        
       
        //dd($data);
        proposal::where('id_proposal',$id_proposal)
        ->update($data);
       return redirect()->route('dean');
    }

}


