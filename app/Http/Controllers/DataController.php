<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Sheet;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class DataController extends Controller
{
    // Display the list of leads
    public function index()
    {
        // $leads = Lead::all(); // Paginate the leads data
        $leads = Lead::paginate(10);
        $categories = Lead::all();
        return view('leadServer.index', compact('leads', 'categories'));
    }

    public function dataServer(Request $request)
    {
        $query = Lead::query();

        // Apply filters dynamically
        foreach ($request->all() as $column => $values) {
            if (is_array($values) && !empty($values)) {
                // Apply whereIn filter for columns with selected values
                $query->whereIn($column, $values);
            }
        }

        // Return the filtered data to DataTables
        return DataTables::of($query)->make(true);
    }

    public function getFilterValues()
    {
        return response()->json([
            'linkedin_link' => Lead::distinct()->pluck('linkedin_link')->filter(),
            'company_name' => Lead::distinct()->pluck('company_name')->filter(),
            'contact_name' => Lead::distinct()->pluck('contact_name')->filter(),
            'name_prefix' => Lead::distinct()->pluck('name_prefix')->filter(),
            'full_name' => Lead::distinct()->pluck('full_name')->filter(),
            'first_name' => Lead::distinct()->pluck('first_name')->filter(),
            'last_name' => Lead::distinct()->pluck('last_name')->filter(),
            'email' => Lead::distinct()->pluck('email')->filter(),
            'title_position' => Lead::distinct()->pluck('title_position')->filter(),
            'person_location' => Lead::distinct()->pluck('person_location')->filter(),
            'full_address' => Lead::distinct()->pluck('full_address')->filter(),
            'company_phone' => Lead::distinct()->pluck('company_phone')->filter(),
            'company_head_count' => Lead::distinct()->pluck('company_head_count')->filter(),
            'country' => Lead::distinct()->pluck('country')->filter(),
            'city' => Lead::distinct()->pluck('city')->filter(),
            'state' => Lead::distinct()->pluck('state')->filter(),
            'tag' => Lead::distinct()->pluck('tag')->filter(),
            'source_link' => Lead::distinct()->pluck('source_link')->filter(),
            'middle_name' => Lead::distinct()->pluck('middle_name')->filter(),
            'sur_name' => Lead::distinct()->pluck('sur_name')->filter(),
            'gender' => Lead::distinct()->pluck('gender')->filter(),
            'personal_phone' => Lead::distinct()->pluck('personal_phone')->filter(),
            'employee_range' => Lead::distinct()->pluck('employee_range')->filter(),
            'company_website' => Lead::distinct()->pluck('company_website')->filter(),
            'company_linkedin_link' => Lead::distinct()->pluck('company_linkedin_link')->filter(),
            'company_hq_address' => Lead::distinct()->pluck('company_hq_address')->filter(),
            'industry' => Lead::distinct()->pluck('industry')->filter(),
            'revenue' => Lead::distinct()->pluck('revenue')->filter(),
            'street' => Lead::distinct()->pluck('street')->filter(),
            'zip_code' => Lead::distinct()->pluck('zip_code')->filter(),
            'rating' => Lead::distinct()->pluck('rating')->filter(),
            'sheet_name' => Lead::distinct()->pluck('sheet_name')->filter(),
            'job_link' => Lead::distinct()->pluck('job_link')->filter(),
            'job_role' => Lead::distinct()->pluck('job_role')->filter(),
            'checked_by' => Lead::distinct()->pluck('checked_by')->filter(),
            'review' => Lead::distinct()->pluck('review')->filter(),
        ]);
    }


    // public function dataServer(Request $request)
    // {
    //     $clientId = $request->input('client_id');
    //     $sheetId = $request->input('sheet_id');

    //     // Validate the parameters if needed
    //     if (!$clientId || !$sheetId) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'client_id and sheet_id are required.'
    //         ], 400);
    //     }

    //     // Filter leads based on client_id and sheet_id
    //     $leads = Lead::where('client_id', $clientId)
    //                  ->where('sheet_id', $sheetId)
    //                  ->get();

    //     return DataTables::of($leads)->toJson();
    // }


    // Filter leads based on search criteria
    public function filter(Request $request)
    {
        $query = Lead::query();

        if ($request->company_name) {
            $query->where('company_name', 'LIKE', '%' . $request->company_name . '%');
        }
        if ($request->email) {
            $query->where('email', $request->email);
        }
        if ($request->title_position) {
            $query->where('title_position', 'LIKE', '%' . $request->title_position . '%');
        }
        if ($request->country) {
            $query->where('country', $request->country);
        }

        $leads = $query->paginate(10);
        return view('leadServer.index', compact('leads'));
    }

    // Show the form for creating a new lead
    public function create()
    {
        $sheets = Sheet::all();
        return view('leadServer.create', compact('sheets')); // Return create view for lead
    }

    // Store the newly created lead in the database
    public function csvStore(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'linkedin_link' => 'nullable|string|max:1000',
            'company_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'name_prefix' => 'nullable|string|max:50',
            'full_name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'title_position' => 'nullable|string|max:255',
            'person_location' => 'nullable|string|max:255',
            'full_address' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_head_count' => 'nullable|integer',
            'country' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
            'source_link' => 'nullable|string|max:1000',
            'middle_name' => 'nullable|string|max:255',
            'sur_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'personal_phone' => 'nullable|string|max:255',
            'employee_range' => 'nullable|string|max:255',
            'company_website' => 'nullable|string|max:1000',
            'company_description' => 'nullable|string|max:1000',
            'company_linkedin_link' => 'nullable|string|max:1000',
            'company_hq_address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'revenue' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'rating' => 'nullable|integer|min:1|max:5',
            'sheet_name' => 'nullable|string|max:255',
            'job_link' => 'nullable|string|max:1000',
            'job_role' => 'nullable|string|max:255',
            'checked_by' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:1000',
            'sheets_id' => 'nullable|integer|exists:sheets,id', // Foreign key validation
        ]);

        // dd($request->all());

        // Insert the new lead data into the database
        Lead::create([
            'linkedin_link' => $request->linkedin_link,
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'name_prefix' => $request->name_prefix,
            'full_name' => $request->full_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'title_position' => $request->title_position,
            'person_location' => $request->person_location,
            'full_address' => $request->full_address,
            'company_phone' => $request->company_phone,
            'company_head_count' => $request->company_head_count,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'tag' => $request->tag,
            'source_link' => $request->source_link,
            'middle_name' => $request->middle_name,
            'sur_name' => $request->sur_name,
            'gender' => $request->gender,
            'personal_phone' => $request->personal_phone,
            'employee_range' => $request->employee_range,
            'company_website' => $request->company_website,
            'company_description' => $request->company_description,
            'company_linkedin_link' => $request->company_linkedin_link,
            'company_hq_address' => $request->company_hq_address,
            'industry' => $request->industry,
            'revenue' => $request->revenue,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'rating' => $request->rating,
            'sheet_name' => $request->sheet_name,
            'job_link' => $request->job_link,
            'job_role' => $request->job_role,
            'checked_by' => $request->checked_by,
            'review' => $request->review,
            'sheets_id' => $request->sheets_id,
        ]);

        // Redirect with success message after saving
        return redirect()->route('lead-server.index')->with('success', 'Lead added successfully!');
    }


    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'linkedin_link' => 'nullable|string|max:1000',
            'company_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'name_prefix' => 'nullable|string|max:50',
            'full_name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'title_position' => 'nullable|string|max:255',
            'person_location' => 'nullable|string|max:255',
            'full_address' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_head_count' => 'nullable|integer',
            'country' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
            'source_link' => 'nullable|string|max:1000',
            'middle_name' => 'nullable|string|max:255',
            'sur_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'personal_phone' => 'nullable|string|max:255',
            'employee_range' => 'nullable|string|max:255',
            'company_website' => 'nullable|string|max:1000',
            'company_description' => 'nullable|string|max:1000',
            'company_linkedin_link' => 'nullable|string|max:1000',
            'company_hq_address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'revenue' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'rating' => 'nullable|integer|min:1|max:5',
            'sheet_name' => 'nullable|string|max:255',
            'job_link' => 'nullable|string|max:1000',
            'job_role' => 'nullable|string|max:255',
            'checked_by' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:1000',
            'sheets_id' => 'nullable|integer|exists:sheets,id',
        ]);

        // Save lead data to the database
        $lead = Lead::create($request->all());

        // Prepare data for the CSV file
        $data = [
            $lead->linkedin_link,
            $lead->company_name,
            $lead->contact_name,
            $lead->name_prefix,
            $lead->full_name,
            $lead->first_name,
            $lead->last_name,
            $lead->email,
            $lead->title_position,
            $lead->person_location,
            $lead->full_address,
            $lead->company_phone,
            $lead->company_head_count,
            $lead->country,
            $lead->city,
            $lead->state,
            $lead->tag,
            $lead->source_link,
            $lead->middle_name,
            $lead->sur_name,
            $lead->gender,
            $lead->personal_phone,
            $lead->employee_range,
            $lead->company_website,
            $lead->company_description,
            $lead->company_linkedin_link,
            $lead->company_hq_address,
            $lead->industry,
            $lead->revenue,
            $lead->street,
            $lead->zip_code,
            $lead->rating,
            $lead->sheet_name,
            $lead->job_link,
            $lead->job_role,
            $lead->checked_by,
            $lead->review,
            $lead->sheets_id,
        ];

        // Define the CSV file path
        $filePath = 'leads.csv';
        $fileExists = Storage::exists($filePath);

        // Open the CSV file for appending
        $handle = fopen(Storage::path($filePath), $fileExists ? 'a' : 'w');

        // If file is new, write the header row
        if (!$fileExists) {
            fputcsv($handle, [
                'linkedin_link',
                'company_name',
                'contact_name',
                'name_prefix',
                'full_name',
                'first_name',
                'last_name',
                'email',
                'title_position',
                'person_location',
                'full_address',
                'company_phone',
                'company_head_count',
                'country',
                'city',
                'state',
                'tag',
                'source_link',
                'middle_name',
                'sur_name',
                'gender',
                'personal_phone',
                'employee_range',
                'company_website',
                'company_description',
                'company_linkedin_link',
                'company_hq_address',
                'industry',
                'revenue',
                'street',
                'zip_code',
                'rating',
                'sheet_name',
                'job_link',
                'job_role',
                'checked_by',
                'review',
                'sheets_id',
            ]);
        }

        // Write the data row to the CSV file
        fputcsv($handle, $data);

        // Close the CSV file
        fclose($handle);

        // Redirect with success message



        return redirect()->route('lead-server.index')->with('success', 'Lead added and CSV updated successfully!');


    }

    public function dashboard_TotalLead(){

        $leads = Lead::count();
        $users = User::count();
        $sheets = Sheet::count();
        $tickets = Ticket::count();



        return view('dashboard', compact('leads','users','sheets','tickets'));
    }






}
