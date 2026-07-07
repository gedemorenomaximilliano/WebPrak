<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'required',
            'itinerary' => 'required',
            'is_popular' => 'nullable|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;

        $lines = array_filter(array_map('trim', explode("\n", $data['itinerary'])));
        $data['itinerary'] = json_encode(array_values($lines));
        $data['is_popular'] = $request->boolean('is_popular');
        Package::create($data);

        return redirect()->route('admin.packages.index')->with('status', 'Package created successfully!');
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required',
            'destination' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'required',
            'itinerary' => 'required',
            'is_popular' => 'nullable|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            if ($package->image && file_exists(public_path('images/' . $package->image))) {
                unlink(public_path('images/' . $package->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $lines = array_filter(array_map('trim', explode("\n", $data['itinerary'])));
        $data['itinerary'] = json_encode(array_values($lines));
        $data['is_popular'] = $request->boolean('is_popular');
        $package->update($data);

        return redirect()->route('admin.packages.index')->with('status', 'Package updated successfully!');
    }

    public function destroy(Package $package)
    {
        if ($package->image && file_exists(public_path('images/' . $package->image))) {
            unlink(public_path('images/' . $package->image));
        }
        $package->delete();
        return redirect()->route('admin.packages.index')->with('status', 'Package deleted successfully!');
    }
}
