<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--parent"><a href="" class="breadcrumb__item-link">Doctor</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Doctor Listing</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div> 
<!-- Page Content -->
<div class="content">
	<div class="container"> 
		<div class="row">
			
				<div class="col-md-12 col-lg-4 col-xl-3 "> 
					<!-- Search Filter -->
					<form action="{{route('doctorlist.view',[$data['parameter'][0],$data['parameter'][1]] )}}" method="post"> 
					@csrf  
					<div class="card search-filter">
						<div class="card-header">
							<h4 class="card-title mb-0">Search Filter</h4>
						</div>
						<div class="card-body">	
						    <!--
							<div class="filter-widget">
								<h4>Gender</h4>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="gender[]" value="male" {{in_array('male',$gender)?'checked':''}}>
										<span class="checkmark"></span> Male Doctor
									</label>
								</div>
								<div>
									<label class="custom_check"> 
										<input type="checkbox" name="gender[]" value="female" {{in_array('female',$gender)?'checked':''}}>
										<span class="checkmark"></span> Female Doctor
									</label>
								</div>
							</div> 
							-->
							<div class="filter-widget">
								<h4>Specialist</h4>
								 
								@foreach($data['category'] as $r1)   
									<div>
										<label class="custom_check">
											<input type="checkbox"  name="category[]" value="{{$r1->categories_id}}" {{in_array($r1->categories_id,$category)?'checked':''}}>
											<span class="checkmark"></span> {{ucfirst($r1->sub_category_name)}}
										</label>
									</div>
								@endforeach 
							</div>
							<div class="btn-search">
								<button type="submit" class="btn btn-block">Search</button>
							</div>	
						</div>
					</div>
					</form>
					<!-- /Search Filter --> 
				</div>
			
			
			<div class="col-md-12 col-lg-8 col-xl-9">

				<!-- Doctor Widget -->
				@foreach($data['doctor'] as $r)
				<div class="card">
					<div class="card-body">
						<div class="doctor-widget">
							<div class="doc-info-left">
								<div class="doctor-img">
									<a href="#">
										<img src="{{asset($r->image)}}" class="img-fluid" alt="User Image">
									</a>
								</div>
								<div class="doc-info-cont">
									<h4 class="doc-name"><a href="#">Dr. {{$r->user_name}}</a></h4>
									<p class="doc-speciality">{{$r->degree}}</p>
									<h5 class="doc-department">
										@if($r->department_icon != null)
										<img src="{{asset($r->department_icon)}}" class="img-fluid" alt="Speciality">
										@endif
										{{$r->department_name}}
									</h5>
									<div class="rating">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star"></i>
										<span class="d-inline-block average-rating">(17)</span>
									</div>
									<div class="clinic-details">
										<p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{$r->address}}  , {{$r->city}} {{$r->state}} -{{$r->pin_code}}</p>
										<ul class="clinic-gallery">
											@if($r->clinic_image_one != null)
											<li>
												<a href="{{asset($r->clinic_image_one)}}" data-fancybox="gallery">
													<img src="{{asset($r->clinic_image_one)}}" alt="Feature">
												</a>
											</li>
											@endif
											@if($r->clinic_image_two != null)
											<li>
												<a href="{{asset($r->clinic_image_two)}}" data-fancybox="gallery">
													<img src="{{asset($r->clinic_image_two)}}" alt="Feature">
												</a>
											</li>
											@endif
											@if($r->clinic_image_three != null)
											<li>
												<a href="{{asset($r->clinic_image_three)}}" data-fancybox="gallery">
													<img src="{{asset($r->clinic_image_three)}}" alt="Feature">
												</a>
											</li>
											@endif
											@if($r->clinic_image_four != null)
											<li>
												<a href="{{asset($r->clinic_image_four)}}" data-fancybox="gallery">
													<img src="{{asset($r->clinic_image_four)}}" alt="Feature">
												</a>
											</li> 
											@endif
										</ul>
									</div>
									<div class="clinic-services">
										<span>Dental Fillings</span>
										<span> Whitneing</span>
									</div>
								</div>
							</div>
							<div class="doc-info-right">
								<div class="clini-infos">
									<ul>
										<li><i class="far fa-thumbs-up"></i> 98%</li>
										<li><i class="far fa-comment"></i> 17 Feedback</li>									
										@if($r->consultation_fees != null)		
										<li><i class="far fa-money-bill-alt"></i> <span class="fas fa-rupee-sign"></span>{{$r->consultation_fees}} </li>
										@endif
									</ul>
								</div>
								<div class="clinic-booking">
									<a class="view-pro-btn" href="{{url('/doctor-details/'.$r->user_details_id)}}">View Profile</a>
									<!--<a class="apt-btn" href="#">Consult Now</a>-->
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<!-- /Doctor Widget --> 
				<div class="load-more text-center">
					<nav aria-label="Page navigation example">
					 	<ul class="pagination">  
							{{ $data['doctor']->appends($data['page'])->links() }} 
						</ul>
					</nav> 
				</div>	
			</div>
		</div>

	</div> 
</div>		
 <!-- /Page Content -->