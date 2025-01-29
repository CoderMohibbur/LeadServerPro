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

    //         $dbColumns = Schema::getColumnListing('leads');
    //         $dbColumns = array_map('strtolower', $dbColumns);
    //         $headerMap = [
    //             'linkedin_link' => ['linkedin link', 'linkedin', 'personal linkedin', 'linkedin_link', 'LinkedIn Link'],
    //             'company_name' => ['company', 'company name', 'company_name'],
    //             'contact_name' => ['Contact Name', 'fullName', 'FullName', 'Fullname', 'full name', 'contact_name'],
    //             'name_prefix' => ['namePrefix', 'name_prefix'],
    //             'full_name' => ['Contact Name', 'fullName', 'FullName', 'Fullname', 'full name', 'full_name'],
    //             'first_name' => ['first name', 'fname', 'firstName', 'first_name'],
    //             'last_name' => ['last name', 'lname', 'lastName'],
    //             'email' => ['email address', 'email', 'Email Address', 'emailAddress', 'Buisness Email', 'buisness email', 'Business Email', 'Business Email Address', 'business_email_address'],
    //             'phone' => ['phone number', 'phone', 'contact phone'],
    //             'title_position' => ['Title', 'titlePosition'],
    //             'person_location' => ['personalLocation', 'location', 'personal location', 'personal address'],
    //             'full_address' => ['fullAddress', 'Address '],
    //             'company_phone' => ['companyphone', 'Phone Number'],
    //             'company_head_count' => ['Number of Employees', '# of Employees', 'Head Count', 'companyHeadCount', '#of Employees', 'company_head_count', '#of_employee', '#_of_employee'],
    //             'country' => ['country'],
    //             'city' => ['city'],
    //             'state' => ['state'],
    //             'tag' => ['tag'],
    //             'source_link' => ['sourceLink', 'source_link'],
    //             'middle_name' => ['middleName', 'middle_name'],
    //             'sur_name' => ['sureName', 'sur_name'],
    //             'gender' => ['gender'],
    //             'personal_phone' => ['personalPhone', 'personal_phone', 'phone'],
    //             'employee_range' => ['employeeRange', 'employee_range'],
    //             'company_website' => ['Company Website', 'Website', 'Web Link', 'WebLink ', 'companyWebsite', 'company_website'],
    //             'company_linkedin_link' => ['companyLinkedinLink', 'company_linkedin', 'company linkedin', 'company_linkedin_link'],
    //             'company_hq_address' => ['company hq address', 'hq address', 'company hq', 'company_hq', 'company address', 'company_hq_address', 'job_location'],
    //             'industry' => ['industry', 'Industry'],
    //             'revenue' => ['revenue'],
    //             'street' => ['street'],
    //             'zip_code' => ['zip', 'zip code', 'zipcode', 'zip_code'],
    //             'rating' => ['rating'],
    //             'sheet_name' => ['sheet_name'],
    //             'job_link' => ['joblink', 'JobLink', 'job_link', 'Job Posting Source Link'],
    //             'job_role' => ['Job Role', 'Job Vacancy', 'job_role'],
    //             'checked_by' => ['checkedby', 'checked by', 'checked_by'],
    //             'review' => ['review', 'review_by']
    //         ];

    //         $headers = $csv->getHeader();
    //         $normalizedHeaders = [];
    //         $excludedHeaders = [];
    //         $headerDebugInfo = [];

    //         foreach ($headers as $header) {
    //             $normalized = strtolower(str_replace([' ', '-', '.'], '_', trim($header)));
    //             $mappedHeader = null;

    //             foreach ($headerMap as $key => $aliases) {
    //                 if (in_array($header, $aliases, true) || in_array($normalized, $aliases, true)) {
    //                     $mappedHeader = $key;
    //                     break;
    //                 }
    //             }

    //             $normalizedHeader = $mappedHeader ?: $normalized;

    //             if (in_array($normalizedHeader, $dbColumns)) {
    //                 $normalizedHeaders[] = $normalizedHeader;
    //             } else {
    //                 $excludedHeaders[] = $header;
    //             }

    //             $headerDebugInfo[] = [
    //                 'original' => $header,
    //                 'normalized' => $normalized,
    //                 'mapped' => $mappedHeader,
    //                 'final' => $normalizedHeader,
    //                 'included' => in_array($normalizedHeader, $dbColumns),
    //             ];
    //         }

    //         Log::info('Header Processing Information:', $headerDebugInfo);
    //         Log::info('Normalized Headers:', $normalizedHeaders);
    //         Log::info('Excluded Headers:', $excludedHeaders);

    //         $existingEmails = DB::table('leads')->pluck('email')->map(fn($email) => strtolower(trim($email)))->toArray();
    //         $data = [];

    //         foreach ($csv->getRecords() as $record) {
    //             $totalRows++;
    //             $email = isset($record['email']) ? strtolower(trim($record['email'])) : null;

    //             if (!empty($email) && in_array($email, $existingEmails)) {
    //                 $skippedRows++;
    //                 continue;
    //             }

    //             $mappedRecord = [];
    //             foreach ($normalizedHeaders as $index => $dbColumn) {
    //                 $value = $record[$headers[$index]] ?? null;
    //                 $mappedRecord[$dbColumn] = $value;
    //             }

    //             $mappedRecord['sheets_id'] = $sheet->id;
    //             $mappedRecord['created_at'] = now();
    //             $mappedRecord['updated_at'] = now();

    //             $data[] = $mappedRecord;

    //             if (!empty($email)) {
    //                 $existingEmails[] = $email;
    //             }

    //             if (count($data) === 1000) {
    //                 DB::table('leads')->insert($data);
    //                 $data = [];
    //             }
    //         }

    //         if (!empty($data)) {
    //             DB::table('leads')->insert($data);
    //         }
    //     }

    //     $excludedColumnsMessage = !empty($excludedHeaders)
    //         ? ' The following columns were excluded as they do not match the database schema: ' . implode(', ', $excludedHeaders) . '.'
    //         : '';

    //     return redirect()->route('sheets.index')->with(
    //         'success',
    //         "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.$excludedColumnsMessage"
    //     );
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

            $dbColumns = Schema::getColumnListing('leads');
            $dbColumns = array_map('strtolower', $dbColumns);

            $headerMap = [
                'linkedin_link' => ['linkedin link', 'linkedin', 'personal linkedin', 'linkedin_link', 'LinkedIn Link'],
                'company_name' => ['company', 'company name', 'company_name'],
                'contact_name' => ['Contact Name', 'fullName', 'FullName', 'Fullname', 'full name', 'contact_name'],
                'name_prefix' => ['namePrefix', 'name_prefix'],
                'full_name' => ['Contact Name', 'fullName', 'FullName', 'Fullname', 'full name', 'full_name'],
                'first_name' => ['first name', 'fname', 'firstName', 'first_name'],
                'last_name' => ['last name', 'lname', 'lastName'],
                'email' => ['email address', 'email', 'Email Address', 'emailAddress', 'Buisness Email', 'buisness email', 'Business Email', 'Business Email Address', 'business_email_address'],
                'phone' => ['phone number', 'phone', 'contact phone'],
                'title_position' => ['Title', 'titlePosition'],
                'person_location' => ['personalLocation', 'location', 'personal location', 'personal address'],
                'full_address' => ['fullAddress', 'Address '],
                'company_phone' => ['companyphone', 'Phone Number'],
                'company_head_count' => ['Number of Employees', '# of Employees', 'Head Count', 'companyHeadCount', '#of Employees', 'company_head_count', '#of_employee', '#_of_employee'],
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
                'company_linkedin_link' => ['companyLinkedinLink', 'company_linkedin', 'company linkedin', 'company_linkedin_link'],
                'company_hq_address' => ['company hq address', 'hq address', 'company hq', 'company_hq', 'company address', 'company_hq_address', 'job_location'],
                'industry' => ['industry', 'Industry'],
                'revenue' => ['revenue'],
                'street' => ['street'],
                'zip_code' => ['zip', 'zip code', 'zipcode', 'zip_code'],
                'rating' => ['rating'],
                'sheet_name' => ['sheet_name'],
                'job_link' => ['joblink', 'JobLink', 'job_link', 'Job Posting Source Link'],
                'job_role' => ['Job Role', 'Job Vacancy', 'job_role'],
                'checked_by' => ['checkedby', 'checked by', 'checked_by'],
                'review' => ['review', 'review_by']
            ];
            $headers = $csv->getHeader();

            $normalizedHeaders = [];
            $excludedHeaders = [];
            $headerIndexMap = [];
            $headerDebugInfo = [];

            foreach ($headers as $index => $header) {
                $normalized = strtolower(str_replace([' ', '-', '.'], '_', trim($header)));
                $mappedHeader = null;

                foreach ($headerMap as $key => $aliases) {
                    if (in_array($header, $aliases, true) || in_array($normalized, $aliases, true)) {
                        $mappedHeader = $key;
                        break;
                    }
                }

                $normalizedHeader = $mappedHeader ?: $normalized;

                if (in_array($normalizedHeader, $dbColumns)) {
                    $normalizedHeaders[] = $normalizedHeader;
                    $headerIndexMap[$index] = $normalizedHeader;
                } else {
                    $excludedHeaders[] = $header;
                    $headerIndexMap[$index] = null;
                }

                $headerDebugInfo[] = [
                    'original' => $header,
                    'normalized' => $normalized,
                    'mapped' => $mappedHeader,
                    'final' => $normalizedHeader,
                    'included' => in_array($normalizedHeader, $dbColumns),
                ];
            }

            // if (!in_array('email', array_map('strtolower', $headers))) {
            //     if (isset($sheet)) {
            //         $sheet->delete(); // Delete sheet entry if it was created
            //     }
            //     if (file_exists($fullPath)) {
            //         unlink($fullPath);
            //     }
            //     return redirect()->route('sheets.index')->with('error', 'Sheet must contain an email column. Upload failed.');
            // }

            if (!in_array('email', $normalizedHeaders)) {
                if (isset($sheet)) {
                    $sheet->delete(); // Delete sheet entry if it was created
                }
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
                return redirect()->route('sheets.index')->with('error', 'Sheet must contain an email column. Upload failed.');
            }
            

            Log::info('Header Processing Information:', $headerDebugInfo);
            Log::info('Normalized Headers:', $normalizedHeaders);
            Log::info('Excluded Headers:', $excludedHeaders);

            $existingEmails = DB::table('leads')->pluck('email')->map(fn($email) => strtolower(trim($email)))->toArray();
            $data = [];

            foreach ($csv->getRecords() as $record) {
                $totalRows++;
                $email = isset($record['email']) ? strtolower(trim($record['email'])) : null;

                if (!empty($email) && in_array($email, $existingEmails)) {
                    $skippedRows++;
                    continue;
                }

                $mappedRecord = [];
                foreach ($headerIndexMap as $index => $dbColumn) {
                    if ($dbColumn !== null) {
                        $mappedRecord[$dbColumn] = $record[$headers[$index]] ?? null;
                    }
                }

                $mappedRecord['sheets_id'] = $sheet->id;
                $mappedRecord['created_at'] = now();
                $mappedRecord['updated_at'] = now();

                $data[] = $mappedRecord;

                if (!empty($email)) {
                    $existingEmails[] = $email;
                }

                if (count($data) === 1000) {
                    DB::table('leads')->insert($data);
                    $data = [];
                }
            }

            if (!empty($data)) {
                DB::table('leads')->insert($data);
            }
        }

        if ($totalRows === 0) {
            if (isset($sheet)) {
                $sheet->delete(); // Delete sheet entry if it was created
            }
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            return redirect()->route('sheets.index')->with('error', 'No valid data found in the sheet. Upload failed.');
        }

        $excludedColumnsMessage = !empty($excludedHeaders)
            ? ' The following columns were excluded as they do not match the database schema: ' . implode(', ', $excludedHeaders) . '.'
            : '';

        return redirect()->route('sheets.index')->with(
            'success',
            "Sheet created successfully! Total rows: $totalRows, Skipped rows: $skippedRows.$excludedColumnsMessage"
        );
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
