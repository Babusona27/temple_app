@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <small>{{ trans('labels.title_dashboard') }} {{$result['commonContent']['setting']['admin_version']}}</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</li>
            </ol>
        </section>
       
        <!-- Main content -->
        
        <!-- /.content -->
    </div>
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>

    <script src="{!! asset('admin/dist/js/pages/dashboard2.js') !!}"></script>
@endsection
