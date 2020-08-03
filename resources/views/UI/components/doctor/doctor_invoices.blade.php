<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="index.html" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Breadcrumb</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Current Page</span>
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
			@include('UI/components/doctor/doctor_sidebar')
			
			<div class="col-md-7 col-lg-8 col-xl-9">
				<h4 class="mb-4">Invoices</h4>
				<div class="card card-table">
					<div class="card-body">
					
						<!-- Invoice Table -->
						<div class="table-responsive">
							<table class="table table-hover table-center mb-0">
								<thead>
									<tr>
										<th>Invoice No</th>
										<th>Patient</th>
										<th>Amount</th>
										<th>Paid On</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0010</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient.jpg" alt="User Image">
												</a>
												<a href="#">Richard Wilson <span>#PT0016</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>450</td>
										<td>14 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0009</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient1.jpg" alt="User Image">
												</a>
												<a href="#">Charlene Reed <span>#PT0001</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>200</td>
										<td>13 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0008</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient2.jpg" alt="User Image">
												</a>
												<a href="#">Travis Trimble <span>#PT0002</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>100</td>
										<td>12 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0007</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient3.jpg" alt="User Image">
												</a>
												<a href="#">Carl Kelly <span>#PT0003</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>350</td>
										<td>11 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0006</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient4.jpg" alt="User Image">
												</a>
												<a href="#">Michelle Fairfax <span>#PT0004</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>275</td>
										<td>10 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0005</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient5.jpg" alt="User Image">
												</a>
												<a href="#">Gina Moore <span>#PT0005</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>600</td>
										<td>9 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0004</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient6.jpg" alt="User Image">
												</a>
												<a href="#">Elsie Gilley <span>#PT0006</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>50</td>
										<td>8 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0003</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient7.jpg" alt="User Image">
												</a>
												<a href="#">Joan Gardner <span>#PT0007</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>400</td>
										<td>7 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0002</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient8.jpg" alt="User Image">
												</a>
												<a href="#">Daniel Griffing <span>#PT0008</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>550</td>
										<td>6 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<a href="invoice-view.html">#INV-0001</a>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2">
													<img class="avatar-img rounded-circle" src="images/patients/patient9.jpg" alt="User Image">
												</a>
												<a href="#">Walter Roberson <span>#PT0009</span></a>
											</h2>
										</td>
										<td><i class="fas fa-rupee-sign"></i>100</td>
										<td>5 Nov 2019</td>
										<td class="text-right">
											<div class="table-action">
												<a href="invoice-view.html" class="btn btn-sm btn-success">
													<i class="far fa-eye"></i> View
												</a>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">
													<i class="fas fa-print"></i> Print
												</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- /Invoice Table -->
						
					</div>
				</div>
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->