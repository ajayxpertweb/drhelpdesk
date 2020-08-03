<?php
    $url = $_SERVER['REQUEST_URI'];
    $exploded_url = explode("/", $url); 
    $current_url = end($exploded_url);
    $bredcrum = "";
    if($current_url=='doctor-clinic-setting') {
        $bredcrum='Clinic Setting';
    } elseif($current_url=='doctor-dashboard') {
        $bredcrum='Dashboard';
    } elseif($current_url=='doctor-review') {
        $bredcrum='Reviews';
    } elseif($current_url=='doctor-profile-setting') {
        $bredcrum='Profile Setting';
    }elseif($current_url=='doctor-change-password') {
        $bredcrum='Change Password';
    }elseif($current_url=='doctor-appointment') {
        $bredcrum='Appointment';
    } 
?>


<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<!--<li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Breadcrumb</a>
					</li>-->
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link"><?php echo $bredcrum; ?></span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>