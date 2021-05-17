<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        $users = Schedule::all();
        // return view("admin.user.index", ['users' => $users]);
    }



    public function edit($id)
    {
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view(
            "admin.shift.create",
            [
                'users' => User::where('id','!=',1)->get(),
                'shifts' => Shift::all()
            ]
        );
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
        // $this->validate($request, [
        //     'user' => 'required',
        //     'shift' => 'required',
        //     'shift_date' => 'required',
        // ]);

        $date = Schedule::has('user')->where('shift_date', $request->shift_date)->where('shift_id', $request->shift)->get();
        $user = User::findOrFail($request->user);
        
        if ($date->isEmpty()) {

            $schedule = Schedule::create([
                'user_id' => $request->user,
                'shift_id' => $request->shift,
                'shift_date' => $request->shift_date,
            ]);

            $request->session()->flash('success', 'Sukses!');
            return redirect()->back();
        } else {

            foreach ($date as $d) {
                if ($d->user->position == $user->position) {
                    $request->session()->flash('error', 'Nuk mund te kete dy punonjes me te njejtin pozicion ne nje turn!');
                    return redirect()->back()->withInput($request->input());
                } else {
                    $schedule = Schedule::create([
                        'user_id' => $request->user,
                        'shift_id' => $request->shift,
                        'shift_date' => $request->shift_date,
                    ]);

                    $request->session()->flash('success', 'Sukses!');
                    return redirect()->back();
                }
            }
        }
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
}
