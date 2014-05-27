@extends('layout')

@section('title')All employers @stop

@section('body')

@foreach ($records as $record)
<ul>
    <li>{{{ $record->name }}}</li>
    <li>{{ link_to_route('seeker.show', 'Detail', array($record->id)) }}</li>
</ul>
@endforeach
