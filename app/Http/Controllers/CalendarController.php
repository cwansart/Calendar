<?php

namespace Calendar\Http\Controllers;

use Calendar\Appointment;
use Calendar\Calendar;
use Illuminate\Http\Request;

use Calendar\Http\Requests;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year = null, $month = null)
    {
        $year = $year == null ? date('Y') : $year;
        $month = $month == null ? date('m') : $month;
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDay = date('N',mktime(0, 0, 0, intval($month), 1, intval($year)));

        $nextMonthUrl = $month == 12 ? url('/calendar/'.($year+1).'/01') :
                                       url('/calendar/'.$year.'/'.($month+1));
        $previousMonthUrl = $month == 1 ? url('/calendar/'.($year-1).'/12') :
                                          url('/calendar/'.$year.'/'.($month-1));
        $nextMonth = $month == 12 ? 01 : $month+1;
        $previousMonth = $month == 1 ? 12 : $month-1;

        return view('calendar.index')
            ->with('month', $month)
            ->with('year', $year)
            ->with('firstDay', $firstDay)
            ->with('days', $days)
            ->with('nextMonthUrl', $nextMonthUrl)
            ->with('previousMonthUrl', $previousMonthUrl)
            ->with('nextMonth', $nextMonth)
            ->with('previousMonth', $previousMonth);
    }

    public function get($year, $month, $day)
    {
        $appointments = Appointment::whereDate('date', '=', $year.'-'.$month.'-'.$day)->orderBy('date', 'ASC')->get();
        return view('calendar.get')
            ->with('appointments', $appointments)
            ->with('year', $year)
            ->with('month', $month)
            ->with('day', $day);
    }

}
