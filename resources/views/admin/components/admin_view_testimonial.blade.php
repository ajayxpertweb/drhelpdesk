
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Testimonial</h3>
    <a href="{{url('add-testimonials')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Testimonial</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>User Details</th>   
          <th>Image</th>  
          <th>Description</th> 
          <th>Rating</th>  
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($testimonial as $r)
        <tr>
          <td>{{$count++}}</td>
          <td><b>User Name</b>: {{$r->name}}<br>
              <b>User Position</b>: {{$r->position}}
           </td>  
          <td><img src="{{ url($r->image) }}" style="width: 80px;"></td> 
          <td>{!!$r->description!!} </td>   
          <td>{{$r->rating}} </td>   
          <td>
            <a href="{{url('edit-blogs/'.$r->testimonials_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-blogs/'.$r->testimonials_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
              <a href="{{ url('toggle-blogs-status/0/'.$r->testimonials_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-blogs-status/1/'.$r->testimonials_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
           
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>User Details</th>   
          <th>Image</th>  
          <th>Description</th> 
          <th>Rating</th>  
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 