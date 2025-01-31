<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Sheet;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class DataController extends Controller
{
    // Display the list of leads
    public function index(Request $request)
    {
        $user = Auth::user(); // Explicitly retrieve the authenticated user

        if ($request->user()->hasRole('admin|manager')) {
            $leadcount = Lead::count();
            $leads = Lead::paginate(10);
            // $categories = Lead::all();
            $users = User::all();
            return view('leadServer.index2', compact('leads', 'users','leadcount'));
        } elseif ($request->user()->hasRole('user')) {
            // $leads = Lead::all(); // Paginate the leads data
            $leadcount = Lead::whereHas('sheet', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            $leads = Lead::paginate(10);
            // $categories = Lead::all();
            $users = User::all();
            return view('leadServer.userindex2', compact('leads', 'users','leadcount'));
        } else {
            // Code for other roles or unauthorized access
            return response()->json(['message' => 'Access Denied.','leadcount'], 403);
        }
    }

    // public function dataServer(Request $request)
    // {
    //     $query = Lead::query();

    //     // Apply filters dynamically
    //     foreach ($request->all() as $column => $values) {
    //         if (is_array($values) && !empty($values)) {
    //             // Apply whereIn filter for columns with selected values
    //             $query->whereIn($column, $values);
    //         }
    //     }

    //     // Return the filtered data to DataTables
    //     return DataTables::of($query)->make(true);
    // }
    public function dataServer(Request $request)
    {
        $query = Lead::query();

        if ($request->hasAny(['sheet_id', 'user_id'])) {
            $query->when($request->filled('sheet_id'), function ($q) use ($request) {
                $q->where('sheets_id', $request->sheet_id);
            });

            $query->when($request->filled('user_id'), function ($q) use ($request) {
                $q->whereHas('sheet', function ($subQuery) use ($request) {
                    $subQuery->where('user_id', $request->user_id);
                });
            });
        }

        // // Apply other filters dynamically
        // foreach ($request->all() as $column => $values) {
        //     if (is_array($values) && !empty($values)) {
        //         // Apply whereIn filter for columns with selected values
        //         $query->whereIn($column, $values);
        //     }
        // }

        // Apply other filters dynamically
        foreach ($request->all() as $column => $values) {
            if (is_array($values) && !empty($values)) {
                // Apply like filter for columns with selected values
                foreach ($values as $value) {
                    $query->orWhere($column, 'like', '%' . $value . '%');
                }
            }
        }
        $query->orderBy('id', 'desc');

        $query->take(5000);
        // Return the filtered data to DataTables
        return DataTables::of($query)->make(true);
    }

    // public function dataServer(Request $request)
    // {
    //     $query = Lead::query();

    //     // Apply specific filters
    //     if ($request->filled('sheet_id')) {
    //         $query->where('sheets_id', $request->sheet_id);
    //     }

    //     if ($request->filled('user_id')) {
    //         $query->whereHas('sheet', function ($subQuery) use ($request) {
    //             $subQuery->where('user_id', $request->user_id);
    //         });
    //     }

    //     // Apply dynamic filters
    //     foreach ($request->all() as $column => $values) {
    //         if (is_array($values) && !empty($values) && Schema::hasColumn('leads', $column)) {
    //             foreach ($values as $value) {
    //                 if (is_scalar($value)) {
    //                     $query->orWhere($column, 'like', '%' . $value . '%');
    //                 }
    //             }
    //         }
    //     }

    //     // Handle DataTables pagination parameters
    //     $start = $request->get('start', 0);
    //     $length = $request->get('length', 25);

    //     // Select only necessary columns
    //     $query->select([
    //         'id',
    //         'linkedin_link',
    //         'company_name',
    //         'contact_name',
    //         'first_name',
    //         'last_name',
    //         'email',
    //         'title_position',
    //         'personal_phone',
    //         'country',
    //         'job_link',
    //         'job_role',
    //         'tag',
    //         'person_location',
    //         'full_address',
    //         'company_phone',
    //         'company_head_count',
    //         'city',
    //         'state',
    //         'source_link',
    //         'middle_name',
    //         'sur_name',
    //         'gender',
    //         'employee_range',
    //         'company_website',
    //         'company_linkedin_link',
    //         'company_hq_address',
    //         'industry',
    //         'revenue',
    //         'street',
    //         'zip_code',
    //         'rating',
    //         'sheet_name',
    //         'checked_by',
    //         'review',
    //         'created_at',
    //         'updated_at',
    //     ]);

    //     // Paginate the query
    //     $query->skip($start)->take($length);

    //     // Return the filtered data to DataTables
    //     return DataTables::of($query)
    //         ->with('draw', $request->get('draw'))
    //         ->make(true);
    // }



    // public function dataServer(Request $request)
    // {
    //     $query = Lead::query();

    //     if ($request->hasAny(['sheet_id', 'user_id'])) {
    //         $query->when($request->filled('sheet_id'), function ($q) use ($request) {
    //             $q->where('sheets_id', $request->sheet_id);
    //         });

    //         $query->when($request->filled('user_id'), function ($q) use ($request) {
    //             $q->whereHas('sheet', function ($subQuery) use ($request) {
    //                 $subQuery->where('user_id', $request->user_id);
    //             });
    //         });
    //     }

    //     // Apply other filters dynamically
    //     foreach ($request->all() as $column => $values) {
    //         if (is_array($values) && !empty($values)) {
    //             foreach ($values as $value) {
    //                 $query->orWhere($column, 'like', '%' . $value . '%');
    //             }
    //         }
    //     }

    //     // Handle dynamic pagination
    //     $start = $request->input('start', 0); // Defaults to 0 if not provided
    //     $length = $request->input('length', 25); // Defaults to 25 if not provided

    //     $query->offset($start)->limit($length);

    //     // Return the filtered data to DataTables
    //     return DataTables::of($query)->make(true);
    // }



    public function updateFilterValues()
    {
        $filters = [
            'linkedin_link', 'company_name', 'contact_name', 'name_prefix', 'full_name',
            'first_name', 'last_name', 'email', 'title_position', 'person_location',
            'full_address', 'company_phone', 'company_head_count', 'country', 'city',
            'state', 'tag', 'source_link', 'middle_name', 'sur_name', 'gender',
            'personal_phone', 'employee_range', 'company_website', 'company_linkedin_link',
            'company_hq_address', 'industry', 'revenue', 'street', 'zip_code', 'rating',
            'sheet_name', 'job_link', 'job_role', 'checked_by', 'review',
        ];

        foreach ($filters as $filter) {
            $distinctValues = Lead::distinct()->pluck($filter)->filter();
            DB::table('filter_values')->updateOrInsert(
                ['filter_key' => $filter],
                ['filter_values' => $distinctValues->values(), 'updated_at' => now()]
            );
        }
    }

    public function getFilterValues()
    {
        $fields = [
            'linkedin_link', 'company_name', 'contact_name', 'full_name',
            'first_name', 'last_name', 'email', 'person_location',
            'full_address', 'city', 'tag', 'source_link', 'personal_phone',
            'company_website', 'company_linkedin_link', 'company_hq_address',
            'industry', 'zip_code', 'sheet_name', 'job_link'
        ];

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = Lead::distinct()
                ->pluck($field)
                ->take(20)
                ->filter()
                ->toArray();

            // Reindex to ensure consistency (convert associative arrays to plain arrays)
            $data[$field] = array_values($data[$field]);
        }

        // Log::info('Filter Values:', $data);

        return response()->json($data);
    }

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
        return view('leadServer.index2', compact('leads'));
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
            // 'checked_by' => 'nullable|string|max:255',
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
            // 'checked_by' => $request->checked_by,
            'review' => $request->review,
            'sheets_id' => $request->sheets_id,
        ]);

        // Redirect with success message after saving
        return redirect()->route('leadServer.index2')->with('success', 'Lead added successfully!');
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
            // 'checked_by' => 'nullable|string|max:255',
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
            // $lead->checked_by,
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
                // 'checked_by',
                'review',
                'sheets_id',
            ]);
        }

        // Write the data row to the CSV file
        fputcsv($handle, $data);

        // Close the CSV file
        fclose($handle);

        // Redirect with success message

        return redirect()->route('leadServer.index2')->with('success', 'Lead added and CSV updated successfully!');
    }


    public function destroy($id)
    {
        try {
            // Find the lead by ID
            $lead = Lead::findOrFail($id);

            // Delete the lead
            $lead->delete();

            // Return success response
            return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the user.']);
        }
    }

}
