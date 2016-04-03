@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            Es gab ein paar Probleme:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="margin-top: -7px;">
                        <a href="{!! URL::previous() !!}" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Zurück
                        </a>
                    </div>
                    <div class="center-block">
                        Neuer Termin
                    </div>
                </div>

                <form action="{!! action('AppointmentController@store') !!}" method="POST">
                    {!! csrf_field() !!}
                    <div class="panel-body">

                            <div class="form-group">
                                <label for="title">Titel</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="z. B. Geburtstag Sahra, Zahnarzt, Meeting...">
                            </div>
                            <div class="form-group">
                                <label for="description">Beschreibung</label>
                                <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Datum</label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' id="date" name="date" class="form-control" placeholder="z. B. {!! date('d.m.Y H:i') !!}"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </div>
                </form>
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
