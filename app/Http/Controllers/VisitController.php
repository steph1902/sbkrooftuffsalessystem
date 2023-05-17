<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Visit;

class VisitController extends Controller
{
    //
    public function create($id)
    {
        $shop = Shop::findOrFail($id);
        return view('visits.create', compact('shop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'location' => 'required',
            'notes' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Store the visit data
        $visit = new Visit();
        $visit->shop_id = $request->input('shop_id');
        $visit->location = $request->input('location');
        $visit->notes = $request->input('notes');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('visit-photos', 'public');
            $visit->photo = $photoPath;
        }

        $visit->save();

        return redirect()->route('shop.details', $visit->shop_id)->with('success', 'Visit recorded successfully.');
    }
}




