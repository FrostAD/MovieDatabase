<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFestival;
use App\Models\Festival;

class FestivalController extends Controller
{
    public function upload_view()
    {
        return view('addPages.addFestival');
    }
    public function upload(StoreFestival $request)
    {
        // dd($request->all());
        $festival = $request->all();
        $festival['author_id'] = auth()->id();
        Festival::create($festival);

        return redirect()->back()->with('message', 'Festival added successfully.');
    }
}
