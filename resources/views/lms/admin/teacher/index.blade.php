@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.teacher.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_student">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.teacher.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary" id="btn-create-canton">
                            <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="teacher-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.teacher.table.id') }}</th>
                                <th>{{ __('lms.page.teacher.table.security_id') }}</th>
                                <th>{{ __('lms.page.teacher.table.first_name') }}</th>
                                <th>{{ __('lms.page.teacher.table.last_name') }}</th>
                                <th>{{ __('lms.page.teacher.table.email') }}</th>
                                <th>{{ __('lms.page.teacher.table.modal_id') }}</th>
                                <th>{{ __('lms.page.teacher.table.action') }}</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>


        </div>
    </div>

{{--    @include('lms.admin.location.canton.edit_modal')--}}
    @include('lms.admin.parts.modal_delete')

@stop