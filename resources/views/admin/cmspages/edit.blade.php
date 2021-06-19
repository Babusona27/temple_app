@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> CMS Pages <small>Edit CMS Page...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/cmspages/display')}}"> CMS Pages</a></li>
                <li class="active">Edit CMS Page</li>
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
                            <h3 class="box-title">Edit CMS Page </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit News</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            @if( count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">{{ trans('labels.Error') }}:</span>
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            {!! Form::open(array('url' =>'admin/cmspages/update', 'method'=>'post', 'class' => 'form-horizontal form-validate' )) !!}

                                            <input type="hidden" name="cms_page_id" value="{{ $cmsPageDetails->cms_page_id }}">

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="cms_page_title" class="form-control field-validate" value="{{ $cmsPageDetails->cms_page_title }}">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter CMS Page Title.</span>
                                                        <span class="help-block hidden">Please enter CMS Page Title.</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <textarea id="editor1" name="cms_page_Content" class="form-control"  rows="10" cols="80">{{ $cmsPageDetails->cms_page_Content }}</textarea>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter CMS Page Description.</span>
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select class="form-control" name="cms_page_status">
                                                            <option value="1" @if($cmsPageDetails->cms_page_status==1) selected @endif >{{ trans('labels.Active') }}</option>
                                                            <option value="0" @if($cmsPageDetails->cms_page_status==0) selected @endif>{{ trans('labels.Inactive') }}</option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Active status will be displayed on user side.</span>
                                                    </div>
                                                </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/cmspages/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>

                                            <!-- /.box-footer -->
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
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
    <script type="text/javascript">
       $(function() {     
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
@endsection
