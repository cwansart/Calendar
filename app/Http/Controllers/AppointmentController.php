<?php

namespace Calendar\Http\Controllers;

use Calendar\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Calendar\Http\Requests;
use Calendar\Http\Requests\AppointmentRequest;
use Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('calendar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $request['user_id'] = Auth::id();
        $date = Carbon::createFromFormat('d.m.Y H:i', $request->get('date'));
        Appointment::create($request->all());
        return redirect(url('/calendar/'.$date->year.'/'.$date->month));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.show')
            ->with('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getIcs($id)
    {
        $appointment = Appointment::findOrFail($id);
        $ics = "BEGIN:VCALENDAR\n".
               "VERSION:2.0\n".
               "PROID:".url('appointments/'.$id)."\n".
               "UID:".$id."@cal\n".
               "METHOD:REQUEST\n".
               "BEGIN:VEVENT\n".
               "SUMMARY:".$appointment->title."\n".
               "DESCRIPTION:".$appointment->content."\n".
               "CLASS:PUBLIC\n".
               "DTSTART:".$appointment->icsDate."Z\n".
               "DTEND:".$appointment->icsDate."Z\n".
               "DTSTAMP:".$appointment->icsDate."Z\n".
               "END:VEVENT\n".
               "END:VCALENDAR";

        return response()->make($ics)
            ->header('Content-type', 'text/calendar; charset=utf-8')
            ->header('Content-disposition', 'attachment; filename="cal'.$id.'.ics"');
    }

}
