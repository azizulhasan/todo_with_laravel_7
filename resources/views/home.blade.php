@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div> --}}



            <div class="card">
                <div class="card-header">Image Upload</div>
               <x-alert>
                  <p>image will go here.</p>
               </x-alert>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="/upload">
                        @csrf
                        <input class="form-control" name="pic" type="file">
                        <input class="form-control" type="submit" value="submit">
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
