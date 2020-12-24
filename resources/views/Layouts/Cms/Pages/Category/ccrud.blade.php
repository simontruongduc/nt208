@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    @component('Layouts.Cms.Component.HeaderBar')
        @slot('title','Admin')
        @slot('activePage','Admin')
    @endcomponent
@stop
@section('css')
<style>
    .show_data{
        position: absolute;
    }
    .show_data_input{
        visibility: "hidden"
    }
    .lable_text{
        margin: 10px
    }
    .magin_form{
        margin-top: 70px;
        margin-left: 15px;
    }
</style>
@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border row">
        <h3 class="box-title">Quick Example</h3>
        <button type="button" class="btn btn-warning margin-right-10px" id="edit">Warning</button>
    </div>
<!-- /.box-header -->
<!-- form start -->
    <form role="form">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <div>
                            <input type="email" class="form-control show_data show_data_input" id="exampleInputEmail1" placeholder="Enter email">
                            <label class="show_data lable_text" for="exampleInputEmail1">minhducz857@gmail.com</label>
                        </div>
                    </div>
                </div>
            <div class="col-xs-5">
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <div>
                        <input type="password" class="form-control show_data show_data_input" id="exampleInputPassword1 " placeholder="Password">
                        <label class="show_data lable_text" for="exampleInputEmail1">minhducz857@gmail.com</label>
                   </div>
                </div>
            </div>
            <div class="magin_form">
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input class="show_data_input" type="file" id="exampleInputFile">

                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                    <label>
                    <input type="checkbox"> Check me out
                    </label>
                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


@stop
@section('js')
<script>
    // var l = false;
    // myFunction();
    // function myFunction() {
    //     var x = document.getElementsByClassName("show_data");
    //     var y = document.getElementsByClassName("show_data1");
    //     if (l === true) {
    //         x[0].style.visibility = "visible";
    //         x[1].style.visibility = "hidden";
    //         x[2].style.visibility = "visible";
    //         x[3].style.visibility = "hidden";
    //         y[0].style.visibility = "visible";
           
    //     } else {
    //         x[0].style.visibility = "hidden";
    //         x[1].style.visibility = "visible";
    //         x[2].style.visibility = "hidden";
    //         x[3].style.visibility = "visible";
    //         y[0].style.visibility = "hidden";
    //     }
    //     l = !l;
    // }

    var click_edit = false;
    $(document).ready(function () {
        
        
        $("#edit").click(function () { 
            click_edit = !click_edit;
            if(!click_edit){
                $(".show_data_input").css({"visibility": "visible"});
                $(".lable_text").css({"visibility": "hidden"});
            }
            else{
                $(".show_data_input").css({"visibility": "hidden"});
                $(".lable_text").css({"visibility": "visible"});
            }
            
        });
        if(!click_edit){
            $(".show_data_input").css({"visibility": "hidden"});
            $(".lable_text").css({"visibility": "visible"});
            
        }
        else{
            $(".show_data_input").css({"visibility": "visible"});
            $(".lable_text").css({"visibility": "hidden"});
        }
    })
</script>
@stop
