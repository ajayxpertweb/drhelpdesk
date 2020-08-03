
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Packages</h3>
    <a href="{{url('add-packages')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Packages</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Price</th>   
          <th>Discount</th>   
          <th>Packages</th>  
          <th>Short Discription</th>  
          <th>Long Discription</th>  
          <th>Image</th>  
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($vendor as $r)
          <?php
             $result = $r->package;                       
             $package_id = explode(",", $result); 
          ?>
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->package_name}} </td> 
          <td>{{$r->package_cost }} </td>  
          <td>{{$r->offer_discount }} </td>  
          <td>
            @foreach($package_id as $r1)
              <?php
                 $package = DB::table('products')->where('products_id', $r1)->pluck('product_name')->first(); 
              ?>
              {{$package }},
            @endforeach 
             <td>{{$r->short_disc }} </td>  
          <td>{{$r->long_disc }} </td>  
          </td>  
          <td><img width="150px" src="{{asset($r->image)}}"></td>   
          <td>
            <a href="{{url('edit-packages/'.$r->id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-packages/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
              <a href="{{ url('toggle-packages-status/0/'.$r->id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
              <a href="{{ url('toggle-packages-status/1/'.$r->id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
           
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Price</th>   
          <th>Discount</th>   
          <th>Packages</th>   
          <th>Short Discription</th>  
          <th>Long Discription</th>
          <th>Image</th>  
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 