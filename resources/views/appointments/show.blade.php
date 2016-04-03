@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="margin-top: -7px;">
                        <a href="{!! url('appointments/ics/'.$appointment->id) !!}" class="btn btn-default">
                            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> .ics-Download
                        </a>
                        <a href="{!! URL::previous() !!}" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Zurück
                        </a>
                    </div>
                    <div class="center-block">
                        <b>{!! $appointment->title !!}</b>
                        am {!! $appointment->date !!}
                    </div>
                </div>

                <div class="panel-body">
                    @if(strlen($appointment->description) > 0)
                        {!! $appointment->description !!}
                    @else
                        {!! $appointment->title !!}
                    @endif
                </div>

                <div class="panel-footer">
                    @if($appointment->user == \Illuminate\Support\Facades\Auth::user())
                    <div class="pull-right" style="margin-top: -7px;">
                        <a href="{!! URL::previous() !!}" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Termin Löschen
                        </a>
                    </div>
                    @endif

                    Erstellt von: {!! $appointment->user->name !!}
                </div>
            </div>
        </div>
    </div>
<script>
    $(function() {
        $('#datetimepicker2').datetimepicker({
            locale: 'de'
        });

       $('.clickable-month').on('click', function() {
           window.location = $(this).data('route');
       }) ;
    });
</script>
@endsection
