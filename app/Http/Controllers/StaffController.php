<?php

namespace App\Http\Controllers;

use App\StaffDetails;
use App\StaffModel;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffList = StaffModel::get();
        return view('index', compact('staffList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $staffStore = new StaffModel();
            $staffStore->first_name = $request->first_name;
            $staffStore->last_name = $request->last_name;
            $staffStore->staff_number = $request->staff_number;
            $staffStore->department = $request->department;
            $staffStore->save();
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

        return redirect('/personel-takip');
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
        $staffInfo = StaffModel::find($id);
        return view('edit', compact('staffInfo'));
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
        try{
            StaffModel::where('id', $id)
                ->update([
                    'first_name'   => $request->first_name,
                    'last_name'    => $request->last_name,
                    'staff_number' => $request->staff_number,
                    'department'    => $request->department
                    ]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
        return redirect('/personel-takip');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff_info = StaffModel::find($id);
        $staff_info->delete();

        $staff_day = StaffDetails::where('staff_id', $id);
        $staff_day->delete();
    }

    public function staff_details($id){
        $staff_info = StaffModel::find($id);
        $staff_day = StaffDetails::where('staff_id', $id)->get();

        return view('staff_detail', compact('staff_info', 'staff_day'));
    }

    public function staff_add_day($id){
        $staff_info = StaffModel::find($id);
        return view('add_day', compact('staff_info'));
    }

    public function staff_add_day_store(Request $request){
        $day = date('Y-m-d', strtotime($request->staff_day));
        try{
            $staffStore = new StaffDetails();
            $staffStore->day = $day;
            $staffStore->checkin = $request->checkin;
            $staffStore->checkout = $request->checkout;
            $staffStore->staff_id = $request->staff_id;
            $staffStore->save();
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

        return redirect('/personel-takip/detail/'.$request->staff_id);
    }

    public function delete_day(Request $request){
        $delete_day = StaffDetails::where('id', $request->id);
        $delete_day->delete();
    }

    public function staff_edit_day($id){
        $editDetails = StaffDetails::find($id);
        $staff_info = StaffModel::where('id', $editDetails->staff_id)->first();
        return view('staff_edit', compact('editDetails', 'staff_info'));
    }

    public function staff_edit_day_update(Request $request){
        try{
            $day = date('Y-m-d', strtotime($request->staff_day));
            StaffDetails::where('id', $request->edit_id)
                ->update([
                    'day' => $day,
                    'checkin' => $request->checkin,
                    'checkout' => $request->checkout,
                ]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

        return redirect('/personel-takip/detail/'.$request->staff_id);
    }
}
