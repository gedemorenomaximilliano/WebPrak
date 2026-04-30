<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'destination' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'description' => 'required',
            'itinerary' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $data['itinerary'] = json_decode($data['itinerary'], true);
        Package::create($data);

        return redirect()->route('admin.packages.index')->with('status', 'Package created successfully!');
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required',
            'destination' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'description' => 'required',
            'itinerary' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $data['itinerary'] = json_decode($data['itinerary'], true);
        $package->update($data);

        return redirect()->route('admin.packages.index')->with('status', 'Package updated successfully!');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('status', 'Package deleted successfully!');
    }
}
