<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Selected;

class AssignmentController extends Controller
{
   	public function index()
	{
	   $items = Assignment::orderBy('created_at', 'desc')->get();
	   $selectedItems = Selected::orderBy('created_at', 'desc')->get();
	   return view('assignment', compact('items','selectedItems'));
	}

    public function store(Request $request)
    {   
        $data = $request->all();
        $result = Assignment::insert($data);
        if($result){

        	$arr = array('msg' => 'Added Successfully!', 'status' => true);
        }else{
        	$arr = array('msg' => 'Not Added!', 'status' => false);
        }
        return Response()->json($arr);
    }

    public function rightSelected(Request $request)
    {
    	$arr = array();
    	$insert = Selected::insert(['selected'=>$request->items]);
    	$delete = Assignment::where('assignment',$request->items)->delete();
    	if($insert){
			$arr = array('msg' => 'Added Successfully!', 'status' => true);
		}
    	return Response()->json($arr);
    }

	public function leftSelected(Request $request)
	{
		$arr = array();
		$insert = Assignment::insert(['assignment'=>$request->items]);
		$delete = Selected::where('selected',$request->items)->delete();
		if($insert){
			$arr = array('msg' => 'Added Successfully!', 'status' => true);
		}
		return Response()->json($arr);
	}


}
