@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Passwort ändern</div>

            <form method="post" action="{!! url('change_password') !!}">
            {{ csrf_field() }}
                <div class="panel-body" style="padding: 9px;">

                    <div class="form-group">
                        <label for="passwordInput1">
                            Passwort
                            <input type="password" class="form-control" id="passwordInput1" name="password">
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="passwordInput2">
                            Passwort wiederholen
                            <input type="password" class="form-control" id="passwordInput2" name="password2">
                        </label>
                    </div>
                </div>

                <div class="panel-footer">
                    <button type="submit" id="submitButton" class="btn btn-primary" disabled>Passwort ändern</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        function onInputChange() {
            if($('#passwordInput1').val() === $('#passwordInput2').val()) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        }

        $('#passwordInput1').keyup(onInputChange);
        $('#passwordInput2').keyup(onInputChange);
    });
</script>
@endsection
