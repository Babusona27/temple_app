

@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Gallery') }}<small>{{ trans('labels.Gallery') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <!-- <li class="active">{{ trans('labels.ImageSize') }}</li> -->
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('labels.Gallery') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ url('admin/gallery/addGallery')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                            
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                    <br>
                                        @if (session('success'))
                                        <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> {{ session('success') }} </strong>
                                        </div>
                                        @endif
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                        <div class="row">
                                        @if(isset($result['galleryData']))
                                            @foreach($result['galleryData'] as $gallery)
                                                <!-- <div class="col-xs-4 col-md-2 margin-bottomset">
                                                <a class=""> {{$gallery->gallery_name}}</a>
                                                    <div class="thumbnail thumbnail-imges">
                                                    @if($gallery->image_id == "")
                                                        <p>No image uploaded</p>
                                                        @else
                                                        <img class="test_image" src="{{asset($gallery->path)}}" alt="...">
                                                        @endif
                                                    </div>
                                                    <a class="btn btn-block btn-primary"  href="{{url('admin/gallery/add')}}/{{$gallery->gallery_id}}"> @lang('labels.ViewAllImages')</a>
                                                </div> -->
                                                
                                            @endforeach
                                        @endif
                                        <div class="col-xs-12">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID </th>
                                                        <th>Title</th>
                                                        <th>Description </th>
                                                        <th>{{ trans('labels.Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($result['galleryData']))

                                                        @foreach($result['galleryData'] as $key=>$gallery)
                                                        <tr>
                                                            <td>{{$key+1}}</td>

                                                            <td>{{$gallery->gallery_name}}</td>

                                                            <td>{{$gallery->gallery_dec}}</td>
                                                            
                                                            <td>
                                                                <a data-toggle="tooltip" data-placement="bottom" href="{{url('admin/gallery/add')}}/{{$gallery->gallery_id}}" class="badge bg-light-blue">Add Items</a>
                                                                <a data-toggle="tooltip" data-placement="bottom" href="{{url('admin/gallery/editGallery')}}/{{$gallery->gallery_id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteGalleryFrom" gallery_id="{{ $gallery->gallery_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="4">{{ trans('labels.NoRecordFound') }}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                          
                                        </div>
                                        </div>
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

    <div class="modal fade" id="deleteGalleryModal" tabindex="-1" role="dialog" aria-labelledby="deleteGalleryModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteGalleryModalLabel">{{ trans('labels.Delete') }}</h4>
                    </div>
                    {!! Form::open(array('url' =>'admin/gallery/deleteGallery', 'name'=>'deleteGallery', 'id'=>'deleteGallery', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                    {!! Form::hidden('action', 'delete', array('class'=>'form-control')) !!}
                    {!! Form::hidden('gallery_id', '', array('class'=>'form-control', 'id'=>'gallery_id')) !!}
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Gallery?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@endsection
