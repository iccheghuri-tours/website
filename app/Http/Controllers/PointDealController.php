<?php

namespace App\Http\Controllers;

use App\Models\PointDeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PointDealController extends Controller
{
    //
    function index(){
        $deals = PointDeal::orderBy('created_at', 'desc')->get();
        return Inertia::render('admin/Offers',[
            'data'=>$deals,
        ]);
    }

    public function show(PointDeal $offer){
        return Inertia::render('admin/details/Offer',[
            'data' => $offer,
            'mode' => 'edit'
        ]);
    }
    public function create(){
        return Inertia::render('admin/details/Offer',[
            'mode' => 'create'
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'points_required' => 'required|integer',
        ]);
        PointDeal::create($validated);

        return redirect()->route('admin.offers.index')
        ->with('message', 'Offer Created successfully');
    }
    
    public function update(Request $request, PointDeal $offer){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'points_required' => 'required|integer',
        ]);
        $offer->update($validated);

        return redirect()->route('admin.offers.index')
        ->with('message', 'Offer Updated successfully');
    }
    public function destroy(PointDeal $offer){
        $offer->delete();
        return redirect()->route('admin.offers.index')
        ->with('message', 'Offer deleted successfully');
    }
}
