@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="margin-top: -7px;">
                        <a href="{!! url('/appointments/create') !!}" class="btn btn-default">
                            <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Neuer Termin
                        </a>
                        <a href="{!! url('/calendar/'.$year.'/'.$month) !!}" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Zurück
                        </a>
                    </div>
                    <div class="center-block">
                        {!! $day !!}. {!! \Calendar\Calendar::$monthNames[intval($month)] !!} {!! $year !!}
                    </div>
                </div>

                <div class="panel-body">
                    @if($appointments->count() == 0)
                        Für den {!! $day !!}. {!! \Calendar\Calendar::$monthNames[intval($month)] !!} {!! $year !!} wurden noch keine Termine eingetragen.
                    @endif
                    @foreach($appointments as $appointment)

                        <div class="container-fluid" style="background: {!! $appointment->user->background !!}; color: {!! $appointment->user->color !!}; margin-bottom: 5px;">
                            <div class="row" style="padding: 9px;">
                                <div class="col-xs-3">
                                    <b>{!! \Carbon\Carbon::parse($appointment->date)->format('H:i') !!}</b>
                                </div>
                                <div class="col-xs-9">
                                    <b>{!! $appointment->title !!}</b>
                                </div>
                            </div>
                            <div class="row" style="padding: 0 9px 9px 9px;">
                                <div class="col-xs-3">
                                    <i>Von {!! $appointment->user->name !!}</i>
                                </div>
                                <div class="col-xs-9">
                                    {{ str_limit($appointment->description, $limit = 150, $end = '...') }}
                                        <a href="/appointments/{!! $appointment->id !!}">[ Weiterlesen ]</a>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

