
<div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title" style="float:left;">View Delivery Boy</h3>
      <a href="{{url('add-delivery-boy')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Delivery Boy</a> 
    </div> 
    <div class="box-body  table-responsive"> 
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sr. No.</th>
            <th>Name</th>   
            <th>Image</th>   
            <th>Contact Details</th>   
            <th>Address Details</th>   
            <th>Website Url</th>   
            <th>Description</th>   
            <th>Action</th> 
          </tr>
        </thead>
        <tbody> 
          <?php $count = 1; ?>
          @foreach($vendor as $r)
          <tr>
            <td>{{$count++}}</td>
            <td>{{$r->delivery_boy_name}} </td>  
            <td><img src="{{ url($r->logo) }}" style="width: 80px;"></td> 
            <td>Email: {{$r->email}}<br> Mobile Nuxmber: {{$r->mobile}} <br> @if($r->landline != null)Landline Nuxmber: {{$r->landline}} @endif</td>  
            <td>Address: {{$r->address}}<br> City: {{$r->city}} <br> Pincode: {{$r->pin_code}} <br> State: {{$r->state}}</td>    
            <td>
              @if($r->website_url != null)
                {{$r->website_url}}
              @else
                website Not Found
              @endif
  
            </td>
            <td> 
                {{$r->description}} 
            </td>
            <td>
              <a href="{{url('edit-delivery-boy/'.$r->id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fas fa-edit"></i></a>
              <a href="{{url('delete-delivery-boy/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fas fa-trash"></i></a>
              @if($r->status == 1)
              <a href="{{ url('toggle-delivery-boy-status/0/'.$r->id) }}" class="btn btn-danger btn-xs">Deactivate</a>
              @else
              <a href="{{ url('toggle-delivery-boy-status/1/'.$r->id) }}" class="btn btn-success btn-xs">Activate</a>
              @endif 
              
            </td>
          </tr>
          @endforeach
        </tbody> 
        <tfoot>
          <tr>
            <th>Sr. No.</th>
            <th>Name</th>   
            <th>Image</th>   
            <th>Contact Details</th>   
            <th>Address Details</th>   
            <th>Website Url</th>  
            <th>Description</th>  
            <th>Action</th> 
          </tr>
        </tfoot> 
      </table>
    </div> 
  </div> 