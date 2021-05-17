<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;



class UsersController extends Controller
{
    //
    public function index()
    {
        $users = User::where('id','!=',1)->get();
        return view("admin.user.index", ['users' => $users]);
    }

    public function profile($id)
    {
        $value=session('date');
        $date=new Carbon($value);
        $day=Carbon::parse($date)->format('d');
        $lastDay = Carbon::parse($date)->endOfMonth()->format('d');

        if($day==$lastDay){
            $isLastDay=true;
        }else{
            $isLastDay=false;
        }

        $hours=0;
   
        $user = User::findOrFail($id);
        $schedule=$user->schedule()->where('shift_date',">=",$value)->get();
        foreach($schedule as $s){
            $hours+= $s->shift->duration;
        }
         return view('admin.user.profile', ['user' => $user,'hours'=>$hours,'isLastDay'=>$isLastDay]);
    }

   

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view(
            "admin.user.edit",
            [
                'user' => $user,
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.user.create");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'first_name' => 'required', 'string', 'max:255',
            'last_name' => 'required', 'string', 'max:255',
            'wage_per_hour' => 'required', 'numeric',
            'position' => 'required',
            'start_date' => 'required', 'date', 'date_format:Y-m-d'
        ]);

        $minDoctor = User::where('position', 'doktor')->min('wage_per_hour') - 1;
        $minNurse = User::where('position', 'infermier')->min('wage_per_hour') - 1;
        $maxNurse = User::where('position', 'infermier')->max('wage_per_hour') + 1;
        $maxSan = User::where('position', 'sanitar')->max('wage_per_hour') + 1;

        if ($request->position == 'doktor') {
            if ($request->wage_per_hour < $maxNurse || $request->wage_per_hour < $maxSan) {
                $request->session()->flash('error', 'Rroga e doktorit duhet te jete me e larte se e infermierit dhe e sanitarit!');
                return redirect()->back()->withInput($request->input());
            }
        } elseif ($request->position == 'infermier') {
            if ($request->wage_per_hour > $minDoctor) {
                $request->session()->flash('error', 'Rroga e infermierit nuk mund te jete me e larte se e doktorit!');
                return redirect()->back()->withInput($request->input());
            } else if ($request->wage_per_hour < $maxSan) {
                $request->session()->flash('error', 'Rroga e infermierit duhet te jete me larte se e sanitarit!');
                return redirect()->back()->withInput($request->input());
            }
        } elseif ($request->position == 'sanitar') {
            if ($request->wage_per_hour > $minDoctor || $request->wage_per_hour > $minNurse) {
                $request->session()->flash('error', 'Rroga e sanitarit duhet te jete me e ulet se e doktorit apo infermierit!');
                return redirect()->back()->withInput($request->input());
            }
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'wage_per_hour' => $request->wage_per_hour,
            'position' => $request->position,
            'start_date' => $request->start_date,
        ]);

        $request->session()->flash('success', 'Punonjesi u krijua!');
        return redirect()->back();
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required', 'string', 'max:255',
            'last_name' => 'required', 'string', 'max:255',
            'wage_per_hour' => 'required', 'numeric',
            'position' => 'required',
            'start_date' => 'required', 'date', 'date_format:Y-m-d'
        ]);


        $minDoctor = User::where('position', 'doktor')->min('wage_per_hour') - 1;
        $minNurse = User::where('position', 'infermier')->min('wage_per_hour') - 1;
        $maxNurse = User::where('position', 'infermier')->max('wage_per_hour') + 1;
        $maxSan = User::where('position', 'sanitar')->max('wage_per_hour') + 1;


        if ($request->position == 'doktor') {
            if ($request->wage_per_hour < $maxNurse || $request->wage_per_hour < $maxSan) {
                $request->session()->flash('error', 'Rroga e doktorit duhet te jete me e larte se e infermierit dhe e sanitarit!');
                return redirect()->back()->withInput($request->input());
            }
        } elseif ($request->position == 'infermier') {
            if ($request->wage_per_hour > $minDoctor) {
                $request->session()->flash('error', 'Rroga e infermierit nuk mund te jete me e larte se e doktorit!');
                return redirect()->back()->withInput($request->input());
            } else if ($request->wage_per_hour < $maxSan) {
                $request->session()->flash('error', 'Rroga e infermierit duhet te jete me larte se e sanitarit!');
                return redirect()->back()->withInput($request->input());
            }
        } elseif ($request->position == 'sanitar') {
            if ($request->wage_per_hour > $minDoctor || $request->wage_per_hour > $minNurse) {
                $request->session()->flash('error', 'Rroga e sanitarit duhet te jete me e ulet se e doktorit apo infermierit!');
                return redirect()->back()->withInput($request->input());
            }
        } else {

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->position = $request->position;
            $user->start_date = $request->start_date;
            $user->save();
            $request->session()->flash('success', 'Profili i perdoruesit u ndryshua!');
            return redirect()->route('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        request()->session()->flash('success', 'Perdoruesi u fshi!');
        return redirect()->route('users');
    }

    public function setDate(Request $request){
        session(['date' => $request->date]);
    }
}
