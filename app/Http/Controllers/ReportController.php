<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Video;
use Auth;

class ReportController extends Controller
{
    public function create($id){
        if (Auth::guest()) {
            $reg = '/register';
            return redirect($reg);
        }
        return view('report', ['video_id' => $id]);
    }

    public function store(Request $request) {
        if (Auth::guest()) {
            $reg = '/register';
            return redirect($reg);
        }

        $report = new Report();
        $video = Video::where('id', $request->video)->first();
        $report->Video()->associate($video);
        $report->reason = $request->reason;
        $report->save();

        return redirect('/');
    }

    public function showAll(){
        if (auth()->user()->role != 'admin'){
                return "Access Denied!";
        }
        $reports = Report::with('video')->get();
        return view('reports', ['reports' => $reports]);
    }

    public function delete($id) {
        if (auth()->user()->role != 'admin'){
            return "Access Denied!";
    }
    Report::where('id', $id)->delete();
    return redirect('/reportsall');
    }
}
