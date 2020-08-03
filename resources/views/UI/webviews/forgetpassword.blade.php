 
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
                        <form action="{{url('submit')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                          {{csrf_field()}} 
                          <input type="hidden" name="email" value="{{ $forms }}"> 
                          <div class="form-group">
                              <label>	New Password:</label>
                              <input type="password" class="form-control"  placeholder="Enter new Password" name="password" required>
                          </div>
                          <div class="form-group">
                            <label>Confirm Password:</label>
                            <input type="password" class="form-control"  placeholder="Enter Confirm Password" name="cnf_password" required>
                          </div> <br>
                          <div class="box-footer">
                              <button type="submit" class="btn btn-md btn-primary">Update</button>
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

  