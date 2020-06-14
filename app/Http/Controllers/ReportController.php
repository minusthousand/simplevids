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
}
