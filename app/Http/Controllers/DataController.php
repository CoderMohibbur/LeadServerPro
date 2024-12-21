<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Sheet;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // Display the list of leads
    public function index()
    {
        $leads = Lead::all(); // Paginate the leads data
        $leads = Lead::paginate(10);
        return view('leadServer.index', compact('leads'));
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
        return view('leadServer.index', compact('leads'));
    }

    // Show the form for creating a new lead
    public function create()
    {
        $sheets = Sheet::all();
        return view('leadServer.create',compact('sheets'));// Return create view for lead
    }

    // Store the newly created lead in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'linkedin_link' => 'nullable|url',
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
            'source_link' => 'nullable|url',
            'middle_name' => 'nullable|string|max:255',
            'sur_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'personal_phone' => 'nullable|string|max:255',
            'employee_range' => 'nullable|string|max:255',
            'company_website' => 'nullable|url',
            'company_description' => 'nullable|string|max:1000',
            'company_linkedin_link' => 'nullable|url',
            'company_hq_address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'revenue' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'rating' => 'nullable|integer|min:1|max:5',
            'sheet_id' => 'nullable|integer|exists:sheets,id',
            'sheet_name' => 'nullable|string|max:255',
            'job_link' => 'nullable|url',
            'job_role' => 'nullable|string|max:255',
            'checked_by' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:1000',
            'sheets_id' => 'nullable|integer|exists:sheets,id', // Foreign key validation
        ]);

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
            'company_linkedin_link'=>$request,
            'company_hq_address'=>$request,
            'industry'=>$request,
            'revenue'=>$request,
            'street'=>$request,
            'zip_code'=>$request,
            'rating'=>$request,
            'sheet_id'=>$request,
            'sheet_name'=>$request,
            'job_link'=>$request,
            'job_role'=>$request,
            'checked_by'=>$request,
            'review'=>$request,
            'sheets_id'=>$request,
        ]);

        // Redirect with success message after saving
        return redirect()->route('leadServer.index')->with('success', 'Lead added successfully!');
    }

}
