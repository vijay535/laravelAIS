@extends('layouts.app')

@section('content')
<style type="text/css">
	.error{font-size: 14px;
    color: red;}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
				<form action="{{ URL('companies') }}" style="display: inline-block;">
                    <button class="btn btn-danger m-1">{{ __('Companies') }}</button>
                </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if ($message = Session::get('success'))
				        <div class="alert alert-success">
				            <p>{{ $message }}</p>
				        </div>
			     	@endif
                    <form action="{{ URL('companies', [$datafind->id]) }}" method="post" enctype="multipart/form-data">
                    	@method('PUT')
                    	@csrf
                    	
					  <div class="form-group">
					    <label for="name">Name:</label>
					    <input type="text" class="form-control" name="name" 
					    value="{{ $datafind ->name }}">
					    @if($errors->has('name'))
						    <div class="error">{{ $errors->first('name') }}</div>
						@endif
					  </div>
					  <div class="form-group">
					    <label for="email">Email:</label>
					    <input type="email" class="form-control" name="email" value="{{ $datafind ->email }}">
					    @if($errors->has('email'))
						    <div class="error">{{ $errors->first('email') }}</div>
						@endif
					  </div>
					  <div class="form-group">
					    <label for="email">Website URL:</label>
					    <input type="text" class="form-control" name="weburl" value="{{ $datafind ->website_url }}">
					    @if($errors->has('weburl'))
						    <div class="error">{{ $errors->first('weburl') }}</div>
						@endif
					  </div>
					  <div class="form-group">
					    <label for="email">Upload Logo:</label>
					    <input type="file" class="form-control" name="companylogo">
					  </div>
					  
					  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

