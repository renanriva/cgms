@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.user.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_user">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.user.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary" id="btn-create-user">
                            <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive" id="user-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.user.table.id') }}</th>
                                <th>{{ __('lms.page.user.table.first_name') }}</th>
                                <th>{{ __('lms.page.user.table.email') }}</th>
                                <th>{{ __('lms.page.user.table.role') }}</th>
                                <th>{{ __('lms.page.user.table.status') }}</th>
                                <th>{{ __('lms.page.user.table.creation_type') }}</th>
                                <th>{{ __('lms.page.user.table.created_at') }}</th>
                                <th width="220">{{ __('lms.page.user.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>

        </div>

        @include('lms.admin.user.edit_modal')
        @include('lms.admin.user.reset_password')
        @include('lms.admin.parts.modal_delete')

    </div>

@stop