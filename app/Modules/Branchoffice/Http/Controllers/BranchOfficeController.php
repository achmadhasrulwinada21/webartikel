<?php

namespace App\Modules\Branchoffice\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use DB;
use App\Modules\BranchOffice\Models\BranchOffice;
use App\Modules\Province\Models\Province;
use App\Modules\City\Models\City;
use App\Http\Controllers\Controller;

class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAll(){
        $queryBranch = DB::table('branch_office')
                        ->select(DB::raw('*'))
                        ->Join('province', 'province.id', '=', 'branch_office.province_id')
                        ->Join('city', 'city.id', '=', 'branch_office.city_id')
                        ->get();
        return DataTables::of($queryBranch)
                ->addColumn('action', function ($queryBranch) {
                    $html = '<a href="/'.config('app.app_prefix').'/branchoffice/'.$role->id.'/edit" class="btn btn-primary" >Edit</a> &nbsp <button id="" data-id="'. $role->id .'" class="btn btn-danger">Delete</button>';
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
        //
    }
}
