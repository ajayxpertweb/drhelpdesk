
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Coupon</h3>
    <a href="{{url('add-coupon')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Coupon</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Code</th>  
          <th>Amount</th>   
          <th>Type</th>   
          <th>From</th>   
          <th>To</th>   
          <th>No Of Uses</th> 
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($coupon as $r)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->copoun_name}} </td>   
          <td>{{$r->copoun_code}} </td>  
          <td>{{$r->amount}} </td>  
           <td>
              @if($r->type == 'fixed')
                Fixed
              @else
                Percentage Basis
              @endif 
            </td>  
          <td>{{$r->from  }} </td>  
          <td>{{$r->to }} </td>  
          <td>{{$r->no_of_uses}} </td>   
          <td>
            <a href="{{url('edit-coupon/'.$r->coupons_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-coupon/'.$r->coupons_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
              <a href="{{ url('toggle-coupon-status/0/'.$r->coupons_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-coupon-status/1/'.$r->coupons_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
           
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
         <th>Sr. No.</th>
          <th>Name</th>   
          <th>Code</th>  
          <th>Amount</th>   
          <th>Type</th>   
          <th>From</th>   
          <th>To</th>   
          <th>No Of Uses</th> 
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 