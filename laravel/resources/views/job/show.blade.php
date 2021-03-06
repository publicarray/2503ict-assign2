@extends('layout')

@section('title')Job Detail @stop

@section('body')
<div class="col-xs-12">
    <h2>{{{ $job->title }}}</h2>
</div>
<div class="col-xs-6 col-sm-4">
    <p><i class="glyphicon glyphicon-usd"></i> Annual Salary:</p>
    <p><i class="glyphicon glyphicon-globe"></i> City:</p>
    <p><i class="glyphicon glyphicon-briefcase"></i> Industry:</p>
    <p><i class="glyphicon glyphicon-calendar"></i> Job Offer Ends in:</p>
</div>
<div class="col-xs-6 col-sm-8">
    <p>${{{ $job->salary }}}</p>
    <p>{{{ $job->city }}}</p>
    <p>{{{ $employer->industry }}}</p>
    <time class="timeago" datetime="{{{ $end_date }}}">{{{ $job_duration }}}</time>
</div>
<div class="col-xs-12">
    <p>{{{ $job->description }}}</p>
</div>

@if(Auth::check() && Auth::user()->role == 'seeker')
    <div class="col-xs-4">
        <a href="../application/create/{{$job->id}}" class="btn btn-primary btn-block">Apply for Job</a>
    </div>
@endif

@if(Auth::check() && Auth::user()->role == 'employer')
    <div class="col-xs-4">
        <a href="{{$job->id}}/edit" class="btn btn-primary btn-block">Edit Job Offer</a>
    </div>
    <div class="col-xs-4">
    <form method="GET" action="../application" accept-charset="UTF-8">
            <input type="hidden" name="id" value="{{$job->id}}">
            <input class="btn btn-primary btn-block" type="submit" value="View Applications">
        </form>
    </div>
    <div class="col-xs-4">
        <button type="submit" class="btn btn-danger btn-block" data-toggle="modal" data-target="#{{{$job->id}}}"><span class="glyphicon glyphicon-trash"></span> Delete Job</button>
        <!-- Modal -->
        <div class="modal fade" id="{{{$job->id}}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Delete {{{$job->title}}}?</h4>
                    </div>
                    <div class="modal-body">
                        <h2>Are you sure you want to delete '{{{$job->title}}}'?</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="font-weight: 500;" class="btn btn-primary pull-right" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{$job->id}}" accept-charset="UTF-8" style="display: inline-block" class="pull-left">
                            <input name="_method" type="hidden" value="DELETE">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger" style="font-weight: 500;"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@stop

@section('script')
<script type="text/javascript" src="../../assets/js/jquery.timeago.js"></script>
<script>
$(document).ready(function() {
    $.timeago.settings.allowPast = false;
    $.timeago.settings.allowFuture = true;
    $('time.timeago').timeago();
});
</script>
@stop
