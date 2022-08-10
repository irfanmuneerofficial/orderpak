@extends('layouts.master')

@section('page-title')
403
@endsection

@section('mainContent')
    <div class="container text-center py-5">
        <div class="p-5 cs-error-box">
            <h1> 403 </h2>
            <p> {{ ($exception->getMessage() ?: 'Forbidden') }} </p>
        </div>
    </div>
@endsection
