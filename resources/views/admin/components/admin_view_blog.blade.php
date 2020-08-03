
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Blog</h3>
    <a href="{{url('add-blogs')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Blog</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Blog Title</th>   
          <th>Blog Image</th>  
          <th>Blog Description</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($blog as $r)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->blog_title}} </td>  
          <td><img src="{{ url($r->blog_image) }}" style="width: 80px;"></td> 
          <td>{{$r->blog_description}} </td>   
          <td>
            <a href="{{url('edit-blogs/'.$r->blogs_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-blogs/'.$r->blogs_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
              <a href="{{ url('toggle-blogs-status/0/'.$r->blogs_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-blogs-status/1/'.$r->blogs_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
           
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Blog Title</th>   
          <th>Blog Image</th>  
          <th>Blog Description</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 