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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;



class SheetController extends Controller
{
    public function leadsBySheet(Request $request, $sheetId)
    {
        // Check if the authenticated user has the 'admin' role
        if ($request->user()->hasRole('admin')) {
            // Code for 'admin' role
            $leadcount = Lead::count();

            $users = User::all();
            $sheet = Sheet::findOrFail($sheetId); // Find the sheet or return 404
            return view('leadServer.index2', compact('sheet', 'users', 'leadcount'));
        } elseif ($request->user()->hasRole('user')) {
            // Code for 'user' role
            $users = User::all();
            $leadcount = Lead::count();

            $sheet = Sheet::findOrFail($sheetId); // Find the sheet or return 404
            return view('leadServer.userindex2', compact('sheet', 'users', 'leadcount'));
        } else {
            // Code for other roles or unauthorized access
            return response()->json(['message' => 'Access Denied.'], 403);
        }
    }

    public function leadsByUser($userId)
    {
        $leadcount = Lead::count();
        $users = User::all();
        $user = User::findOrFail($userId); // Retrieve the user or throw 404

        return view('leadServer.index2', compact('user', 'users', 'leadcount')); // Pass user to the view
    }

    public function create()
    {
        // Fetch users for the dropdown
        $users = User::all();
        return view('sheets.create', compact('users'));
    }

public function store(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,txt',
        'sheet_name' => 'required|string|max:255',
        'sheet_working_date' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('sheets', 'public');
    }

    $sheet = new Sheet();
    $sheet->file = $filePath;
    $sheet->sheet_name = $request->sheet_name;
    $sheet->sheet_working_date = $request->sheet_working_date;
    $sheet->user_id = $request->user_id;
    $sheet->save();

    $totalRows = 0;
    $skippedRows = 0;

    if ($request->file('file')->getClientOriginalExtension() === 'csv') {
        $fullPath = Storage::disk('public')->path($filePath);
        $csv = Reader::createFromPath($fullPath, 'r');
        $csv->setHeaderOffset(0);

        // Fetch database columns dynamically
        $dbColumns = Schema::getColumnListing('leads'); // Replace 'leads' with your table name
        $dbColumns = array_map('strtolower', $dbColumns);

        $headerMap = [
            'linkedin_link' => ['linkedin link', 'linkedin', 'personal linkedin', 'linkedin_link', 'LinkedIn Link'],
            'company_name' => ['company', 'company name', 'company_name'],
            'contact_name' => ['Contact Name', 'fullName', 'FullName', 'Fullname', 'full name', 'contact_name'],
            'name_prefix' => ['namePrefix', 'name_prefix'],
            'full_name' => ['Contact Name', 'fullName', 'FullName', 'Fullname', 'full name', 'full_name'],
            'first_name' => ['first name', 'fname', 'firstName', 'first_name'],
            'last_name' => ['last name', 'lname', 'lastName'],
            'email' => ['email address', 'email', 'Email Address', 'emailAddress', 'Buisness Email', 'buisness email','Business Email'],
            'phone' => ['phone number', 'phone', 'contact phone'],
            'title_position' => ['Title', 'titlePosition'],
            'person_location' => ['personalLocation', 'location', 'personal location','personal address'],
            'full_address' => ['fullAddress', 'Address '],
            'company_phone' => ['companyphone', 'Phone Number'],
            'company_head_count' => ['Number of Employees', '# of Employees', 'Head Count', 'companyHeadCount', '#of Employees', 'company_head_count','#of_employee', '#_of_employee'],
            'country' => ['country'],
            'city' => ['city'],
            'state' => ['state'],
            'tag' => ['tag'],
            'source_link' => ['sourceLink', 'source_link'],
            'middle_name' => ['middleName', 'middle_name'],
            'sur_name' => ['sureName', 'sur_name'],
            'gender' => ['gender'],
            'personal_phone' => ['personalPhone', 'personal_phone', 'phone'],
            'employee_range' => ['employeeRange', 'employee_range'],
            'company_website' => ['Company Website', 'Website', 'Web Link', 'WebLink ', 'companyWebsite', 'company_website'],
            'company_linkedin_link' => ['companyLinkedinLink','company_linkedin','company linkedin', 'company_linkedin_link'],
            'company_hq_address' => ['company hq address', 'hq address', 'company hq', 'company_hq', 'company address', 'company_hq_address', 'job_location'],
            'industry' => ['industry', 'Industry'],
            'revenue' => ['revenue'],
            'street' => ['street'],
            'zip_code' => ['zip', 'zip code','zipcode', 'zip_code'],
            'rating' => ['rating'],
            'sheet_name' => ['sheet_name'],
            'job_link' => ['joblink', 'JobLink', 'job_link', 'Job Posting Source Link'],
            'job_role' => ['Job Role', 'Job Vacancy', 'job_role'],
            'checked_by' => ['checkedby', 'checked by', 'checked_by'],
            'review' => ['review','review_by']
        ];

        $headers = $csv->getHeader();
        $normalizedHeaders = [];
        $excludedHeaders = []; // Track excluded headers

        foreach ($headers as $header) {
            $normalized = strtolower(str_replace([' ', '-', '.'], '_', trim($header)));

            $mappedHeader = null;

            // Match normalized headers with aliases in the headerMap
            foreach ($headerMap as $key => $aliases) {
                if (in_array($header, $aliases, true) || in_array($normalized, $aliases, true)) {
                    $mappedHeader = $key;
                    break;
                }
            }

            // Use the normalized header as a fallback if no mapping is found
            $normalizedHeader = $mappedHeader ?: $normalized;

            // Check if the header exists in the database schema
            if (in_array($normalizedHeader, $dbColumns)) {
                $normalizedHeaders[] = $normalizedHeader;
            } else {
                $excludedHeaders[] = $header;
            }
        }

        $existingEmails = DB::table('leads')->pluck('email')->toArray();
        $data = [];

        foreach ($csv->getRecords() as $record) {
            $totalRows++;

            // Skip rows with duplicate emails
            if (!empty($record['email']) && in_array($record['email'], $existingEmails)) {
                $skippedRows++;
                continue;
            }

            $mappedRecord = [];
            foreach ($normalizedHeaders as $index => $dbColumn) {
                $value = $record[$headers[$index]] ?? null; // Use the original header for indexing
                $mappedRecord[$dbColumn] = $value;
            }

            $mappedRecord['sheets_id'] = $sheet->id;
            $mappedRecord['created_at'] = now();
            $mappedRecord['updated_at'] = now();

            $data[] = $mappedRecord;

            // Batch insert when data reaches 1000 rows
            if (count($data) === 1000) {
                DB::table('leads')->insert($data);
                $data = [];
            }
        }

        // Insert remaining data
        if (!empty($data)) {
            DB::table('leads')->insert($data);
        }
    }

    $excludedColumnsMessage = !empty($excludedHeaders)
        ? ' The following columns were excluded as they do not match the database schema: ' . implode(', ', $excludedHeaders) . '.'
        : '';

    return redirect()->route('sheets.index')->with(
        'success',
        "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.$excludedColumnsMessage"
    );
}







    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'file' => 'required|file|mimes:csv,txt',
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

    //     // Initialize counters
    //     $totalRows = 0; // Tracks the total rows in the CSV
    //     $skippedRows = 0; // Tracks skipped rows due to duplicate emails

    //     // Process CSV file if present
    //     if ($request->file('file')->getClientOriginalExtension() === 'csv') {
    //         $fullPath = Storage::disk('public')->path($filePath);
    //         $csv = Reader::createFromPath($fullPath, 'r');
    //         $csv->setHeaderOffset(0); // Assuming the CSV has a header row

    //         $data = []; // Initialize an empty array to hold the rows

    //         // Fetch existing emails to avoid duplicates
    //         $existingEmails = DB::table('leads')->pluck('email')->toArray();

    //         foreach ($csv->getRecords() as $record) {
    //             $totalRows++; // Increment the total rows counter

    //             // Skip rows with duplicate emails
    //             if (!empty($record['email']) && in_array($record['email'], $existingEmails)) {
    //                 $skippedRows++; // Increment skipped rows counter
    //                 continue; // Skip this record
    //             }

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
    //                 'sheets_id' => $sheet->id, // Corrected from sheets_id
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
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

    //     // Redirect back with a success message, showing the total and skipped rows
    //     return redirect()->route('sheets.index')->with('success', "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.");
    // }



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







// এটা থাকলে এটা ---> হবে এই ভাবে সিস্টেম করে দাও
// Linkedln Link  ---> linkedinlLink
// Source Link --->sourceLink
// NamePrefix--->namePrefix
// First Name ---->firstName
// MiddleName --->middleName
// Last Name --->lastName
// SurName --->sureName
// Gender --->gender
// Contact Name --->fullName
// Title --->titlePosition
// Any field that contain Email or email --->emailAddress
// personal Phone --->personalPhone
// Employee Range --->employeeRange
// Person Location --->personalLocation
// Company Name --->companyName
// Company Website,Website,Web Link,WebLink --->companyWebsite
// Company Linkedin --->companyLinkedinLink
// Phone Number --->companyphone
// Number of Employees,#of Employees,Head Count --->companyHeadCount
// Industry --->industry
// Revenue --->revenue
// Street --->street
// City--->city
// State ----state
// Country --->country
// Zip --->zip
// Address --->fullAddress
// Rating ----> rating
// Job Link --->joblink
// Job Role, Job Vacancy --->Job Role
