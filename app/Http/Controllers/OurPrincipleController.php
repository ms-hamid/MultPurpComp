<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrincipleRequest;
use App\Http\Requests\UpdatePrincipleRequest;
use App\Models\OurPrinciple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OurPrincipleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $principles = OurPrinciple::orderByDesc('id')->paginate(10);
        return view('admin.principles.index', compact('principles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.principles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrincipleRequest $request)
    {
        // Insert to the database in a specific table (our_principles)
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }
            
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newPrinciple = OurPrinciple::create($validated);
        });

        return redirect()->route('admin.principles.index')->with('success', 'Principle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OurPrinciple $ourPrinciple)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OurPrinciple $principle)
    {
        return view('admin.principles.edit', compact('principle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrincipleRequest $request, OurPrinciple $principle)
    {
        // Insert to the database in a specific table (our_principles)
        DB::transaction(function () use ($request, $principle) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }
            
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $principle->update($validated);
        });

        return redirect()->route('admin.principles.index')->with('success', 'Principle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OurPrinciple $principle)
    {
        //
        DB::transaction(function () use ($principle) {
            $principle->delete();
        });
        return redirect()->route('admin.principles.index')->with('success', 'Principle deleted successfully.');
    }
}
