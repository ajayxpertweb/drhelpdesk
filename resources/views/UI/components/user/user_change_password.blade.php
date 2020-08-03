<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Change Password </span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="block">
	<div class="container">
		@if(session('msg') != null)
            <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('msg')}}
            </div>
        @endif
		<div class="row">
			@include('UI/components/user/user_sidebar')
			<div class="col-12 col-lg-9 mt-4 mt-lg-0">
				<div class="change-password">								
					<div class="card">
						<div class="card-header">
							<h5>Change Password</h5>
						</div>
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-7 col-xl-6">
								<!-- <div class="form-group">
									<label for="password-current">Current Password</label>
									<input type="password" class="form-control" id="password-current" placeholder="Current Password">
								</div>
								<div class="form-group">
									<label for="password-new">New Password</label>
									<input type="password" class="form-control" id="password-new" placeholder="New Password">
								</div>
								<div class="form-group">
									<label for="password-confirm">Reenter New Password</label>
									<input type="password" class="form-control" id="password-confirm" placeholder="Reenter New Password">
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary mt-3">Change</button>
								</div> -->
								<form  method="post" action="{{ url('change-password') }}">
                   					{{ csrf_field() }}
									<div class="form-group">
										<label>Current Password</label>
										<input type="password" name="old_pwd" class="form-control" placeholder="Current Password"required>
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input type="password" class="form-control" name="new_pwd" placeholder="New Password" required>
									</div>
									<div class="form-group">
										<label>Reenter New Password</label>
										<input type="password" class="form-control" name="cnf_pwd" placeholder="Reenter New Password" required>
									</div>
									<div class="submit-section">
										<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>