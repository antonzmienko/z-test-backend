<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenderRequest;
use App\Http\Requests\UpdateTenderRequest;
use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name = '', $date = '')
    {
        return response()->json(Tender::all());
    }
	
	/**
     * Display a listing of the resource with query params.
     *
     * @return \Illuminate\Http\Response
     */	 
	 
	public function list(Request $request)
    {	
		$query = Tender::query();
		
		if(isset($request->name))
		{
			$query->where('name', 'like',  "%{$request->name}%");				
		}
		
		if(isset($request->date))
		{
			$query->where('update_date', date('Y-m-d H:i:s' , strtotime($request->date)));			
		}
		
		return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTenderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenderRequest $request)
    {
        $tender = new Tender;
		$tender->outer_code = $request->outer_code;
		$tender->number = $request->number;
		$tender->status = $request->status;
		$tender->name = $request->name;
		$tender->update_date = date('Y-m-d H:i:s' , strtotime($request->update_date));
		$tender->save();
		
		return response()->json($tender->attributesToArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        return response()->json($tender->attributesToArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTenderRequest  $request
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTenderRequest $request, Tender $tender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        //
    }
}
