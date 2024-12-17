<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YourController extends Controller
{
    public function export()
    {
        // Your export logic here
        return response()->json(['message' => 'Export functionality']);
    }

    public function import()
    {
        // Your import logic here
        return response()->json(['message' => 'Import functionality']);
    }

    public function allSheets()
    {
        // Your logic for displaying all sheets
        return view('all-sheets'); // Adjust the view name as needed
    }

    public function reset()
    {
        // Your reset logic here
        return redirect()->route('dashboard'); // Example: redirect after reset
    }

    public function globalFilter()
    {
        // Your global filter logic here
        return view('global-filter'); // Adjust the view name as needed
    }
}
