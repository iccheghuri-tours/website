<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ImageController extends Controller
{
    //
    function store(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
            'delete' => 'nullable|string', // deleting previous file
        ]);
        if ($request->delete) {
        Storage::disk('public')->delete($request->delete);
    }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            return response()->json([
                'message' => 'Image uploaded successfully',
                'path' => $path
            ]);
        }
        return response()->json([
        'message' => 'No image uploaded'
    ], 400);
    }
}
