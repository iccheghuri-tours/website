<?php

namespace App\Http\Controllers;

use App\Models\PointDeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PointDealController extends Controller
{
    //
    function index(){
        $deals = PointDeal::all();
        return Inertia::render('admin/Offers',[
            'data'=>$deals
        ]);
    }

    public function show(PointDeal $deal){
        return Inertia::render('admin/details/PointDeal',[
            'data' => $deal
        ]);
    }
    
    public function update(Request $request, PointDeal $deal){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'point_required' => 'required|integer',
        ]);
        $deal->update($validated);

        return redirect()->route('admin.offers.index')
        ->with('message', 'Deal Updated successfully');
    }
    public function destroy(PointDeal $deal){
        $deal->delete();
        return redirect()->route('admin.offers.index')
        ->with('message', 'Deal deleted successfully');
    }
}
