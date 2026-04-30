<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('welcome', compact('packages'));
    }

    public function packages(Request $request)
    {
        $query = Package::query();

        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }

        if ($request->filled('date')) {
            $query->where('start_date', '<=', $request->date)
                  ->where('end_date', '>=', $request->date);
        }

        $packages = $query->get();
        return view('packages.index', compact('packages'));
    }

    public function showPackage(Package $package)
    {
        return view('packages.show', compact('package'));
    }
}
