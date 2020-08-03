<aside class="main-sidebar"> 
    <section class="sidebar">
        <ul class="sidebar-menu">   
           <!--  <li class="header">MAIN NAVIGATION</li>  -->
            <li class="treeview">
                <a href="{{ url('admin') }}">
                <i class="fa fa-pie-chart"></i><span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
            </li>
            <li class="treeview"> 
                <a href="{{ url('/') }}">
                <i class="fa fa-pie-chart"></i><span>Visit Website</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Categories<span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('view-sub-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Sub Categories<span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('view-user-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Categories<span>
                        </a>
                    </li> 
                    <li>
                        <a href="{{url('view-user-sub-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Sub Categories<span>
                        </a>
                    </li>   
                </ul>
            </li> 

            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Sub Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-sub-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Sub Categories<span>
                        </a>
                    </li>  
                </ul>
            </li> 

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage User Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-user-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Categories<span>
                        </a>
                    </li> 
                    <li>
                        <a href="{{url('view-user-sub-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Sub Categories<span>
                        </a>
                    </li>   
                </ul>
            </li>  -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Banners</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-banner')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Banners<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Coupons</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-coupon')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Coupons<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span> Manage User Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-user-details')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Details<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Language</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-language')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Language<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span> Manage Vendor(Test)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-vendors')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Vendor<span>
                        </a>
                    </li>  
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-male"></i>
                    <span> Manage Delivery Boy</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-delivery-boy')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Delivery Boy<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Blogs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-blogs')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Blog<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Product</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-product')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Product<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span> Manage Location</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-location')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Location<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Testimonials</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-testimonials')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Testimonials<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Packages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-packages')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Packages<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Brand</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-brand')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Brand<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Order</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-order')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Order<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Social Icon</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('edit-social-icon')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Social Icon<span>
                        </a>
                    </li>  
                </ul>
            </li> 
        </ul>
    </section><!-- /.sidebar -->
</aside> 