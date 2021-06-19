@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add New Item <small>{{ trans('labels.ListingAllImage') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i>
                    {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li class="active">Add New Item</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.ListingAllImage') }} </h3>
                       
                        <div style="margin-right:125px;"class="box-tools pull-left">
                        
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
                                data-target="#addImageModal">Add New Image</button>
                        </div>
                        <div class="box-tools pull-left">
                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
                                data-target="#addVideoModal">Add New Video</button> 

                        </div>
                        
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                @if (count($errors) > 0)
                                @if($errors->any())
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    {{$errors->first()}}
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>

                        <style>
                        article, aside, figure, footer, header, hgroup,
                        menu, nav, section { display: block; }
                        ul { list-style: none; }
                        ul li { display: inline; }
                        img { border: 2px solid white; cursor: pointer; }
                        img:hover { border: 2px solid black; }
                        img.hover { border: 2px solid black; }
                        .margin-bottomset .thumbnail { margin-bottom: 0; }
                        </style>
                        </head>



                        <form class="hidden" action="" method="" id="images_form">
                            <input id="images" type="hidden" name="images" value=""/>
                        </form>
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Item</th>
                                            <th>Description </th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($result['allimages']))
                                        @foreach($result['allimages'] as $key=>$image)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                @if(isset($image->id))
                                                <td><img class="test_image" image_id="{{$image->id}}" src="{{asset($image->path)}}" alt="..."></td>
                                                @else
                                                <td>
                                                <iframe width="150" height="150" src="{{$image->video_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                
                                                @endif
                                                <td>
                                                {!! Form::open(array('url' =>'admin/gallery/updateGalleryItemDec', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                                                {!! Form::hidden('gallery_items_id',$image->gallery_items_id, array('class'=>'form-control')) !!}
                                                {!! Form::hidden('gallery_id', $result['galleryId'], array('class'=>'form-control')) !!}
                                                {!! Form::textarea('gallery_items_dec', $image->gallery_items_dec, array('class'=>'form-control', 'rows' => 2, 'cols' => 40)) !!}
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                {!! Form::close() !!}
                                                
                                                </td>
                                                
                                                <td>
                                                    <!-- <a data-toggle="tooltip" data-placement="bottom" href="" class="badge bg-light-blue" id="editGalleryItemFrom" gallery_item_id="{{ $image->gallery_items_id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                                                    <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteGalleryItemFrom" gallery_item_id="{{ $image->gallery_items_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <p id="demo"></p>

            <!-- /.col -->
        </div>
        <!-- /.row -->

        

<script>

</script>
        <!-- Main row -->
        <div id="addImageModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add File Here</h4>
                    </div>
                    <div class="modal-body">
                        <p>Click or Drop Images in the Box for Upload.</p>
                        <form action="{{ url('admin/gallery/uploadimage') }}" enctype="multipart/form-data"
                            class="dropzone " id="my-dropzone">
                            {{ csrf_field() }}
                            <input type="text" name="gallery_id" value="{{$result['galleryId']}}" hidden>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" disabled="disabled" id="compelete"
                            data-dismiss="modal">Done</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="addImageModaldetail" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h3 class="modal-title text-primary" id="addImageModalLabel">Image Details</h3>
                    </div>

                    {{-- {!! Form::open(array('url' =>'admin/deleteimage', 'method'=>'post', 'class' => 'form-horizontal',
                    'enctype'=>'multipart/form-data', 'onsubmit' => 'return ConfirmDelete()')) !!} --}}
                    <form class="form-horizontal" action="{{url('admin/deleteimage')}}" method="post" enctype="multipart/form-data" onsubmit = return ConfirmDelete() >
                    <div class="image_embed">

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="myDeleteImage"
                            data-toggle="modal">Delete</button>
                        {{--<a href="#addImageModal2" role="button" type="submit" class="btn btn-danger" data-toggle="modal">Delete</a>--}}
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>


                    </div>
                    </form>
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>

        <div id="addImageModal2" class="modal modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog"
            aria-labelledby="addImageModalLabel" aria-hidden="true" data-modal-parent="#addImageModal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmation!!</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are sure to delete It!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="myDeleteImage"
                            data-toggle="modal">Delete</button>
                        <button class="btn btn-default" data-dismiss="modal" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteGalleryItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteGalleryItemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteGalleryItemModalLabel">{{ trans('labels.Delete') }}</h4>
                    </div>
                    {!! Form::open(array('url' =>'admin/gallery/deleteGalleryItem', 'name'=>'deleteGalleryItem', 'id'=>'deleteGalleryItem', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                    {!! Form::hidden('action', 'delete', array('class'=>'form-control')) !!}
                    {!! Form::hidden('gallery_item_id', '', array('class'=>'form-control', 'id'=>'gallery_item_id')) !!}
                    {!! Form::hidden('gallery_id', $result['galleryId'], array('class'=>'form-control')) !!}
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Item?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('labels.Delete') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Main row -->
        <div id="addVideoModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Link Here</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('admin/gallery/uploadItemVideo') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-validate">
                            {{ csrf_field() }}
                            <input type="text" name="gallery_id" value="{{$result['galleryId']}}" hidden>
                            
                            <input type="text" name="video_link" value=""  class="form-control field-validate">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="modal fade" id="editGalleryItemModal" tabindex="-1" role="dialog" aria-labelledby="editGalleryItemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editGalleryItemModalLabel">{{ trans('labels.Edit') }}</h4>
                    </div>
                    {!! Form::open(array('url' =>'admin/gallery/editGalleryItem', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                    
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Item?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('labels.Edit') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div> -->
        
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
