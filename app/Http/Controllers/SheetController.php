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
            return view('leadServer.index2', compact('sheet', 'users','leadcount'));
        } elseif ($request->user()->hasRole('user')) {
            // Code for 'user' role
            $users = User::all();
            $leadcount = Lead::count();

            $sheet = Sheet::findOrFail($sheetId); // Find the sheet or return 404
            return view('leadServer.userindex2', compact('sheet', 'users','leadcount'));
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

        return view('leadServer.index2', compact('user', 'users','leadcount')); // Pass user to the view
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

    //Old store without heard auto
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:csv,txt',
    //         'sheet_name' => 'required|string|max:255',
    //         'sheet_working_date' => 'required|date',
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     $filePath = null;

    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('sheets', 'public');
    //     }

    //     $sheet = new Sheet();
    //     $sheet->file = $filePath;
    //     $sheet->sheet_name = $request->sheet_name;
    //     $sheet->sheet_working_date = $request->sheet_working_date;
    //     $sheet->user_id = $request->user_id;
    //     $sheet->save();

    //     $totalRows = 0;
    //     $skippedRows = 0;

    //     if ($request->file('file')->getClientOriginalExtension() === 'csv') {
    //         $fullPath = Storage::disk('public')->path($filePath);
    //         $csv = Reader::createFromPath($fullPath, 'r');
    //         $csv->setHeaderOffset(0);

    //         Log::info('CSV Headers:', $csv->getHeader());

    //         $data = [];
    //         $existingEmails = DB::table('leads')->pluck('email')->toArray();

    //         foreach ($csv->getRecords() as $record) {
    //             $totalRows++;

    //             if (!empty($record['email']) && in_array($record['email'], $existingEmails)) {
    //                 $skippedRows++;
    //                 continue;
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
    //                 'sheets_id' => $sheet->id, // Use sheets_id
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ];

    //             if (count($data) === 1000) {
    //                 Log::info('Inserting Batch:', $data);
    //                 DB::table('leads')->insert($data);
    //                 $data = [];
    //             }
    //         }

    //         if (!empty($data)) {
    //             Log::info('Inserting Remaining:', $data);
    //             DB::table('leads')->insert($data);
    //         }
    //     }

    //     return redirect()->route('sheets.index')->with('success', "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.");
    // }

    // normalize header condition

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:csv,txt',
    //         'sheet_name' => 'required|string|max:255',
    //         'sheet_working_date' => 'required|date',
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     $filePath = null;

    //     if ($request->hasFile('file')) {
    //         $filePath = $request->file('file')->store('sheets', 'public');
    //     }

    //     $sheet = new Sheet();
    //     $sheet->file = $filePath;
    //     $sheet->sheet_name = $request->sheet_name;
    //     $sheet->sheet_working_date = $request->sheet_working_date;
    //     $sheet->user_id = $request->user_id;
    //     $sheet->save();

    //     $totalRows = 0;
    //     $skippedRows = 0;

    //     if ($request->file('file')->getClientOriginalExtension() === 'csv') {
    //         $fullPath = Storage::disk('public')->path($filePath);
    //         $csv = Reader::createFromPath($fullPath, 'r');
    //         $csv->setHeaderOffset(0);

    //         // Header mapping for normalization
    //         $headerMap = [
    //             'linkedin link' => 'linkedin_link',
    //             'company name' => 'company_name',
    //             'contact name' => 'contact_name',
    //             'name prefix' => 'name_prefix',
    //             'full name' => 'full_name',
    //             'first name' => 'first_name',
    //             'last name' => 'last_name',
    //             'email' => 'email',
    //             'title position' => 'title_position',
    //             'person location' => 'person_location',
    //             'full address' => 'full_address',
    //             'company phone' => 'company_phone',
    //             'company head count' => 'company_head_count',
    //             'country' => 'country',
    //             'city' => 'city',
    //             'state' => 'state',
    //             'tag' => 'tag',
    //             'source link' => 'source_link',
    //             'middle name' => 'middle_name',
    //             'sur name' => 'sur_name',
    //             'gender' => 'gender',
    //             'personal phone' => 'personal_phone',
    //             'employee range' => 'employee_range',
    //             'company website' => 'company_website',
    //             'company linkedin link' => 'company_linkedin_link',
    //             'company hq address' => 'company_hq_address',
    //             'industry' => 'industry',
    //             'revenue' => 'revenue',
    //             'street' => 'street',
    //             'zip code' => 'zip_code',
    //             'rating' => 'rating',
    //             'sheet name' => 'sheet_name',
    //             'job link' => 'job_link',
    //             'job role' => 'job_role',
    //             'checked by' => 'checked_by',
    //             'review' => 'review',
    //         ];

    //         // Normalize headers and handle duplicates
    //         $headers = $csv->getHeader();
    //         $normalizedHeaders = [];
    //         $headerCount = [];

    //         foreach ($headers as $index => $header) {
    //             if (empty($header)) {
    //                 Log::warning("Empty header found at index $index. Skipping this column.");
    //                 continue;
    //             }
    //             $normalized = $headerMap[strtolower($header)] ?? strtolower(str_replace(' ', '_', $header));
    //             $normalized = $normalized ?: 'column'; // Default name for empty headers

    //             // Handle duplicate headers by appending a counter
    //             if (isset($headerCount[$normalized])) {
    //                 $headerCount[$normalized]++;
    //                 $normalized .= '_' . $headerCount[$normalized];
    //             } else {
    //                 $headerCount[$normalized] = 0;
    //             }

    //             $normalizedHeaders[] = $normalized;
    //         }

    //         Log::info('Normalized Headers:', $normalizedHeaders);

    //         $data = [];
    //         $existingEmails = DB::table('leads')->pluck('email')->toArray();

    //         foreach ($csv->getRecords() as $record) {
    //             $totalRows++;

    //             // Skip rows with duplicate emails
    //             if (!empty($record['email']) && in_array($record['email'], $existingEmails)) {
    //                 $skippedRows++;
    //                 continue;
    //             }

    //             $mappedRecord = [];
    //             foreach ($normalizedHeaders as $index => $dbColumn) {
    //                 if (isset($record[$headers[$index]])) {
    //                     $mappedRecord[$dbColumn] = $record[$headers[$index]];
    //                 } else {
    //                     $mappedRecord[$dbColumn] = null; // Assign null for missing columns
    //                 }
    //             }

    //             $mappedRecord['sheets_id'] = $sheet->id;
    //             $mappedRecord['created_at'] = now();
    //             $mappedRecord['updated_at'] = now();

    //             $data[] = $mappedRecord;

    //             // Batch insert when data reaches 1000 rows
    //             if (count($data) === 1000) {
    //                 DB::table('leads')->insert($data);
    //                 $data = [];
    //             }
    //         }

    //         // Insert remaining data
    //         if (!empty($data)) {
    //             DB::table('leads')->insert($data);
    //         }
    //     }

    //     return redirect()->route('sheets.index')->with('success', "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.");
    // }

    // Work two dynamic any type of sample

//     public function store(Request $request)
// {
//     $request->validate([
//         'file' => 'required|file|mimes:csv,txt',
//         'sheet_name' => 'required|string|max:255',
//         'sheet_working_date' => 'required|date',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     $filePath = null;

//     if ($request->hasFile('file')) {
//         $filePath = $request->file('file')->store('sheets', 'public');
//     }

//     $sheet = new Sheet();
//     $sheet->file = $filePath;
//     $sheet->sheet_name = $request->sheet_name;
//     $sheet->sheet_working_date = $request->sheet_working_date;
//     $sheet->user_id = $request->user_id;
//     $sheet->save();

//     $totalRows = 0;
//     $skippedRows = 0;

//     if ($request->file('file')->getClientOriginalExtension() === 'csv') {
//         $fullPath = Storage::disk('public')->path($filePath);
//         $csv = Reader::createFromPath($fullPath, 'r');
//         $csv->setHeaderOffset(0);

//         $headers = $csv->getHeader();
//         $existingEmails = DB::table('leads')->pluck('email')->toArray();
//         $data = [];

//         foreach ($csv->getRecords() as $record) {
//             $totalRows++;

//             // Skip rows with duplicate emails
//             if (!empty($record['email']) && in_array($record['email'], $existingEmails)) {
//                 $skippedRows++;
//                 continue;
//             }

//             $mappedRecord = [];
//             foreach ($headers as $header) {
//                 $dbColumn = strtolower(str_replace(' ', '_', $header)); // Normalize header to column name
//                 $mappedRecord[$dbColumn] = $record[$header] ?? null;
//             }

//             $mappedRecord['sheets_id'] = $sheet->id;
//             $mappedRecord['created_at'] = now();
//             $mappedRecord['updated_at'] = now();

//             $data[] = $mappedRecord;

//             // Batch insert when data reaches 1000 rows
//             if (count($data) === 1000) {
//                 DB::table('leads')->insert($data);
//                 $data = [];
//             }
//         }

//         // Insert remaining data
//         if (!empty($data)) {
//             DB::table('leads')->insert($data);
//         }
//     }

//     return redirect()->route('sheets.index')->with('success', "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.");
// }


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

        // Define header mappings for normalization
        $headerMap = [
            'linkedin_link' => ['linkedin link', 'linkedin', 'personal linkedin'],
            'company_name' => ['company', 'company name'],
            'contact_name'=>['Contact Name','fullName','FullName','Fullname'],
            'name_prefix'=>['namePrefix'],
            'full_name'=>[],
            'first_name' => ['first name', 'fname','firstName'],
            'last_name' => ['last name', 'lname','lastName'],
            'email' => ['email address', 'email','Email Address','emailAddress'],
            'phone' => ['phone number', 'phone', 'contact phone'],
            'title_position'=>['Title','titlePosition'],
            'person_location'=>['personalLocation'],
            'full_address'=>['fullAddress','Address '],
            'company_phone'=>['companyphone','Phone Number'],
            'company_head_count'=>['Number of Employees','#of Employees','Head Count','companyHeadCount'],
            'country'=>['country'],
            'city'=>['city'],
            'state'=>['state'],
            'tag'=>['tag'],
            'source_link'=>['sourceLink'],
            'middle_name'=>['middleName'],
            'sur_name'=>['sureName'],
            'gender'=>['gender'],
            'personal_phone'=>['personalPhone'],
            'employee_range'=>['employeeRange'],
            'company_website'=>['Company Website','Website','Web Link','WebLink ','companyWebsite'],
            'company_linkedin_link'=>['companyLinkedinLink'],
            'company_hq_address'=>['company hq address','hq address','company hq','company address'],
            'industry'=>['industry'],
            'revenue'=>['revenue'],
            'street'=>['street'],
            'zip_code'=>['zip','zip code'],
            'rating'=>['rating'],
            'sheet_name'=>[],
            'job_link'=>['joblink','JobLink'],
            'job_role'=>['Job Role','Job Vacancy'],
            'checked_by'=>['checkedby','checked by'],
            'review'=>['review'],
            'sheets_id'=>['sheetsid','sheets id'],

            // Add more mappings as needed
        ];

        $headers = $csv->getHeader();
        $normalizedHeaders = [];

        // Normalize headers using mappings
        foreach ($headers as $header) {
            $normalized = strtolower(str_replace([' ', '-', '.'], '_', trim($header)));
            $mappedHeader = array_search($normalized, array_column($headerMap, 0)) ?: $normalized;

            // Check aliases
            foreach ($headerMap as $key => $aliases) {
                if (in_array($normalized, $aliases)) {
                    $mappedHeader = $key;
                    break;
                }
            }

            $normalizedHeaders[] = $mappedHeader;
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

    return redirect()->route('sheets.index')->with('success', "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.");
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
