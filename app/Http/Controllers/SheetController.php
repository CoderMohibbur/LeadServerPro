<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sheet;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SheetController extends Controller
{
    public function create()
    {
        // Fetch users for the dropdown
        $users = User::all();
        return view('sheets.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'file' => 'required|mimes:pdf,docx,xlsx,csv', // Ensure valid file type
            'sheet_name' => 'required|string|max:255',
            'sheet_working_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('sheets', 'public');
        }

        // Store the sheet details in the database
        $sheet = new Sheet();
        $sheet->file = $filePath;
        $sheet->sheet_name = $request->sheet_name;
        $sheet->sheet_working_date = $request->sheet_working_date;
        $sheet->user_id = $request->user_id;
        $sheet->save();

        return redirect()->route('sheets.index')->with('success', 'Sheet created successfully!');
    }

    public function index()
    {
        // Retrieve all sheets and display them
        $sheets = Sheet::all();
        return view('sheets.index', compact('sheets'));
    }

    public function show(Sheet $sheet)
    {
        // Get file content for links
        $fileContent = null;
        if ($sheet->file) {
            $filePath = storage_path('app/public/' . $sheet->file); // Full path to the file
            if (file_exists($filePath)) {
                $fileContent = file_get_contents($filePath);  // Read the file content
            }
        }

        return view('sheets.show', compact('sheet', 'fileContent'));
    }

    public function destroy(Sheet $sheet)
    {
        // Check if the file exists and delete it from storage if necessary
        if ($sheet->file) {
            Storage::delete($sheet->file);
        }

        // Delete the sheet record from the database
        $sheet->delete();

        // Redirect back to the sheets list with a success message
        return redirect()->route('sheets.index')->with('success', 'Sheet deleted successfully.');
    }
    public function edit(Sheet $sheet)
    {
        // Fetch all users and pass them to the view
        $users = User::all(); // Get all users

        // Pass the sheet and users to the edit view
        return view('sheets.edit', compact('sheet', 'users'));
    }


}
