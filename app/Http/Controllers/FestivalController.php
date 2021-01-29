<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FestivalController extends Controller
{
    public function show(Festival $festival)
    {
        return view('view.festival', compact('festival'));
    }
    public function index(Request $request)
    {
        if ($request->sortType) {
            $sort = $request->sortType;
            $festivals = Festival::orderBy($sort)->paginate(3)->withQueryString();
            return view('index.festivals_only', compact('festivals'))->render();
        }
        $festivals = Festival::orderBy('created_at')->paginate(3);
        $festivals->appends(['sort' => 'created_at']);
        return view('index.festivals', compact('festivals'));
    }

    public function fetchEvents(Request $request)
    {
        if ($request->ajax()) {
            $sort = $request->get('sort');
            switch ($sort) {
                case 'name':
                    $festivals = Festival::orderBy('name')->paginate(3);
                    break;
                case 'founded':
                    $festivals = Festival::orderBy('founded')->paginate(3);
                    break;
                default:
                    $festivals = Festival::orderBy('date')->paginate(3);
                    break;
            }
        }
        return view('index.festivals_only', compact('festivals'))->render();
    }
}
