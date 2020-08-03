
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View User Details</h3>
    <a href="{{url('add-user-details')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add User Details</a> 
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
          <th>Role</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; 
             
        ?>
        @foreach($user_detail as $r)
        <tr>
          <td>{{$count++}}</td>
            <td>@if($r->user_name != null)
                    {{$r->user_name}} 
                @endif
            </td>  
          <td>
              @if($r->image != null)
              <img src="{{ url($r->image) }}" style="width: 80px;">
             @endif
            </td> 
          <td>Email: 
          @if($r->email != null){{$r->email}}@endif<br> Mobile Nuxmber: @if($r->mobile != null){{$r->mobile}}@endif</td>  
          <td>Address: @if($r->address != null){{$r->address}}@endif<br> City: @if($r->city != null){{$r->city}}@endif <br> Pincode: @if($r->pin_code != null){{$r->pin_code}} @endif<br> State: @if($r->state != null){{$r->state}}@endif <br> Country: @if($r->country != null){{$r->country}}@endif</td>    
          <td>
            @if($r->role_id != null)
            Doctor
            @else
            Role Not Found
            @endif

          </td>
          <td>
            <a href="{{url('edit-user-details/'.$r->user_details_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-user-details/'.$r->user_details_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
            <a href="{{ url('toggle-user-details-status/0/'.$r->user_details_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
            <a href="{{ url('toggle-user-details-status/1/'.$r->user_details_id) }}" class="btn btn-success btn-xs">Activate</a>
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
          <th>Role</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 