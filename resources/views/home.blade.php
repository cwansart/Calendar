@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{!! url('calendar') !!}">Aktuelle Termine</a></div>

            <div class="panel-body" style="padding: 9px;">
                @if(count(\Calendar\Appointment::upcomming()) == 0)
                    Zurzeit stehen keine Termine an.
                @endif
                @foreach(\Calendar\Appointment::upcomming() as $appointment)
                    <div class="container-fluid" style="background: {!! $appointment->user->background !!}; color: {!! $appointment->user->color !!}; margin-bottom: 5px;">
                        <div class="row" style="padding: 9px;">
                            <div class="col-xs-4">
                                <b>{!! $appointment->date !!}</b>
                            </div>
                            <div class="col-xs-8">
                                <b><a style="color:white" href="{!! url('appointments/'.$appointment->id) !!}">{!! $appointment->title !!}</a></b>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="https://github.com/SStalker/EVOS/issues">Aktuelle Issues</a></div>

            <div class="panel-body" id="current-issues" style="padding: 9px;">
                <div class="pull-right">
                    <i class="fa fa-spinner fa-pulse" style="font-size: 24px"></i>
                </div>
                Issues werden geladen...
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="https://github.com/SStalker/EVOS/commits/master">Aktuelle Commits</a></div>

            <div class="panel-body" id="current-commits" style="padding: 9px;">
                <div class="pull-right">
                    <i class="fa fa-spinner fa-pulse" style="font-size: 24px"></i>
                </div>
                Commits werden geladen...
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var userColors = JSON.parse('{!! \Calendar\User::userColors() !!}');

        // load current issues
        $.get('https://api.github.com/repos/SStalker/EVOS/issues', function(issues) {
            if(issues.length == 0) {
                $('#current-issues').html('Zurzeit sind keine Issues verfügbar.');
            } else {
                $('#current-issues').html('');
                issues.forEach(function(issue) {
                    var name = userColors[issue.user.login] ? userColors[issue.user.login].name : 'Unbekannt';
                    var background = userColors[issue.user.login] ? userColors[issue.user.login].background : '#fefefe';
                    var color = userColors[issue.user.login] ? userColors[issue.user.login].color : '#000000';
                    var box = '<div class="container-fluid" style="background: '+background+'; color: '+color+'; margin-bottom: 9px">'
                               +'<div class="row" style="padding: 9px;">'
                                 +'<div class="col-xs-4">'
                                   +'<b>'+ name +'</b>'
                                 +'</div>'
                                 +'<div class="col-xs-8">'
                                   +'<b><a style="color: '+color+'" href="'+issue.html_url+'">#'+ issue.number +' '+ issue.title +'</a></b>'
                                 +'</div>'
                               +'</div>'
                             +'</div>';
                    $('#current-issues').append(box);
                });
            }
        });

        // load current commits
        $.get('https://api.github.com/repos/SStalker/EVOS/commits', function(commits) {
            if(commits.length == 0) {
                $('#current-commits').html('Zurzeit sind keine Commits verfügbar.');
            } else {
                var i = 0;
                $('#current-commits').html('');
                commits.forEach(function(commit) {
                    if(i++ < 10) {
                        var name = userColors[commit.author.login] ? userColors[commit.author.login].name : 'Unbekannt';
                        var background = userColors[commit.author.login] ? userColors[commit.author.login].background : '#fefefe';
                        var color = userColors[commit.author.login] ? userColors[commit.author.login].color : '#000000';
                        var box = '<div class="container-fluid" style="background: '+background+'; color: '+color+'; margin-bottom: 9px">'
                                   +'<div class="row" style="padding: 9px;">'
                                     +'<div class="col-xs-3">'
                                       +'<b>'+ name +'</b>'
                                     +'</div>'
                                     +'<div class="col-xs-8">'
                                       +'<b><a style="color: '+color+'" href="'+commit.html_url+'">'+ commit.commit.message +'</a></b>'
                                     +'</div>'
                                   +'</div>'
                                 +'</div>';
                        $('#current-commits').append(box);
                    } else {
                        return;
                    }
                });
            }
        });
    });
</script>
@endsection
