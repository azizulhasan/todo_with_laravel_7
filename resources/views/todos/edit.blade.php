@extends('todos.master')
@section('content')
<x-alert />
<form action="/todos/update" method="POST">
    @csrf
    <h1>What You Need To Do Next</h1>
    <div class="form-group">
    <input type="text" value="{{$todo->title}}" name="title" class="form-control">
    <input type="text" hidden value="{{$todo->id}}" name="id" >
        <input type="submit" value="update"class="form-control">
    </div>
    
</form>
<div><a href="/todos" class="btn btn-primary"> View All</a></div>
    
@endsection