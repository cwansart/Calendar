<h1>{!! $appointment->user->name !!} hat einen Termin angelegt!</h1>
<h2>{!! $appointment->title !!}</h2>
<table>
    <tr>
        <td><b>Wann:</b></td>
        <td>{!! $appointment->date !!}</td>
    </tr>
    @if(!empty($appointment->description))
        <tr>
            <td colspan="2">{!! $appointment->description !!}</td>
        </tr>
    @endif
</table>
<br>
<span style="font-size: 80%; color: #e6e6e6;">
    <i>
        Wenn du keine Benachrichtigungen mehr bekommen möchtest, kannst du das
        <a href="{!! url('receive_mail') !!}">in den Einstellungen ändern</a>.
    </i>
</span>