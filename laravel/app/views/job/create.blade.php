@extends('layout')

@section('title')Create Job @stop

@section('head')
{{ HTML::style('assets/css/datepicker.css') }}
@stop

@section('body')

<p class="bg-warning" style="color:#fff;">
    @foreach($errors->all() as $error)
        {{ $error }}<br />
    @endforeach
</p>

{{ Form::open(array('route' => 'job.store', 'method' => 'POST', 'class'=>'form-horizontal')) }}
    <div class="form-group">
        <label class="col-sm-3 control-label">Title</label>
        <div class="col-sm-9">
            {{ Form::text('title', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Salary</label>
        <div class="col-sm-9">
            {{ Form::text('salary', null, array('class'=>'form-control', 'placeholder'=>'$')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">City</label>
        <div class="col-sm-9">
            {{ Form::text('city', null, array('class'=>'form-control', 'placeholder'=>'City or Location')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Description</label>
        <div class="col-sm-9">
            {{ Form::textarea('description', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Job Offer Period</label>
        <div class="col-sm-9 input-daterange input-group" id="datepicker">
            <span class="input-group-addon">from</span>
            {{ Form::text('start_date', null, array('class' => 'startdatepicker form-control', 'placeholder' => 'DD-MM-YYYY','data-date-format' => 'dd-mm-yyyy')) }}
            <span class="input-group-addon">to</span>
            {{ Form::text('end_date', null, array('class' => 'startdatepicker form-control', 'placeholder' => 'DD-MM-YYYY','data-date-format' => 'dd-mm-yyyy')) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <input class="btn btn-primary btn-block" type="submit" value="Add">
        </div>
    </div>
{{ Form::close() }}
@stop

@section('script')
{{ HTML::script('assets/js/bootstrap-datepicker.js') }}
<script type="text/javascript">
$('.input-daterange').datepicker({
    format: "dd-mm-yyyy",
    weekStart: 1,
    // startDate: "today",
    todayBtn: "linked",
    todayHighlight: true
});
</script>
@stop