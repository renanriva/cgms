@extends('adminlte::page')

@include('lms.admin.parts.title')


@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="row" id="page_course_create">
        <div class="col-lg-12 col-md-12 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => 'table-responsive' ])

                @slot('box_title')
                    Create Course
                @endslot

                @slot('box_tools')@endslot

{{--                    @include('lms.admin.category.'.str_replace('admin/categories/', '', Request::path() ))--}}


                @slot('box_footer')@endslot

            @endcomponent

        </div>
    </div>


@stop