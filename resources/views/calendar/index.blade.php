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
                    </div>
                    <div class="center-block">
                        {!! \Calendar\Calendar::$monthNames[intval($month)] !!} {!! $year !!}
                    </div>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered calendar">
                            <thead>
                                @foreach(\Calendar\Calendar::$weekdayNames as $weekdayName)
                                    <th>{!! $weekdayName !!}</th>
                                @endforeach
                            </thead>
                            <tbody>
                                @for($i = 0; $i < 35; $i++)
                                    @if($i % 7 == 0)
                                        <tr>
                                    @endif

                                            @if(($i+1) < $firstDay || ($i+1) > $days)
                                                <td class='not-in-month'></td>
                                            @else
                                                <td class="clickable-month {!! \Calendar\Appointment::whereDate('date', '=', $year.'-'.$month.'-'.($i-$firstDay+2))->get()->count() > 0 ? 'info' : '' !!}" data-route="{!! url('/calendar/'.$year.'/'.$month.'/'.($i-$firstDay+2)) !!}">
                                                    {!! $i-$firstDay+2 !!}
                                                    @if(\Calendar\Appointment::whereDate('date', '=', $year.'-'.$month.'-'.($i-$firstDay+2))->get()->count())
                                                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                                                              title="{!! \Calendar\Appointment::whereDate('date', '=', $year.'-'.$month.'-'.($i-$firstDay+2))->get()->count() !!} Termine"></span>
                                                    @endif
                                                </td>
                                            @endif

                                    @if(($i + 1) % 7 == 0)
                                        </tr>
                                    @endif
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-footer">
                    <ul class="pager" style="margin: 0 !important;">
                        <li class="previous">
                            <a href="{!! $previousMonthUrl !!}"><span aria-hidden="true">&larr;</span> {!! \Calendar\Calendar::$monthNames[$previousMonth] !!}</a>
                        </li>
                        <li class="next">
                            <a href="{!! $nextMonthUrl !!}">{!! \Calendar\Calendar::$monthNames[$nextMonth] !!} <span aria-hidden="true">&rarr;</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.clickable-month').on('click', function() {
            window.location = $(this).data('route');
        }) ;
    });
</script>
@endsection
