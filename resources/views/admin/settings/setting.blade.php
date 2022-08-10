@extends('admin.layouts.master')
@section('page-title')
Settings
@endsection
@section('mainContent')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Setting</h1>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <section class="content">
        @if (session('invalid'))
            <div class="alert alert-danger" role="alert">
                {{ session('invalid') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <form action="/admin/settings/process" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Script Text</label>
                        <textarea rows="10" class="form-control @error('script_text') is-invalid @enderror" name="script_text" >{{ $settings->script_text ?? old('settings->script_text') }}</textarea>
                        @error('script_text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>              
            <button type="submit" class="btn btn-primary pull-right">Update</button>
            <div class="clearfix"></div>
        </form>
    </section>
</div>

@endsection