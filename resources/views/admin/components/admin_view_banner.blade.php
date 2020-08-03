
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Banner</h3>
    <a href="{{url('add-banner')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Banner</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Image</th>   
          <th>Type</th>   
          <th>Link</th>   
          <th>Location</th>   
          <th>From</th>   
          <th>To</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($banner as $r)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->banner_name}} </td>  
          <td><img src="{{ url($r->image) }}" style="width: 80px;"></td> 
          <td>{{$r->type}} </td>  
          <td>{{$r->banner_link}} </td>  
          <td>{{$r->location }} </td>  
          <td>{{$r->from}} </td>  
          <td>{{$r->to}} </td>   
          <td>
            <a href="{{url('edit-banner/'.$r->banners_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-banner/'.$r->banners_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
              <a href="{{ url('toggle-banner-status/0/'.$r->banners_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-banner-status/1/'.$r->banners_id) }}" class="btn btn-success btn-xs">Activate</a>
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
          <th>Type</th>
          <th>Link</th> 
          <th>Location</th>   
          <th>From</th>   
          <th>To</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 