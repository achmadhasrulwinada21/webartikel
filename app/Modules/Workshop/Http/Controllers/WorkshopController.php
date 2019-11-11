<?php

namespace App\Modules\Workshop\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Workshop\Models\Workshop;

class WorkshopController extends Controller
{

    public function listAll() {
        $workshop = Workshop::all();
        
        return Datatables::of($workshop)
            ->addColumn('action', function ($workshop) {
                $html = '<a href="/'.config('app.app_prefix').'/workshop/'.$workshop->id.'/edit" class="btn btn-primary" >Edit</a> &nbsp <button id="deleteRole" data-id="'. $workshop->id .'" class="btn btn-danger">Delete</button>';
                return $html;
           })
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("workshop::list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("workshop::create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|min:6',
            'phone'         => 'required|min:6',
            'address'       => 'required|min:6',
        ]);

        if($validatedData) {
            $workshop                   = new Workshop();
            $workshop->name             = $request->name;
            $workshop->phone            = $request->phone;
            $workshop->address          = $request->address;
            $workshop->fax              = $request->fax;
            $workshop->email            = $request->email;
            $workshop->city             = $request->city;
            $workshop->province         = $request->province;
            $workshop->save();
        }

        return redirect(config('app.app_prefix') . '/workshop');
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
        $workshop = Workshop::find($id);
        $data['workshop'] = $workshop;

        return view("workshop::edit",$data);
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
        $validatedData = $request->validate([
            'name'          => 'required|min:6',
            'phone'         => 'required|min:6',
            'address'       => 'required|min:6',
        ]);

        if($validatedData) {
            $workshop                   = Workshop::find($id);
            $workshop->name             = $request->name;
            $workshop->phone            = $request->phone;
            $workshop->address          = $request->address;
            $workshop->fax              = $request->fax;
            $workshop->email            = $request->email;
            $workshop->city             = $request->city;
            $workshop->province         = $request->province;
            $workshop->save();
        }

        return redirect(config('app.app_prefix') . '/workshop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workshop = Workshop::destroy($id);

        $data = [
            "status" => 200,
            "message" => "Successfully Delete Workshop"
        ];

        return json_encode($data);
    }
}
