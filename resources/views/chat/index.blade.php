

@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default" style="width:100%;height:300px;overflow:scroll;" >
                <div class="card-header">
                  Featured
                </div>
                <div class="cord-body">
                    <ul class="list-unstyled">
                        <li class="py-2">
                            <strong>hasan</strong>
                            essage
                        </li>
                      </ul>
                </div>
            </div>
            <input type="text" name="message" placeholder="Enter Your Message" class="form-control">
                <span class="text-muted">user is typing.....</span>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">
                    Active Users
                </div>
                <div class="card-body">
                    <ul>
                        <li class="py-2">hasan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection