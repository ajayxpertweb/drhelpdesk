<style>
   
/*Classes added*/
 .sp{margin: 25px 0px 7px 0px;}
 .title-wrap{
    margin-top: 0px;
}
.title-sub {
    font-size: 15px;
    line-height: 18px;
    color: #999a9b;
    letter-spacing: 1.5px;
}
.h1-style {
    font-size: 60px;
    line-height: 50px;
    font-weight: bold;
    margin-bottom: 0;
}
.title-wrap h2 + .title-decor {
    margin-top: 24px;
}
.title-wrap h2 + .title-decor2 {
    margin-top: 24px;
}
.title-decor {
    height: 3px;
    width: 54px;
    background-color: #1d99b5;
}
.title-decor2 {
    height: 3px;
    width: 54px;
    background-color: #1d99b5;
   margin: 0 auto;
}
.txtp{
   text-align:justify;
   margin-top:2%
   
}
.f-img{    border-radius: 100%;
    width: 180px;
    height: 180px;
   border:1px solid #ccc}
.txt-f{
   text-align:center;
   margin-top:2%;
}
.ph{    color: #1d99b5;
font-size:20px;
}  
.sec{margin-top: 0px;}
hr {
    margin-top: 2rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);

}
.rb{    border-right: 1px solid #ccc;}
.why{background: #b7aeae40;
    border: 1px solid #ccc;
    padding: 23px 20px;
    box-shadow: 1px 10px 10px 1px #ccc;
   }
</style>
<div class="site__body">
   <div class="sp">
      <div class="container ">
@foreach($blog as $blogdata)
   <div class="row sec">
      <div class="col-md-6">
         <div class="title-wrap">
            <h2 class="h1-style">{{$blogdata->blog_title}}</h2>
            <div class="title-decor"></div>
         </div>
         <div class="txtp">
            {!! ($blogdata->blog_description) !!} </div>

      </div>
      <div class="col-md-6">
         <div class="title-wrap">
            <img src="{{asset($blogdata->blog_image)}}" class="image-responsive abt-img" alt="abt">
         </div>
      </div>
   </div>
   <hr>
</hr>
@endforeach
</div>
</div>
</div>