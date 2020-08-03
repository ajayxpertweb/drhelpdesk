<style>
		.about-us{
			text-align: center;
		}
		.about-us .icon{
		  margin-bottom: 20px;
		  width: 100%;
          text-align: center;
		}
		.about-us .icon span {
		    color: #0390b2;
		}

		.about-us .icon span {
		    font-size: 60px;
		}

		.about-us h5 {
		    text-transform: uppercase;
		    font-size: 16px;
		    margin-bottom: 10px;
		}
		.about-us p {
		    color: gray;
		}
		.bs-example{
	        margin: 20px;
	    }
	    .accordion .fa{
	        margin-right: 0.5rem;
	    }
	    .why-us{
	    	padding: 0 0 30px 110px;
		    position: relative;
		    width: auto;
	    }
	   .why-us .icon {
	    position: absolute;
	    left: 0;
	    top: -5px;
	}
	.why-us .icon span {
	    border-color: #0390b2;
	}
	.why-us .icon span {
		 background: #1d99b6;
	    display: inline-block;
	    margin-bottom: 15px;
	    border: 3px solid;
	    font-size: 30px;
	    line-height: 85px;
	    color: #fff;
	    width: 84px;
	    height: 84px;
	    text-align: center;
	    border-radius: 80px;
	    -webkit-transition: all 300ms linear;
	    -moz-transition: all 300ms linear;
	    -o-transition: all 100ms linear;
	    -ms-transition: all 300ms linear;
	    transition: all 300ms linear;
	}
	.why-us h5 {
	    font-size: 18px;
	}
	.why-us h5 a{
		color: #e2543c;
	}
	.btn:not(.btn-icon) {
	    font-size: 14px;
	    line-height: 19px;
	    padding: 8.5px 16px;
	}
	.why-us:hover .icon span {
	    -moz-transform: scale(1) rotate(360deg) translate(0);
	    -webkit-transform: scale(1) rotate(360deg) translate(0);
	    -o-transform: scale(1) rotate(360deg) translate(0);
	    transform: scale(1) rotate(360deg) translate(0);
	}
	.card {
	    background-color: #fff;
	    box-shadow: 0 1px 3px rgba(0, 0, 0, .09);
	    border: none;
	    border-radius: 0;
	    margin-bottom: 10px;
	}
</style>
@include('UI.components/home_slider')  
<div class="block-space block-space--layout--divider-sm"></div>
<section class="contact-info-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="about-us">
                    <div class="icon"> <span class="fa fa-medkit"> </span> </div>
                    <h5><a href="#" target="_blank"> Advanced Technology </a></h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis placerat urna. Nulla nulla diam, adipiscing non ornare non, commodo</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="about-us">
                    <div class="icon"><span class="fa fa-user-md"> </span> </div>
                    <h5><a href="#" target="_blank"> Healthcare Solutions </a></h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis placerat urna. Nulla nulla diam, adipiscing non ornare non, commodo</p>
                </div>
            </div>

           <div class="col-lg-4 col-md-6">
                <div class="about-us">
                    <div class="icon"><span class="fa fa-ambulance"> </span> </div>
                    <h5><a href="#" target="_blank"> 24/7 Availability </a></h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis placerat urna. Nulla nulla diam, adipiscing non ornare non, commodo</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="block-space block-space--layout--divider-sm"></div>
<section class="contact-area pb-100">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div>
                	<h2>FAQ’s</h2>
                	<div class="bs-example">
					    <div class="accordion" id="accordionExample">
					        <div class="card">
					            <div class="card-header" id="headingOne">
					                <h2 class="mb-0">
					                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i>What is the difference between lease and licence agreement?</button>									
					                </h2>
					            </div>
					            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					                <div class="card-body">
					                    <p>consectetur adipiscing elit. Cras vehicula dictum metus at interdum. Vivamus ut euismod metus. Integer a est suscipit est ultricies viverra. Mauris rhoncus nunc ut porttitor dictum. In placerat mi a fermentum consequat. Mauris neque diam, vulputate vel felis eget, faucibus consequat mi.</p>
					                </div>
					            </div>
					        </div>
					        <div class="card">
					            <div class="card-header" id="headingTwo">
					                <h2 class="mb-0">
					                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i>How ownership of property is acquired by a person?</button>
					                </h2>
					            </div>
					            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
					                <div class="card-body">
					                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
					                </div>
					            </div>
					        </div>
					        <div class="card">
					            <div class="card-header" id="headingThree">
					                <h2 class="mb-0">
					                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-plus"></i>Can a registered will be rectified or changed?</button>                     
					                </h2>
					            </div>
					            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					                <div class="card-body">
					                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div>
                	<h2>&nbsp;Why Us?</h2>
                	<div class="why-us"><div class="icon"><span class="fas fa-hospital-alt"> </span> </div><h5><a href="#" target="_blank"> Great Infrastructure </a></h5><p>Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit.</p></div>
                	<div class="why-us"><div class="icon"> <span class="fa fa-ambulance"> </span> </div><h5><a href="#" target="_blank"> 24/7 Ambulance Services </a></h5><p>Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit.</p></div>
                	<div class="why-us"><div class="icon"> <span class="fa fa-medkit"> </span> </div><h5><a href="#" target="_blank"> Cutting Edge Technology </a></h5><p>Nunc at pretium est curabitur commodo leac est venenatis egestas sed aliquet auguevelit.</p></div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="block-space block-space--layout--divider-sm"></div>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>