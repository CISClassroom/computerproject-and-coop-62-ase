<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members as proposal;
use App\Budget as budget;
use DB;
use Carbon\Carbon;
use Auth;

class staffController extends Controller
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
        'user_id'=>Auth::id(),
        'end_date'=>$end_date);
        
       
        //dd($data);
        $insert=proposal::postform($data);
        return redirect()->route('borrow');
    }

    public function staff()
    {
        $proposal =  DB::table('proposal')->join('users', 'users.id', '=', 'proposal.user_id')
        ->orderBy('date', 'desc')
       
        ->get();
        $date = $proposal->toArray();
        //dd($proposal);
        return view ('staff',['proposal' => $proposal]);
    }

    public function index()
    {
    return view('admin/dashboard');
    }
    
    public function borrow()
    {
        $proposal = proposal::all()->toArray();
       
        return view ('borrow',['proposal' => $proposal]);
        
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
      
    }


    public function getproposal($id)
    {
        $proposal = DB::table('proposal')
        ->where('id_proposal','=',$id)
        ->get();

        $users = DB::table('users')
        ->join('proposal', 'name', '=', 'user_spend.user_id')
        ->where('id_proposal','=',$id)
        ->get();

        $user_spend = DB::table('user_spend')
        ->join('users', 'users.id', '=', 'user_spend.user_id')
        ->join('proposal', 'proposal.id_proposal', '=', 'user_spend.id_proposal')
        ->join('users', 'users.id', '=', 'proposal.user_id')
        ->where('user_spend.user_id','=',Auth::id())
        ->get();
        
        //dd($proposal);
        return view('document',['proposal' => $proposal,'users' => $users,'user_spend' => $user_spend]);
    }
   

    public function updatestaff(Request $req)
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
        
       
        //dd($data);
        proposal::where('id_proposal',$id_proposal)
        ->update($data);
       return redirect()->route('staff');
    }

    public function getresultstaff($id)
    {
        $proposal = DB::table('proposal')
        ->where('id_proposal','=',$id)   
        ->get();
        //dd($proposal);
        return view('results',['proposal' => $proposal]);
    }
    
    public function addbudget(Request $req){

        $id_budget = $req->input('id_budget');
        $year = $req->input('year');
        $amount = $req->input('amount');

        $data = array ('year'=>$year,
        'amount'=>$amount);
    
        $insert=budget::addbudget($data);
        return redirect()->route('budget');
    
    }

    public function budget()
    {
        $budget = budget::all()->toArray();
        $budget = DB::table('budget')
                ->get();
        $date = $budget->toArray();
        //dd($data);
        return view ('budget',['budget' => $budget]);
    }

    public function postbudget(Request $req){

        $budget = DB::table('budget')
        ->where('id_budget','=',$id)
        ->get();
        return view('budget',['budget' => $budget]);
    }
 
   
}


