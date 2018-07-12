@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $title }}</h1>
    @component('lms.admin.components.bootstrap.breadcrumb')
        <li class=""><i class="fa fa-book"></i> Master Course</li>
        <li class="active"><i class="fa fa-list"></i> Category</li>
        <li class="">
            <a href="{{ url('/admin/categories/create') }}"><i class="fa fa-plus"></i> Create</a>
        </li>
    @endcomponent
@stop

@section('content')

    <div class="row" id="page_course_type">

        <div class="col-lg-12 col-md-12 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => 'table-responsive' ])

                @slot('box_title')
                    All Course Type
                @endslot

                @slot('box_tools')
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                @endslot

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th width="20px">ID</th>
                            <th width="30px">Sort</th>
                            <th width="350px">Title</th>
                            <th width="350px">Modality</th>
                            <th width=100px">Is Active</th>
                            <th width="100px">Updated By</th>
                            <th width="120px">Updated at</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>


                </table>

                @slot('box_footer')
                        {{--{{ $courseTypes->appends(request()->query())->links() }}--}}
                @endslot
            @endcomponent

        </div>

    </div>

@stop