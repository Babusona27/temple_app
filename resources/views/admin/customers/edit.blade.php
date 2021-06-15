@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Edit User <small>Edit Current User...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/customers/display')}}"><i class="fa fa-users"></i> Listing All The Users</a></li>
            <li class="active">Edit User</li>
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
                        <h3 class="box-title">Edit User</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit category</h3>
                                        </div>-->
                                    <!-- /.box-header -->
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


                                    <!-- form start -->
                                    <div class="box-body">

                                        {!! Form::open(array('url' =>'admin/customers/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('customers_id', $data['customers']->id, array('class'=>'form-control', 'id'=>'id')) !!}

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">User Type </label>
                                            <div class="col-sm-10 col-md-4">
                                              <select name="user_type" id="user_type" class="form-control field-validate">
                                                <option value="">select user type</option>
                                                <option value="1" @if($data['customers']->user_type == 1)
                                                        selected
                                                        @endif >Temple</option>
                                                <option value="2" @if($data['customers']->user_type == 2)
                                                        selected
                                                        @endif >Member</option>
                                              </select>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please select user type</span>
                                              <span class="help-block hidden">Please select user type</span>
                                            </div>
                                          </div>

                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FirstName') }}* </label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('first_name', $data['customers']->first_name, array('class'=>'form-control field-validate', 'id'=>'first_name')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.FirstNameText') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.LastName') }}*</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::text('last_name', $data['customers']->last_name , array('class'=>'form-control field-validate', 'id'=>'last_name')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.lastNameText') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>                                      

                                      
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Telephone') }}</label>
                                          <div class="col-sm-10 col-md-4">
                                            {!! Form::text('phone',  $data['customers']->phone, array('class'=>'form-control field-validate phone-validate', 'id'=>'phone')) !!}
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.TelephoneText') }}</span>
                                          </div>
                                        </div>

                                        <hr>

                                      <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label">Address</label>
                                        <div class="col-sm-10 col-md-4">
                                          <textarea id="entry_street_address" name="entry_street_address" rows="4" cols="50" class="form-control field-validate">{{$data['customers']->entry_street_address}}</textarea>
                                          
                                         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                         Please enter address.</span>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label">Postcode</label>
                                        <div class="col-sm-10 col-md-4">
                                          {!! Form::text('entry_postcode', $data['customers']->entry_postcode, array('class'=>'form-control field-validate', 'id'=>'entry_postcode')) !!}
                                          
                                         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                         Please enter postcode.</span>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label">City</label>
                                        <div class="col-sm-10 col-md-4">
                                          {!! Form::text('entry_city', $data['customers']->entry_city, array('class'=>'form-control field-validate', 'id'=>'entry_city')) !!}
                                          
                                         <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                         Please enter city.</span>
                                        </div>
                                      </div>
                                                                        
                                      <hr>

                                      <div class="form-group">
                                        <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.EmailAddress') }} </label>
                                        <div class="col-sm-10 col-md-4">
                                          {!! Form::text('email',  $data['customers']->email, array('class'=>'form-control email-validate', 'id'=>'email')) !!}
                                           <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                           {{ trans('labels.EmailText') }}</span>
                                          <span class="help-block hidden"> {{ trans('labels.EmailError') }}</span>
                                        </div>
                                      </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.changePassword') }}</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::checkbox('changePassword', 'yes', null, ['class' => '', 'id'=>'change-passowrd']) !!}
                                            </div>
                                        </div>

                                        <!-- <div class="form-group password_content">-->
                                        <div class="form-group password" style="display: none">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Password') }}*</label>
                                            <div class="col-sm-10 col-md-4">
                                                {!! Form::password('password', array('class'=>'form-control ', 'id'=>'password')) !!}
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    {{ trans('labels.PasswordText') }}</span>
                                                <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}
                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="status">
                                                    <option @if($data['customers']->status == 1)
                                                        selected
                                                        @endif
                                                        value="1">{{ trans('labels.Active') }}</option>
                                                    <option @if($data['customers']->status == 0)
                                                        selected
                                                        @endif
                                                        value="0">{{ trans('labels.Inactive') }}</option>
                                                </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.StatusText') }}</span>

                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }} </button>
                                            <a href="{{ URL::to('admin/customers/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
@endsection
