<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Dashboard </span>
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
                <div class="dashboard">                             
                    <div class="dashboard__orders card">
                        <div class="card-header">
                            <h5>Recent 5 Orders</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-table"> 
                            @if ($order->count()>0)
                            <div class="table-responsive-sm">
                                <table>
                                    <thead>
                                        <tr> 
                                            <th>Order Id</th>   
                                            <th>Amount</th> 
                                            <th>Order Status</th>  
                                            <th>De-Wallet Coin</th>  
                                            <th>Shipping Charge</th>  
                                            <th>Payment Details</th>  
                                            <th>Date</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order as $r) 
                                        <tr>
                                             
                                            <td>{{$r->order_id}} </td> 
                                            <td>{{$r->amount}} </td>  
                                            <td>
                                                @if($r->order_status == 1)
                                                In Procesed  
                                                @elseif($r->order_status == 6)
                                                Delivered 
                                                @endif
                                            </td> 
                                            <td>@if($r->de_wallet_coin != null)
                                                {{$r->de_wallet_coin}} 
                                                @else 
                                                {{$r->de_wallet_coin}}
                                                @endif  
                                            </td> 
                                            <td>{{$r->shipping_charge}} Rs </td> 
                                            <td><b>Payment Mode</b> : {{$r->payment_mode}} <br> 
                                                <b>Payment Id</b> : {{$r->payment_id}} <br> 
                                                <b>Payment Status</b> : {{$r->payment_status}} <br> 
                                                <b>Payment Request Id</b> : {{$r->payment_req_id}} <br> 
                                            </td>  
                                            <td>{{ date('M j, Y g:i:A', strtotime($r->created_at)) }}</td>
                                            <td>  
                                                <a href="{{url('user-order-detail/'.$r->order_id)}}" class="btn btn-sm btn-primary mr-2">View</a>
                                                <form action="{{url('shippingorder-status-update')}}" method="post">
                                                    {{csrf_field()}} 
                                                    <input type="hidden" name="order_id" value="{{$r->order_id }}" >
                                                    <input type="hidden" name="status" value="2">  
                                                    <button type="submit" class="btn btn-sm bg-danger text-white"><i class="fa fa-times"></i> Cancel</button>
                                                </form>
                                                <form action="{{url('trackorder')}}" method="post">
                                                    {{csrf_field()}} 
                                                    <input type="hidden" name="order_id" value="{{$r->order_id }}" >
                                                    <input type="hidden" name="status" value="2">  
                                                    
                                                    <button type="submit" class="btn btn-sm bg-primary text-white"> Track Order</button>
                                                </form>  
                                            </td>
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>  
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-space block-space--layout--before-footer"></div>