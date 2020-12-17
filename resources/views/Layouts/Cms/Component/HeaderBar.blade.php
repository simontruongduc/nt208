<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Route('cms.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        @if(isset($firstPage))
            <li class="active"><a href="{{url('cms/'.$firstPageUrl)}}"><i class="fa fa-dashboard"></i> {{$firstPage}}</a></li>
        @endif
        <li class="active">{{$activePage}}</li>
    </ol>
</section>