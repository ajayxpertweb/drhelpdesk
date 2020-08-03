
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Product</h3>
    <a href="{{url('add-product')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Product</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Price</th>   
          <th>Special Price</th>   
          <th>Top Selling Product</th>   
          <th>Featured Product</th>  
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1;?>
        @foreach($product as $r)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->product_name}} </td> 
          <td>{{$r->price }} </td>  
          <td>{{$r->special_price }} </td>  
          <td>{{$r->top_selling_product}} </td>  
          <td>{{$r->featured_product}} </td>   
          <td>
            <a href="{{url('edit-product/'.$r->products_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-product/'.$r->products_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
           
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Price</th>   
          <th>Special Price</th>   
          <th>Top Selling Product</th>   
          <th>Featured Product</th>  
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 