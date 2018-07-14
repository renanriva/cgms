@extends('adminlte::page')

@include('lms.admin.parts.title')


@section('content_header')
    <h1>{{ $title }} <small>Create new Course Type </small></h1>
    @component('lms.admin.components.bootstrap.breadcrumb')
        <li class=""><i class="fa fa-book"></i> Course</li>

        <li class="">
            <a href="{{ url('/admin/course-type') }}"><i class="fa fa-plus"></i> Course Type</a>
        </li>
        @if(isset($type))
        <li class="active"><i class="fa fa-pencil"></i> Edit</li>
        @else
            <li class="active"><i class="fa fa-plus"></i> create</li>
        @endif
    @endcomponent
@stop

@section('content')

    <div class="row" id="page_category">
        <div class="col-lg-6 col-md-8 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => 'table-responsive' ])

                @slot('box_title')
                    <span class="js-title">{{ str_replace('admin/categories/', '', Request::path() ) }}</span>
                @endslot

                @slot('box_tools')@endslot

                    @include('lms.admin.category.'.str_replace('admin/categories/', '', Request::path() ))

                @slot('box_footer')@endslot

            @endcomponent

        </div>
    </div>

    <style>
        .tag {
            font-size: 0.85em;
            font-weight: normal;
            padding: .3em .4em .4em;
            margin: 0 .1em;
        }
        .tag a {
            color: #bbb;
            cursor: pointer;
            opacity: 0.6;
        }
        .tag a:hover {
            opacity: 1.0
        }
        .tag .remove {
            vertical-align: bottom;
            top: 0;
        }
        .tag a {
            margin: 0 0 0 .3em;
        }
        .tag a .glyphicon-white {
            color: #fff;
            margin-bottom: 2px;
        }
    </style>

@stop