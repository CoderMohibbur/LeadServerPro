<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Sheet;
use App\Models\Client;
use League\Csv\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SheetController extends Controller
{
    public function leadsBySheet(Request $request, $sheetId)
    {
        // Check if the authenticated user has the 'admin' role
        if ($request->user()->hasRole('admin')) {
            // Code for 'admin' role
            $users = User::all();
            $sheet = Sheet::findOrFail($sheetId); // Find the sheet or return 404
            return view('leadServer.index2', compact('sheet', 'users'));
        } elseif ($request->user()->hasRole('user')) {
            // Code for 'user' role
            $users = User::all();
            $sheet = Sheet::findOrFail($sheetId); // Find the sheet or return 404
            return view('leadServer.userindex2', compact('sheet', 'users'));
        } else {
            // Code for other roles or unauthorized access
            return response()->json(['message' => 'Access Denied.'], 403);
        }
    }

    public function leadsByUser($userId)
    {
        $users = User::all();
        $user = User::findOrFail($userId); // Retrieve the user or throw 404
        return view('leadServer.index2', compact('user', 'users')); // Pass user to the view
    }


    public function create()
    {
        // Fetch users for the dropdown
        $users = User::all();
        return view('sheets.create', compact('users'));
    }

    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'file' => 'required|mimes:pdf,docx,xlsx,csv', // Ensure valid file type
    //         'sheet_name' => 'required|string|max:255',
    //         'sheet_working_date' => 'required|date',
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     // Handle the file upload
    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('sheets', 'public');
    //     }

    //     // Store the sheet details in the database
    //     $sheet = new Sheet();
    //     $sheet->file = $filePath;
    //     $sheet->sheet_name = $request->sheet_name;
    //     $sheet->sheet_working_date = $request->sheet_working_date;
    //     $sheet->user_id = $request->user_id;
    //     $sheet->save();

    //     return redirect()->route('sheets.index')->with('success', 'Sheet created successfully!');
    // }



    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'file' => 'required',
    //         'sheet_name' => 'required|string|max:255',
    //         'sheet_working_date' => 'required|date',
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     $filePath = null;

    //     // Handle the file upload
    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('sheets', 'public');
    //     }

    //     // Store the sheet details in the database
    //     $sheet = new Sheet();
    //     $sheet->file = $filePath;
    //     $sheet->sheet_name = $request->sheet_name;
    //     $sheet->sheet_working_date = $request->sheet_working_date;
    //     $sheet->user_id = $request->user_id;
    //     $sheet->save();

    //     // If the file is a CSV, process its content
    //     if ($request->file('file')->getClientOriginalExtension() === 'csv') {
    //         // Get the full file path
    //         $fullPath = Storage::disk('public')->path($filePath);

    //         // Read the CSV file
    //         $csv = Reader::createFromPath($fullPath, 'r');
    //         $csv->setHeaderOffset(0); // Assuming the CSV has a header row

    //         $data = []; // Initialize an empty array to hold the rows

    //         foreach ($csv->getRecords() as $record) {
    //             // Skip rows with duplicate emails
    //             if (!empty($record['email']) && DB::table('leads')->where('email', $record['email'])->exists()) {
    //                 continue; // Skip this record
    //             }
    //             // Map the CSV record to the `leads` table fields
    //             $data[] = [
    //                 'linkedin_link' => $record['linkedin_link'] ?? null,
    //                 'company_name' => $record['company_name'] ?? null,
    //                 'contact_name' => $record['contact_name'] ?? null,
    //                 'name_prefix' => $record['name_prefix'] ?? null,
    //                 'full_name' => $record['full_name'] ?? null,
    //                 'first_name' => $record['first_name'] ?? null,
    //                 'last_name' => $record['last_name'] ?? null,
    //                 'email' => $record['email'] ?? null,
    //                 'title_position' => $record['title_position'] ?? null,
    //                 'person_location' => $record['person_location'] ?? null,
    //                 'full_address' => $record['full_address'] ?? null,
    //                 'company_phone' => $record['company_phone'] ?? null,
    //                 'company_head_count' => $record['company_head_count'] ?? null,
    //                 'country' => $record['country'] ?? null,
    //                 'city' => $record['city'] ?? null,
    //                 'state' => $record['state'] ?? null,
    //                 'tag' => $record['tag'] ?? null,
    //                 'source_link' => $record['source_link'] ?? null,
    //                 'middle_name' => $record['middle_name'] ?? null,
    //                 'sur_name' => $record['sur_name'] ?? null,
    //                 'gender' => $record['gender'] ?? null,
    //                 'personal_phone' => $record['personal_phone'] ?? null,
    //                 'employee_range' => $record['employee_range'] ?? null,
    //                 'company_website' => $record['company_website'] ?? null,
    //                 // 'company_description' => $record['company_description'] ?? null,
    //                 'company_linkedin_link' => $record['company_linkedin_link'] ?? null,
    //                 'company_hq_address' => $record['company_hq_address'] ?? null,
    //                 'industry' => $record['industry'] ?? null,
    //                 'revenue' => $record['revenue'] ?? null,
    //                 'street' => $record['street'] ?? null,
    //                 'zip_code' => $record['zip_code'] ?? null,
    //                 'rating' => $record['rating'] ?? null,
    //                 'sheet_name' => $record['sheet_name'] ?? null,
    //                 'job_link' => $record['job_link'] ?? null,
    //                 'job_role' => $record['job_role'] ?? null,
    //                 'checked_by' => $record['checked_by'] ?? null,
    //                 'review' => $record['review'] ?? null,
    //                 'sheets_id' => $sheet->id, // Link to the sheet entry
    //                 'created_at' => now(), // Add current timestamp
    //                 'updated_at' => now(), // Add current timestamp
    //             ];

    //             // Batch insert when the array reaches a chunk size of 1000
    //             if (count($data) === 1000) {
    //                 DB::table('leads')->insert($data);
    //                 $data = []; // Clear the array after insertion
    //             }
    //         }

    //         // Insert any remaining rows
    //         if (!empty($data)) {
    //             DB::table('leads')->insert($data);
    //         }
    //     }

    //     return redirect()->route('sheets.index')->with('success', 'Sheet created and CSV data processed successfully!');
    // }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'file' => 'required',
            'sheet_name' => 'required|string|max:255',
            'sheet_working_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $filePath = null;

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

        // Initialize counters
        $totalRows = 0; // Tracks the total rows in the CSV
        $skippedRows = 0; // Tracks skipped rows due to duplicate emails

        // If the file is a CSV, process its content
        if ($request->file('file')->getClientOriginalExtension() === 'csv') {
            // Get the full file path
            $fullPath = Storage::disk('public')->path($filePath);

            // Read the CSV file
            $csv = Reader::createFromPath($fullPath, 'r');
            $csv->setHeaderOffset(0); // Assuming the CSV has a header row

            $data = []; // Initialize an empty array to hold the rows

            // Fetch existing emails to avoid duplicates
            $existingEmails = DB::table('leads')->pluck('email')->toArray();

            foreach ($csv->getRecords() as $record) {
                $totalRows++; // Increment the total rows counter

                // Skip rows with duplicate emails
                if (!empty($record['email']) && in_array($record['email'], $existingEmails)) {
                    $skippedRows++; // Increment skipped rows counter
                    continue; // Skip this record
                }

                $data[] = [
                    'linkedin_link' => $record['linkedin_link'] ?? null,
                    'company_name' => $record['company_name'] ?? null,
                    'contact_name' => $record['contact_name'] ?? null,
                    'name_prefix' => $record['name_prefix'] ?? null,
                    'full_name' => $record['full_name'] ?? null,
                    'first_name' => $record['first_name'] ?? null,
                    'last_name' => $record['last_name'] ?? null,
                    'email' => $record['email'] ?? null,
                    'title_position' => $record['title_position'] ?? null,
                    'person_location' => $record['person_location'] ?? null,
                    'full_address' => $record['full_address'] ?? null,
                    'company_phone' => $record['company_phone'] ?? null,
                    'company_head_count' => $record['company_head_count'] ?? null,
                    'country' => $record['country'] ?? null,
                    'city' => $record['city'] ?? null,
                    'state' => $record['state'] ?? null,
                    'tag' => $record['tag'] ?? null,
                    'source_link' => $record['source_link'] ?? null,
                    'middle_name' => $record['middle_name'] ?? null,
                    'sur_name' => $record['sur_name'] ?? null,
                    'gender' => $record['gender'] ?? null,
                    'personal_phone' => $record['personal_phone'] ?? null,
                    'employee_range' => $record['employee_range'] ?? null,
                    'company_website' => $record['company_website'] ?? null,
                    // 'company_description' => $record['company_description'] ?? null,
                    'company_linkedin_link' => $record['company_linkedin_link'] ?? null,
                    'company_hq_address' => $record['company_hq_address'] ?? null,
                    'industry' => $record['industry'] ?? null,
                    'revenue' => $record['revenue'] ?? null,
                    'street' => $record['street'] ?? null,
                    'zip_code' => $record['zip_code'] ?? null,
                    'rating' => $record['rating'] ?? null,
                    'sheet_name' => $record['sheet_name'] ?? null,
                    'job_link' => $record['job_link'] ?? null,
                    'job_role' => $record['job_role'] ?? null,
                    'checked_by' => $record['checked_by'] ?? null,
                    'review' => $record['review'] ?? null,
                    'sheets_id' => $sheet->id, // Link to the sheet entry
                    'created_at' => now(), // Add current timestamp
                    'updated_at' => now(), // Add current timestamp
                ];

                // Batch insert when the array reaches a chunk size of 1000
                if (count($data) === 1000) {
                    DB::table('leads')->insert($data);
                    $data = []; // Clear the array after insertion
                }
            }

            // Insert any remaining rows
            if (!empty($data)) {
                DB::table('leads')->insert($data);
            }
        }

        // Redirect back with a success message, showing the total and skipped rows
        return redirect()->route('sheets.index')->with('success', "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.");
    }

    public function index()
    {
        // Retrieve all sheets and display them
        $sheets = Sheet::all();
        $users = User::all();

        return view('sheets.index', compact('sheets', 'users'));
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

    public function leadServerLink(Sheet $sheet)
    {
        $leadServerUrl = "https://your-lead-server.com/sheets/{$sheet->id}"; // লিড সার্ভার লিঙ্ক
        return redirect()->away($leadServerUrl); // ব্যবহারকারীকে লিড সার্ভার লিঙ্কে রিডাইরেক্ট করে
    }

    public function userindex()
    {
        $user = Auth::user();
        // Non-admin users see only their associated sheets and users
        $sheets = Sheet::where('user_id', $user->id)->get(); // Assuming 'user_id' is the column linking sheets to users
        $users = User::where('id', $user->id)->get(); // Only the logged-in user's record

        // Pass the data and admin flag to the view
        return view('sheets.index', compact('sheets', 'users'));
    }

    public function mytest(Request $request)
    {
        // Check if the authenticated user has the 'admin' role
        if ($request->user()->hasRole('admin')) {
            // Code for 'admin' role
            return response()->json(['message' => 'Welcome, Admin!']);
        } elseif ($request->user()->hasRole('user')) {
            // Code for 'user' role
            return response()->json(['message' => 'Welcome, User!']);
        } else {
            // Code for other roles or unauthorized access
            return response()->json(['message' => 'Access Denied.'], 403);
        }
    }
}
