@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">E-Mail-Empfang für neue Termine</div>

            <form method="post" action="{!! url('receive_mail') !!}">
            {{ csrf_field() }}
                <div class="panel-body" style="padding: 9px;">

                    <div class="checkbox">
                        <label for="receive_mail">
                            <input type="checkbox" id="receive_mail" name="receive_mail" {!! $receiveMailSettings == true ? 'checked' : '' !!}>
                            Über neue Termine per E-Mail benachrichtigen
                        </label>
                    </div>
                </div>

                <div class="panel-footer">
                    <button type="submit" id="submitButton" class="btn btn-primary" disabled>Einstellung speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#receive_mail').click(function() {
            $('#submitButton').prop('disabled', false);
        });
    });
</script>
@endsection
