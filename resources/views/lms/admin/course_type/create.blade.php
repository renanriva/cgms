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

    <div class="row" id="page_product_create">
        <div class="col-lg-6 col-md-8 col-sm-12">

            @include('lms.admin.course_type.create_form')

        </div>

        @isset($type)
            <div class="col-lg-6 col-md-8 col-sm-12">

                @include('lms.admin.course_type.create_modality')

            </div>
        @endisset
    </div>

    @isset($type)
        <div class="row" >
            <div class="col-lg-12 col-md-12 col-sm-12">
                @include('lms.admin.course_type.modality_table')
            </div>
        </div>
    @endisset

@stop