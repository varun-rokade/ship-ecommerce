<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;



class ShippingAreaController extends Controller
{
    public function divisionarea()
    {
        $division = ShipDivision::orderby('id','DESC')->get();
        return view('backend.ship.division.view_division',compact('division'));
    }

    public function storedivision(Request $request)
    {
        ShipDivision::insert([
            'division_name' =>$request->division_name,
            'created_at'=>Carbon::now(),
        ]);
    
        $notification = array( 
            'message' => 'Division Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    
    }

    public function editdivision($id)
    {
        $div = ShipDivision::findorfail($id);
        return view('backend.ship.division.edit_division',compact('div'));
    }


    public function updatedivision(Request $request)
    {
        $divi = $request->id;

        ShipDivision::findorfail($divi)->update([
            'division_name'=>$request->division_name,
        ]);
   
        $notification = array( 
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.division')->with($notification);
    }

    public function deletedivision($id)
    {
        ShipDivision::findorfail($id)->delete();
    
        $notification = array( 
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.division')->with($notification);
    
    }

    public function districtarea()
    {
        $division = ShipDivision::orderby('division_name','ASC')->get();
        $district = ShipDistrict::with('division')->orderby('id','DESC')->get();
        return view('backend.ship.district.view_district',compact('district','division'));
    }

    public function storedistrict(Request $request)
    {
        ShipDistrict::insert([
            'district_name' =>$request->district_name,
            'division_id' =>$request->division_id,
            'created_at'=>Carbon::now(),
]);
    
        $notification = array( 
            'message' => 'District Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function editdistrict($id)
    {
        $division = ShipDivision::orderby('division_name','ASC')->get();
        $dis = ShipDistrict::findorfail($id);
        return view('backend.ship.district.edit_district',compact('dis','division'));
    }

    public function updatedistrict(Request $request,$id)
    {
        $divi = $request->id;

        ShipDistrict::findorfail($divi)->update([
            'division_id'=>$request->division_id,
            'district_name'=>$request->district_name, 
            'created_at'=>Carbon::now(),
        ]);
   
        $notification = array( 
            'message' => 'District Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.district')->with($notification);
    }

    public function deletedistrict($id)
    {
        ShipDistrict::findorfail($id)->delete();
    
        $notification = array( 
            'message' => 'District Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.district')->with($notification);
    
    }

    public function statearea()
    {
        $division = ShipDivision::orderby('division_name','ASC')->get();
        $district = ShipDistrict::with('division')->orderby('id','DESC')->get();
        $state = ShipState::with('division','district')->orderby('id','DESC')->get();
        return view('backend.ship.state.view_state',compact('district','division','state'));
    }

    public function storestate(Request $request)
    {
        ShipState::insert([
            'district_id' =>$request->district_id,
            'division_id' =>$request->division_id,
            'state_name' =>$request->state_name,
            'created_at'=>Carbon::now(),
    ]);
    
        $notification = array( 
            'message' => 'State Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function stateedit($id)
    {
        $division = ShipDivision::orderby('division_name','ASC')->get();
        $dis = ShipDistrict::orderby('district_name','ASC')->get();
        $state = ShipState::findorfail($id);  
        return view('backend.ship.state.edit_state',compact('dis','division','state'));
    }
    public function updatestate(Request $request,$id)
    {
        $id = $request->id;

        ShipState::findorfail($id)->update([

            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,

        ]);

        $notification = array( 
            'message' => 'State Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.state')->with($notification);

    }

    public function deletestate($id)
    {
        
        ShipState::findorfail($id)->delete();
        $notification = array( 
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.state')->with($notification);
    }


}
