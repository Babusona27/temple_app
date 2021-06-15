<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">{{ trans('labels.navigation') }}</li>
        <li class="treeview {{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a href="{{ URL::to('admin/dashboard/this_month')}}">
            <i class="fa fa-dashboard"></i> <span>{{ trans('labels.header_dashboard') }}</span>
          </a>
        </li>
      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->view_media == 1){
      ?>
      <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span>{{ trans('labels.media') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} ">
              <a href="{{url('admin/media/add')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.media') }} </span>
              </a>
          </li>

          <li class="treeview {{ Request::is('admin/media/display') ? 'active' : '' }} {{ Request::is('admin/addimages') ? 'active' : '' }} {{ Request::is('admin/uploadimage/*') ? 'active' : '' }} ">
              <a href="{{url('admin/media/display')}}">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> {{ trans('labels.Media Setings') }} </span>
              </a>
          </li>
        </ul>
      </li>

      <?php } ?>
      
          
      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->customers_view == 1){
      ?>
        <li class="treeview {{ Request::is('admin/customers/display') ? 'active' : '' }}  {{ Request::is('admin/customers/add') ? 'active' : '' }}  {{ Request::is('admin/customers/edit/*') ? 'active' : '' }} {{ Request::is('admin/customers/address/display/*') ? 'active' : '' }} {{ Request::is('admin/customers/filter') ? 'active' : '' }} ">
          <a href="{{ URL::to('admin/customers/display')}}">
            <i class="fa fa-users" aria-hidden="true"></i> <span>User Management</span>
          </a>
        </li>
      <?php } ?>


      
      <?php
            //if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reports_view == 1){
          ?>
        {{--<li class="treeview {{ Request::is('admin/statscustomers') ? 'active' : '' }} {{ Request::is('admin/outofstock') ? 'active' : '' }} {{ Request::is('admin/statsproductspurchased') ? 'active' : '' }} {{ Request::is('admin/statsproductsliked') ? 'active' : '' }} {{ Request::is('admin/lowinstock') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
  <span>{{ trans('labels.link_reports') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ Request::is('admin/customers-orders-report') ? 'active' : '' }} "><a href="{{ URL::to('admin/customers-orders-report')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_customer_orders_total') }}</a></li>
            
            

          </ul>
        </li>--}}
      <?php //} ?>
     
  
       
     
      <?php

        //if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manage_admins_view == 1){
      ?>

         {{--<li class="treeview {{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }} {{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
  <span> {{ trans('labels.Manage Admins') }}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="{{ Request::is('admin/admins') ? 'active' : '' }} {{ Request::is('admin/addadmins') ? 'active' : '' }} {{ Request::is('admin/editadmin/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/admins')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_admins') }}</a></li>
            <li class="{{ Request::is('admin/manageroles') ? 'active' : '' }} {{ Request::is('admin/addadminType') ? 'active' : '' }} {{ Request::is('admin/editadminType/*') ? 'active' : '' }}"><a href="{{ URL::to('admin/manageroles')}}"><i class="fa fa-circle-o"></i> {{ trans('labels.link_manage_roles') }}</a></li>
          </ul>
        </li>--}}
        <?php 
        //}
        ?>
        

        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
