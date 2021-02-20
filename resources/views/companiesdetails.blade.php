@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
				<form action="companies" style="display: inline-block;">
                    <button class="btn btn-danger m-1">{{ __('Companies') }}</button>
                </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="companies/create" style="float: right;">
					 <button class="btn btn-success">{{ __('Add') }}</button>
					</form>

					@if ($message = Session::get('success'))
				        <div class="alert alert-success">
				            <p>{{ $message }}</p>
				        </div>
			     	@endif
                    <table class="table table-bordered">
					    <thead>
					      <tr>
					        <th>Sn.</th>
					        <th>Name</th>
					        <th>Email</th>
					        <th>Website</th>
					        <th>Logo</th>
					        <th>Action</th>
					      </tr>
					    </thead>
					    <tbody>
					    <?php $sr=1; foreach ($companies as $row){ ?>
					      <tr>
					        <td>{{ $sr }}</td>
					        <td>{{ $row->name }}</td>
					        <td>{{ $row->email }}</td>
					        <td>{{ $row->website_url }}</td>
					        <td> <img src="public/images/{{ $row->logo }}" style="width: 100px;"> </td>
					        <td>
					        	<form action="companies/{{ $row->id }}/edit">
								 	<button class="btn btn-primary">{{ __('Edit') }}</button>
								</form>
								<form action="companies/{{ $row->id }}" method="post">
									@method('DELETE')
									@csrf
								 	<button class="btn btn-danger">{{ __('Delete') }}</button>
								</form>
					        </td>
					      </tr>
					    <?php $sr++; } ?>
					    </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

