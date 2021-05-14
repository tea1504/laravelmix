<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::with('department')->get();
        return response()->json($staff);
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
    function convert_name($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $staff = new Staff();
        $staff->department_id = $request->department_id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->identity_card_number = $request->identity_card_number;
        $staff->phone_number = $request->phone_number;
        $staff->address = $request->address;
        $staff->username = $this->convert_name($request->last_name.' '.$request->first_name.(Staff::count() + 1));
        $staff->password = Hash::make('12345');
        if ($request->hasFile('image')) {
            $file = $request->image;
            $staff->image = 'http://demo.laravelmix.local:81/api/image/staff/' . $file->getClientOriginalName();
            $file->storeAs('public/staff', $file->getClientOriginalName());
        } else {
            $staff->image = 'http://demo.laravelmix.local:81/api/image/staff/default.png';
        }
        $staff->save();
        return response()->json(['username' => $staff->username, 'password' => '12345']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        return response()->json($staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, $id)
    {
        // dd($request->user());
        $staff = Staff::find($id);
        $staff->department_id = $request->department_id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->identity_card_number = $request->identity_card_number;
        $staff->phone_number = $request->phone_number;
        $staff->address = $request->address;
        // $staff->updated_at = Carbon::now();
        if ($request->hasFile('image')) {
            $tempImage = $staff->image;
            Storage::delete('public/user/' . substr($tempImage, strrpos($tempImage, '/') + 1));
            $file = $request->image;
            $staff->image = 'http://demo.laravelmix.local:81/api/image/staff/' . $file->getClientOriginalName();
            $file->storeAs('public/staff', $file->getClientOriginalName());
        }
        $staff->save();
        return response()->json($staff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $tempImage = $staff->image;
        Storage::delete('public/user/' . substr($tempImage, strrpos($tempImage, '/') + 1));
        $staff->delete();
        return 'delete';
    }
}
