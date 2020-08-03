<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Order Success Page</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="block">
	<div class="container">
		<div class="row"> 
			<div class="col-12 col-lg-9 mt-4 mt-lg-0"> 					
					<div class="card"> 
						<div class="card-divider"></div>
						<div class="card-body card-body--padding--1">
							<div class="row no-gutters">
								<div class="col-5 col-lg-3 col-xl-4">
									<i class="icon-check"></i>
                                    <h3>Thank You</h3>
                                    <p>Your Order has been booked Successfully!</p>
                                    <p><strong>Order ID: {{$booking->order_id}}</strong></p>
                                    <a href="{{url('user-invoice/'.$booking->order_id)}}" class="btn btn-primary view-inv-btn">View Invoice</a>
								</div>
							</div>
						</div>
					</div> 
			</div>
		</div>
	</div>
</div>