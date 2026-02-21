<?php

namespace App\Http\Controllers;

use App\Models\RegularDeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegularDealController extends Controller
{
    //
    function index(){
        $deals = RegularDeal::all();
        return Inertia::render('admin/Partners',[
            'data'=>$deals
        ]);
    }

    public function show(RegularDeal $partner){
        return Inertia::render('admin/details/Partner',[
            'data' => $partner
        ]);
    }
    
    public function update(Request $request, RegularDeal $partner){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'phone' => 'required|string',
            'facebook' => 'required|url',
            'location' => 'required|url',
            'discount_percentage' => 'required|integer',
        ]);
        $partner->update($validated);

        return redirect()->route('admin.partners.index')
        ->with('message', 'Partner Updated successfully');
    }
    public function destroy(RegularDeal $partner){
        $partner->delete();
        return redirect()->route('admin.partners.index')
        ->with('message', 'Partner deleted successfully');
    }

}
