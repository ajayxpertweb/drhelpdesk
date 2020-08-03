
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Location</h3>
    <a href="{{url('add-location')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Location</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Location Name</th>   
          <th>Location Code</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($category as $r)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->location_name}} </td>  
          <td>{{$r->location_code}} </td>  
          <td>
            <a href="{{url('edit-location/'.$r->locations_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-location/'.$r->locations_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
            <a href="{{ url('toggle-location-status/0/'.$r->locations_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
            <a href="{{ url('toggle-location-status/1/'.$r->locations_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
            
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Location Name</th>   
          <th>Location Code</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>  