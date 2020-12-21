@extends('Layouts.Web.Pages.app')
@section('title','Sản phẩm')
@section('css')
    <link rel="stylesheet" href="css/topbar.min.css">
@stop
@section('content')
    @component('Layouts.Web.Components.banner')
        @slot('pageName','Sản phẩm')
        @slot('activeName','Sản phẩm')
    @endcomponent
    @component('Layouts.Web.Components.category')
        @slot('categories',$categories)
        @slot('producers',$producers)
        @slot('products',$products)
        @slot('paginate',$paginate)
    @endcomponent
@stop
@section('js')
    <script>
      $(document).ready(function () {
        var url = $(location).attr('href')
        var asc = url.search('asc')
        var desc = url.search('desc')
        if (asc > 1) {
          $('#sort').val('0')
        }
        if (desc > 1) {
          $('#sort').val('1')
        }
      })

      $('#sort').change(function () {
        var sort = document.getElementById('sort').value
        var url = $(location).attr('href')
        if (sort) {
          url = url + '?sortBy[price]=asc'
        } else if (!sort) {
          url = url + '?sortBy[price]=desc'
        }
        window.location.href = url
      })
    </script>
@stop