<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishRequest;
use App\Models\Dish;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dish = Dish::with('type')->get();
        return response()->json($dish);
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
    public function store(DishRequest $request)
    {
        $dish = new Dish();
        $dish->type_id = $request->type_id;
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $dish->image = 'http://demo.laravelmix.local:81/api/image/dish/' . $file->getClientOriginalName();
            $file->storeAs('public/dish', $file->getClientOriginalName());
        } else {
            $dish->image = 'http://demo.laravelmix.local:81/api/image/dish/default.png';
        }
        $dish->save();
        return response()->json($dish);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Dish::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DishRequest $request, $id)
    {
        $dish = Dish::find($id);
        $dish->type_id = $request->type_id;
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->description = $request->description;
        if ($request->hasFile('image')) {
            $tempImage = $dish->image;
            Storage::delete('public/dish/' . substr($tempImage, strrpos($tempImage, '/') + 1));
            $file = $request->image;
            $dish->image = 'http://demo.laravelmix.local:81/api/image/dish/' . $file->getClientOriginalName();
            $file->storeAs('public/dish', $file->getClientOriginalName());
        }
        $dish->save();
        return response()->json($dish);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $tempImage = $dish->image;
        Storage::delete('public/dish/' . substr($tempImage, strrpos($tempImage, '/') + 1));
        $dish->delete();
        return response()->json('ok');
    }
    public function setStatus()
    {
        DB::table('dishes')->update(array('is_serving' => 1, 'updated_at' => Carbon::now()));
        return response()->json("ok");
    }
}
