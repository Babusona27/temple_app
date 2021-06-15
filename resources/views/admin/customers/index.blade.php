@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Users <small>Listing All The Users...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li class="active">Users</li>
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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 form-inline" id="contact-form">
                                    <form name='registration' id="registration" class="registration" method="get" action="{{url('admin/customers/filter')}}">
                                        <input type="hidden" value="{{csrf_token()}}">
                                        {{--<div class="input-group-btn search-panel ">--}}
                                        <div class="input-group-form search-panel ">
                                            <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy">
                                                <option value="" selected disabled hidden>Filter By</option>
                                                <option value="Name" @if(isset($filter)) @if ($filter=="Name" ) {{ 'selected' }} @endif @endif>{{ trans('labels.Name') }}</option>
                                                <option value="E-mail" @if(isset($filter)) @if ($filter=="E-mail" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Email') }}</option>
                                                <option value="Phone" @if(isset($filter)) @if ($filter=="Phone" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Phone') }}</option>
                                                {{--<option value="Address" @if(isset($filter)) @if ($filter=="Address" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Address') }}</option>
                                                
                                                <option value="Postcode" @if(isset($filter)) @if ($filter=="Postcode" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Postcode') }}</option>
                                                <option value="City" @if(isset($filter)) @if ($filter=="City" ) {{ 'selected' }}@endif @endif>{{ trans('labels.City') }}</option>
                                                <option value="State" @if(isset($filter)) @if ($filter=="State" ) {{ 'selected' }}@endif @endif>{{ trans('labels.State') }}</option>
                                                <option value="Country" @if(isset($filter)) @if ($filter=="Country" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Country') }}</option>--}}
                                            </select>
                                            <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" @if(isset($parameter)) value="{{$parameter}}" @endif>
                                            <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                            @if(isset($parameter,$filter)) <a class="btn btn-danger " href="{{url('admin/customers/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                        </div>
                                    </form>
                                    <div class="col-lg-4 form-inline" id="contact-form12"></div>
                                </div>
                                <div class="box-tools pull-right">
                                    <a href="{{ url('admin/customers/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if (session('update'))
                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong> {{ session('update') }} </strong>
                            </div>
                            @endif

                                @if (count($errors) > 0)
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
                                            <th>@sortablelink('id', trans('labels.ID') )</th>
                                            <th>User Type</th>
                                            <th>Full Name </th>
                                            <th>Email </th>
                                            <th>{{ trans('labels.Phone') }} </th>
                                            <th>Status</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($customers['result']))
                                        @foreach ($customers['result'] as $key=>$listingCustomers)
                                        <tr>
                                            <td>{{ $listingCustomers->id }}</td>

                                            <td>
                                                @if($listingCustomers->user_type==1)
                                                <!-- <span class="badge badge-info"> -->
                                                    Temple
                                                <!-- </span> -->
                                                @elseif($listingCustomers->user_type==2)
                                                <!-- <span class="badge badge-warning"> -->
                                                    Member
                                                <!-- </span> -->
                                                @endif
                                            </td>

                                            <td>{{ $listingCustomers->first_name }} {{ $listingCustomers->last_name }}</td>
                                            <td>{{ $listingCustomers->email }}</td>
                                            <td>
                                                {{ $listingCustomers->phone }}
                                            </td>
                                            <td>
                                                @if($listingCustomers->status==1)
                                                <span class="badge bg-green">
                                                    {{ trans('labels.Active') }}
                                                </span>
                                                @elseif($listingCustomers->status==0)
                                                <span class="badge bg-light-grey">
                                                    {{ trans('labels.InActive') }}
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" data-placement="bottom" title="{{ $listingCustomers->first_name }} {{ $listingCustomers->last_name }}" href="{{ URL::to('admin/customers/edit/'.$listingCustomers->id)}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                
                                                <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteCustomerFrom" users_id="{{ $listingCustomers->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if (count($customers['result']) > 0)
                                <div class="col-xs-12 text-right">
                                    {{--'vendor.pagination.default'--}}
                                    {{--{{$customers['result']->links()}}--}}
                                    {!! $customers['result']->appends(\Request::except('page'))->render() !!}
                                </div>
                                @endif
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

        <!-- deleteCustomerModal -->
        <div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteCustomerModalLabel">{{ trans('labels.Delete') }}</h4>
                    </div>
                    {!! Form::open(array('url' =>'admin/customers/delete', 'name'=>'deleteCustomer', 'id'=>'deleteCustomer', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                    {!! Form::hidden('action', 'delete', array('class'=>'form-control')) !!}
                    {!! Form::hidden('users_id', '', array('class'=>'form-control', 'id'=>'users_id')) !!}
                    <div class="modal-body">
                        <p>{{ trans('labels.DeleteCustomerText') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content notificationContent">

                </div>
            </div>
        </div>

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
