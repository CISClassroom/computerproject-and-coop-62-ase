<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members as proposal;
use App\userspend as userspend; 
use DB;
use Carbon\Carbon;
use Auth;


class userController extends Controller
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
        'end_date'=>$end_date);
        
       
        
        $insert=proposal::postform($data);
        //dd($insert);
        return redirect()->route('borrow');
    }

    public function formbudget(Request $req){
        $personal_name = $req->input('personal_name');
        $Budget = $req->input('Budget');
        $balance = $req->input('balance');
        $created_at = $req->input('created_at');
        $updated_at = $req->input('updated_at');

        $data = array ('personal_name'=>$personal_name,
        'Budget'=>$Budget,
        'balance'=>$balance,
        'created_at'=>$created_at,
        'updated_at'=>$updated_at);

         //dd($data);
         $insert= develop_budget::formbudget($data);
         return redirect()->route('Budget');
    }

    //หน้าเลือกผู้ยืม
    public function borrow()
    {
  
        $users = DB::table('users')
                ->get();
        $proposal = DB::table('proposal')
                ->get();
        $user_spend = DB::table('user_spend')
                ->where('amount','=',$user_spend)
                ->get();
        
        return view ('borrow',['users' => $users->toArray(),'proposal_id'=>$proposal,'user_spend' =>$user_spend,'amount'=>$amount]);
 
    }
    

//เรียกใช้หน้าหลัก user
    public function indexuser(Request $Request)
    {
        //ใช้สำหรับแสดงข้อมูลใน proposal ในโครงการของฉัน
        $proposal = DB::table('proposal') 
                ->orderBy('date', 'desc') //เรียงตาม วัน ล่าสุด
                ->where('user_id','=',Auth::id()) //เลือก user id ในตาราง proposal ให้เป็น id ปัจจุบัน
                ->get();
      //ใช้สำหรับแสดงข้อมูลใน user_spend ในตารางแจ้งเตือนใหม่
        $user_spend = DB::table('user_spend') 
                ->where('user_spend.user_id','=',Auth::id()) //เลือก user id ในตาราง user spend เป็นไอดีปัจจุบัน 
                ->join('proposal', 'proposal.id_proposal', '=', 'user_spend.id_proposal')  //join ตาราง proposal และตาราง user_spend
                ->join('users', 'users.id', '=', 'proposal.user_id') //join  ตาราง users และตาราง proposal
                ->get(['user_spend.id','users.name','proposal.project_name','user_spend.amount','user_spend.status']);
       //dd($user_spend);
       
       $budget = DB::table('budget')
            -> where('year','=',2563)
            ->get();

        return view ('indexuser',['proposal' => $proposal,'user_spend'=>$user_spend,'budget'=>$budget]); //ส่งค่า proposal user spend ไปที่หน้า indexuser
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        //dd($indexuser);
       return view('edit',compact('indexuser','id'));
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
        ->where('user_id','=',$id)
        ->get();
        //dd($proposal);
        $user_spend =DB::table('user_spend')
        ->where('amount','=',$user_spend)
        ->get();
         
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
        'end_date'=>$end_date);
        
       

        proposal::where('user_id',$user_id)
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

        return view('request',['proposal' => $proposal]);
    }

    //หน้าอนุมัติการยืม
    public function getrequest($id)
    {
        
        $user_spend = DB::table('user_spend')
                ->join('users', 'users.id', '=', 'user_spend.user_id')
                ->join('proposal', 'proposal.id_proposal', '=', 'user_spend.id_proposal')
                ->where('user_spend.user_id','=',Auth::id())
                ->get();
      
        $proposal = DB::table('proposal')
                ->where('id_proposal','=',$user_spend[0]->id_proposal)   
                ->get();      
        $users = DB::table('users')
                ->where('id','=',$proposal[0]->user_id)   
                ->get();   
        

        return view('request',['user_spend'=>$user_spend,'id' =>$id,'proposal'=>$proposal,'users'=>$users]);

    }

    public function getapprove(Request $req)
    {
        
        $id = $req->input('id');
        $amount = $req->input('amount');
        $status = $req->input('status');
        
        $data = array (
            'amount'=>$amount,
            'status'=> $status);
            
        //dd($data);

        DB::table('user_spend')
            ->where('id', $id)
            ->update($data);

        
        return redirect()->route('indexuser',
        ['id'=> $id,
        'amount'=>$amount,
        'status'=>$status]);
    }
    

    //add new user spend from 
    public function adduserspend(Request $Request){ 

        $users = DB::table('users')->where('id','!=',Auth::id())->get();
       
       

        $id_proposal = $Request->input('id_proposal');
        $amount = $Request->input('amount');
        $user_id = $Request->input('user_id');
        $status = $Request->input('status');
        $Status= 'รออนุมัติ';

        $data = array (
            'id_proposal'=>$id_proposal,
            'amount'=>$amount,
            'user_id'=>$user_id,
            'status'=>$status);
        //dd($data);
        // add to user_spend table
        $data = userspend::adduserspend($data);

        return view('borrow',
        ['users' => $users->toArray(),
        'amount'=>$amount,
        'id_proposal'=>$id_proposal,
        'status'=>$status]);
    }
    
    

    public function userspend($id,$pid)
    { 
        return view ('inbox',['id' => $id , 'pid' => $pid]);
    }

    public function getuser($id)
    {
        $user_spend = DB::table('user_spend')
        ->where('id_proposal','=',$id)   
        ->get();
        //dd($proposal);
        return view('request',['user_spend' => $user_spend]);
       
    }
    
 
}
