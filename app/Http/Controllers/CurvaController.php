<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use App\Models\JadualDetail;
use Illuminate\Http\Request;

class CurvaController extends Controller
{

    public function index($id)
    {
        return view('curva.index', compact('id'));
    }

    private function addDayswithdate($date, $days)
    {
        $date = strtotime("+" . $days . " days", strtotime($date));
        return date("Y-m-d", $date);
    }

    private function sortDateAsWeek($start, $week, $end_date)
    {
        $tglWeek = [];
        $start = date_create($start);
        $end = date_create($end_date);
        $interval = date_diff($start, $end);
        $interval = $interval->format('%a');
        $interval = $interval / 7;
        $interval = floor($interval);
        $interval = $interval + 1;
        $tglWeek[] = $start->format('Y-m-d');
        for ($i = 1; $i < $interval; $i++) {
            $start->modify('+7 day');
            $tglWeek[] = $start->format('Y-m-d');
        }


        return $tglWeek;
    }
}
