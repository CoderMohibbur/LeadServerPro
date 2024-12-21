<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class DataController extends Controller
{
    // ডাটা লোড করার জন্য
    public function index()
    {
        $leads = Lead::paginate(10); // পেজিনেশন সহ ডাটা লোড
        return view('leadServer.index', compact('leads'));

    }

    // ফিল্টার করার জন্য
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

}
