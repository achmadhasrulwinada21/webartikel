<?php

namespace App\Modules\Branchoffice\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use DB;
use App\Modules\BranchOffice\Models\BranchOffice;
use App\Modules\Province\Models\Province;
use App\Modules\City\Models\City;
use App\Http\Controllers\Controller;
use Session;

class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAll(){
        $branch = BranchOffice::with('provinces', 'cities')->get();
                        
        return DataTables::of($branch)
                ->addColumn('action', function ($branch) {
                    $html = '<a href="/'.config('app.app_prefix').'/branchoffice/'.$branch->id.'/edit" class="btn btn-primary" >Edit</a> &nbsp <button id="btn-office" data-id="'. $branch->id .'" class="btn btn-danger">Delete</button>';
                    return $html;
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function index()
    {
        //
        return view('branchoffice::list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $provinces = Province::all();

        $data['provinces'] = $provinces;
        return view('branchoffice::create', $data);
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
        $validatedData = $request->validate([
            'province_id'          => 'required',
            'city_id'   => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'office_type' => 'required',
            'fax' => 'required'
        ]);

        if($validatedData) {
            $branch = new BranchOffice();
            $branch->province_id = $request->province_id;
            //dd($request->city_id);
            $branch->city_id = $request->city_id;
            $branch->address = $request->address;
            $branch->phone_number = $request->phone_number;
            $branch->office_type = $request->office_type;
            $branch->fax = $request->fax;
            $branch->head_office = $request->head_office;
            $branch->save();
            
        }

        Session::flash('sukses','Office has been inserted!');
        return redirect(config('app.app_prefix') . '/branchoffice');
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
        //
        $branch = BranchOffice::with(['provinces.cities', 'cities'])->first();
        //dd($branch->cities->city_name);
        $provinces = Province::all();
        $data['branch'] = $branch;
        $data['provinces'] = $provinces;
        return view('branchoffice::edit', $data);
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
        $validatedData = $request->validate([
            'province_id'          => 'required',
            'city_id'   => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'office_type' => 'required',
            'fax' => 'required'
        ]);

        if($validatedData) {
            $branch = BranchOffice::find($id);
            $branch->province_id = $request->province_id;
            //dd($request->city_id);
            $branch->city_id = $request->city_id;
            $branch->address = $request->address;
            $branch->phone_number = $request->phone_number;
            $branch->office_type = $request->office_type;
            $branch->fax = $request->fax;
            $branch->head_office = $request->head_office;
            $branch->save();
            
        }

        Session::flash('sukses','Office has been inserted!');
        return redirect(config('app.app_prefix') . '/branchoffice');
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
        $branch = BranchOffice::destroy($id);

        $data = [
            "status" => 200,
            "message" => "Successfully Delete Office"
        ];

        return json_encode($data);
    }
}
