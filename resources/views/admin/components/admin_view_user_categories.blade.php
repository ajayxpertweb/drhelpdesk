
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View User Categories</h3>
    <a href="{{url('add-user-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add User Categories</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Image</th>   
          <th>Categories</th>   
          <th>Title</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($category as $r)
        <tr>
          <td>{{$count++}}</td>
          <td><img src="{{asset($r->image)}}" width="100px"></td>  
          <td>{{$r->category_name}} </td>  
          <td>{{$r->title}} </td>  
          <td>
            <a href="{{url('edit-user-categories/'.$r->categories_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-user-categories/'.$r->categories_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
              <a href="{{ url('toggle-user-categories-status/0/'.$r->categories_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-user-categories-status/1/'.$r->categories_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
           
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Image</th>   
          <th>Categories</th>   
          <th>Title</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 