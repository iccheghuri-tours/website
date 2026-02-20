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

    public function show(RegularDeal $deal){
        return Inertia::render('admin/details/Partners',[
            'data' => $deal
        ]);
    }
    
    public function update(Request $request, RegularDeal $deal){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'phone' => 'required|string',
            'facebook' => 'required|url',
            'location' => 'required|url',
            'discount_percentage' => 'required|integer',
        ]);
        $deal->update($validated);

        return redirect()->route('admin.partners.index')
        ->with('message', 'Deal Updated successfully');
    }
    public function destroy(RegularDeal $deal){
        $deal->delete();
        return redirect()->route('admin.partners.index')
        ->with('message', 'Deal deleted successfully');
    }

}
