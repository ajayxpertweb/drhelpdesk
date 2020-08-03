<div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Social Icon</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form enctype="multipart/form-data" method="post" action="{{url('update-social-icon')}}">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$result->id}}">
      <div class="box-body"> 
        <div class="form-group">
          <label>Facebook</label>
          <input type="text" class="form-control"  name="facebook" value="{{$result->facebook}}" >
        </div> 
        <div class="form-group">
          <label>Twitter</label>
          <input type="text" class="form-control"  name="twitter" value="{{$result->twitter}}" >
        </div> 
        <div class="form-group">
          <label>Youtube</label>
          <input type="text" class="form-control"  name="youtube" value="{{$result->youtube}}" >
        </div> 
        <div class="form-group">
          <label>Instagram</label>
          <input type="text" class="form-control"  name="instagram" value="{{$result->instagram}}" >
        </div> 
        <div class="form-group">
          <label>Skype</label>
          <input type="text" class="form-control"  name="skype" value="{{$result->skype}}" >
        </div> 
      </div><!-- /.box-body --> 
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update Setting</button>
      </div>
    </form>
  </div><!-- /.box --> 
</div><!--/.col (left) -->
<script type="text/javascript">
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
  </script> 