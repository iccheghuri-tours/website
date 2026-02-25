<?php

namespace App\Http\Controllers;

use App\Models\RegularDeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegularDealController extends Controller
{
    //
    function index(){
        $deals = RegularDeal::orderBy('created_at', 'desc')->get();
        return Inertia::render('admin/Partners',[
            'data'=>$deals
        ]);
    }

    public function show(RegularDeal $partner){
        return Inertia::render('admin/details/Partner',[
            'data' => $partner,
            'mode' => 'edit'
        ]);
    }
    public function create(){
        return Inertia::render('admin/details/Partner',[
            'mode'=>'create'
        ]);
    }
    
    public function update(Request $request, RegularDeal $partner){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'phone' => 'required|string|size:11|unique:regular_deals,phone,'.$partner->id,
            'facebook' => 'required|url',
            'location' => 'required|url',
            'discount_percentage' => 'required|integer',
            'image' => 'required|string',
        ]);
        $partner->update($validated);

        return redirect()->route('admin.partners.index')
        ->with('message', 'Partner Updated successfully');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|string',
            'phone' => 'required|string|size:11|unique:regular_deals,phone',
            'facebook' => 'required|url',
            'location' => 'required|url',
            'discount_percentage' => 'required|integer',
            'image' => 'required|string',
        ]);
        RegularDeal::create($validated);

        return redirect()->route('admin.partners.index')
        ->with('message', 'Partner Created successfully');
    }
    public function destroy(RegularDeal $partner){
        $partner->delete();
        return redirect()->route('admin.partners.index')
        ->with('message', 'Partner deleted successfully');
    }

}
