@extends('main_master') 
	@section('main_content') 
<div class="block-space block-space--layout--after-header"></div>
<div class="block">
	<div class="container container--max--lg">
		@if(session('msg') != null)
			<div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{session('msg')}}
			</div>
		@endif
		<div class="row justify-content-center">  
			<div class="col-md-6 d-flex mt-4 mt-md-0">
				
				<div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4">
					<div class="card-body card-body--padding--2">
						<h3 class="card-title">Forget Password</h3>
						<form method="POST" action="#" role="form" enctype="multipart/form-data">
                            @csrf 
							<div class="form-group">
								<label for="signup-email">Email address</label>
								<input id="signup-email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="customer@example.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> 
								@error('email')
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
							</div>  
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-3">Submit</button>
							</div>
						</form> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
@stop 
