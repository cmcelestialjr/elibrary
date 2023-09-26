<?php

namespace App\Http\Controllers\LMS;

use App\Http\Controllers\Controller;
use App\Models\LMSBooksInfo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $term = $request->input('term');
       
        if (empty($term)) {
            $results = LMSBooksInfo::where('id','<=',10)->paginate(8);
        } else {
            $results = LMSBooksInfo::where('title', 'like', '%' . $term . '%')
                ->orWhere('publisher', 'like', '%' . $term . '%')
                ->orWhere('subject', 'like', '%' . $term . '%')
                ->paginate(8);
        }
        $totalCount = $results->total();
        $totalCountDisplay = number_format($totalCount).' results';
        if($totalCount<=1){
            $totalCountDisplay = $totalCount.' result';
        }
        return response()->json([
            'results' => $results,
            'totalCount' => $totalCountDisplay,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
