<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;

class UnitController extends Controller
{
    public function UnitAll(){
    	// $supplier = supplier::all();
    	$units = Unit::latest()->get();
    	return view('backend.unit.unit_all',compact('units'));
    } //END METHOD

    public function UnitAdd(){
    	return view('backend.unit.unit_add');
    } //END METHOD

	
	public function UnitStore(Request $request){
    	Unit::insert([
    		'name' => $request->name,
    		'created_by' => Auth::user()->id,
    		'created_at' => Carbon::now(),
    	]);

    	$notification = array(
        	'message' => 'Unit Inserted Successfully',
        	'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }//END METHOD

    public function UnitEdit($id){
    	$unit = Unit::findOrFail($id);
    	return view('backend.unit.unit_edit',compact('unit'));
    }//END METHOD

    public function UnitUpdate(Request $request){
    	$unit_id = $request->id;

    	Unit::findOrFail($unit_id)->update([
    		'name' => $request->name,
    		'created_by' => Auth::user()->id,
    		'created_at' => Carbon::now(),
    	]);

    	$notification = array(
        	'message' => 'Unit Updated Successfully',
        	'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }//END METHOD

    public function UnitDelete($id){
    	Unit::findOrFail($id)->delete();

    	$notification = array(
        	'message' => 'unit Delete Successfully',
        	'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//END METHOD

}