@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> CMS Pages <small>Listing All CMS Pages...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
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
                            {{--<h3 class="box-title">{{ trans('labels.ListingAllNews') }} </h3>--}}

                            <div class="col-lg-6 form-inline">

                                {{-- <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/news/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Name')}}</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/news/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form> --}}
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/cmspages/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <br>

                            <div class="row">
                                <div class="col-xs-12">

                                    @if ($errors != null)
                                        @if($errors->any())
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($cmsPagesList != null)
                                            @foreach ($cmsPagesList as  $key=>$cmsPage)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $cmsPage->cms_page_title }}</td>
                                                    <td>@php echo substr($cmsPage->cms_page_Content,0,40)."..."; @endphp</td>
                                                    <td>
                                                        @if($cmsPage->cms_page_status==1)
                                                        <strong class="badge bg-green">{{trans('labels.Active')}} </strong>
                                                        @else
                                                        <strong class="badge bg-light-grey">{{trans('labels.InActive')}} </strong>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{ URL::to('admin/cmspages/edit/'.$cmsPage->cms_page_id)}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deletecmspage" cms_page_id="{{ $cmsPage->cms_page_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">{{ trans('labels.NoRecordFound') }}.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                   
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- deleteNewsModal -->
            <div class="modal fade" id="deleteCmsPagesModal" tabindex="-1" role="dialog" aria-labelledby="deleteCmsPagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteCmsPagesModalLabel">Delete This CMS Page</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/cmspages/delete', 'name'=>'deleteCmsPages', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('cms_page_id',  '', array('class'=>'form-control', 'id'=>'cms_page_id')) !!}
                        <div class="modal-body">
                            <p>Delete</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deletefaq">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
