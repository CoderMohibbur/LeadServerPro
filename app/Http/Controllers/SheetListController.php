<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SheetList;
use Illuminate\Http\Request;

class SheetListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sheetLists = SheetList::with('client')->get(); // Fetch all sheet lists with their associated clients
        return view('sheetlist.index', compact('sheetLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('sheetlist.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|string|max:255',
            'sheet_working_date' => 'required|date',
            'sheet_name' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:clients,id',
        ]);

        SheetList::create($request->all());

        return redirect()->route('sheet-lists.index')->with('success', 'Sheet List created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SheetList $sheetList)
    {
        return view('sheet_lists.show', compact('sheetList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SheetList $sheetList)
    {
        return view('sheet_lists.edit', compact('sheetList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SheetList $sheetList)
    {
        $request->validate([
            'file' => 'required|string|max:255',
            'sheet_working_date' => 'required|date',
            'sheet_name' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:clients,id',
        ]);

        $sheetList->update($request->all());

        return redirect()->route('sheet-lists.index')->with('success', 'Sheet List updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SheetList $sheetList)
    {
        $sheetList->delete();

        return redirect()->route('sheet-lists.index')->with('success', 'Sheet List deleted successfully!');
    }
}
