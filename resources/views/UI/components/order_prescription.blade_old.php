
<br>
<br>
<br>
<br>
<br>
<br>
<form action="{{url('/prescription-submit')}}" method="post" enctype="multipart/form-data">
	@csrf
	<input type="file" name="prescription_image">
	<button type="submit" class="btn btn-info">Submit</button>
</form>
<br>
<br>
<br>
<br>
<br>
<br>