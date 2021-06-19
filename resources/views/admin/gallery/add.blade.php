@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add Gallery <small>Add Gallery...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/gallery/display')}}"><i class="fa fa-users"></i>  Listing All Gallerys</a></li>
            <li class="active">Add Gallery</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add Gallery </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="box box-info">
                              
                            <br>
                            @if (session('update'))
                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong> {{ session('update') }} </strong>
                            </div>
                            @endif

                            @if (count($errors) > 0)
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{$errors->first()}}
                            </div>
                            @endif
                            @endif

                            <div class="box-body">
                              {!! Form::open(array('url' =>'admin/gallery/addGallery', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                              <hr>
                              <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Title') }} </label>
                                <div class="col-sm-10 col-md-4">
                                  {!! Form::text('gallery_name',  '', array('class'=>'form-control field-validate', 'id'=>'gallery_name')) !!}
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter Title</span>
                                  <span class="help-block hidden">Please enter Title</span>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }} </label>
                                <div class="col-sm-10 col-md-4">
                                  {!! Form::textarea('gallery_dec',  '', array('class'=>'form-control field-validate', 'id'=>'gallery_dec', 'rows' => 2, 'cols' => 40)) !!}
                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter Description</span>
                                  <span class="help-block hidden">Please enter Description</span>
                                </div>
                              </div>

                              
                              <div class="box-footer text-center">
                                  <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                  <a href="{{ URL::to('admin/gallery/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                              </div>

                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
