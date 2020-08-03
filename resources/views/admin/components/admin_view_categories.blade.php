<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home" style="color:black; font-size:18px; font-family:verdana;">Categories</a></li>
  <li><a data-toggle="tab" href="#menu1" style="color:black; font-size:18px; font-family:verdana;">Save More Care More Categories</a></li>
  <li><a data-toggle="tab" href="#menu2" style="color:black; font-size:18px; font-family:verdana;">Covid 19 Essential Categories</a></li> 
</ul><br>

<div class="tab-content">  
  <div id="home" class="tab-pane fade in active">
    <div class="box"> 
      <div class="box-header"> 
        <h3 class="box-title" style="float:left;">View Categories</h3>
        <!--<a href="{{url('add-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Categories</a> -->
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
                @if($r->type == 0) 
                <a href="{{url('edit-categories/'.$r->categories_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
                <!--<a href="{{url('delete-categories/'.$r->categories_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fas fa-trash"></i></a>-->
                @elseif($r->type == 2)
                <a href="{{url('edit-save-more-categories/'.$r->categories_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
                @endif
                @if($r->status == 1)
                <a href="{{ url('toggle-categories-status/0/'.$r->categories_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
                @else
                <a href="{{ url('toggle-categories-status/1/'.$r->categories_id) }}" class="btn btn-success btn-xs">Activate</a>
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
  </div>
  <div id="menu1" class="tab-pane fade">
    <div class="box"> 
      <div class="box-header"> 
        <h3 class="box-title" style="float:left;">View Save More Care More Categories</h3>
        <!-- <a href="{{url('add-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Categories</a>  -->
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
            @foreach($save_more_category as $r)
            <tr>
              <td>{{$count++}}</td>
              <td><img src="{{asset($r->image)}}" width="100px"></td>  
              <td>{{$r->category_name}} </td>  
              <td>{{$r->title}} </td>  
              <td> 
                <a href="{{url('edit-save-more-categories/'.$r->categories_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a> 
                @if($r->status == 1)
                <a href="{{ url('toggle-categories-status/0/'.$r->categories_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
                @else
                <a href="{{ url('toggle-categories-status/1/'.$r->categories_id) }}" class="btn btn-success btn-xs">Activate</a>
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
  </div>
  <div id="menu2" class="tab-pane fade">
    <div class="box"> 
      <div class="box-header"> 
        <h3 class="box-title" style="float:left;">View Covid 19 Essential Categories</h3>
        <!-- <a href="{{url('add-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Categories</a>  -->
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
            @foreach($covid_category as $r)
            <tr>
              <td>{{$count++}}</td>
              <td><img src="{{asset($r->image)}}" width="100px"></td>  
              <td>{{$r->category_name}} </td>  
              <td>{{$r->title}} </td>  
              <td>
                <a href="{{url('edit-covid-categories/'.$r->categories_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a> 
                @if($r->status == 1)
                <a href="{{ url('toggle-categories-status/0/'.$r->categories_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
                @else
                <a href="{{ url('toggle-categories-status/1/'.$r->categories_id) }}" class="btn btn-success btn-xs">Activate</a>
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
  </div> 
</div>


