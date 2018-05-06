@extends('adminlte::page')

@section('title', env('APP_TITLE'))

@section('content_header')
    <h1>{{ __('lms.location.parroquia.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-8 col-md-10 col-sm-12 col-lg-offset-2 col-md-offset-1">

            <div class="box">
                <div class="box-header"><h3 class="box-title">{{ __('lms.location.parroquia.index.table_header') }}</h3></div>
                <div class="box-body">

                    <table class="table table-bordered" id="parroquia-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.location.parroquia.table.province_name') }}</th>
                                <th>{{ __('lms.location.parroquia.table.canton_name') }}</th>
                                <th>{{ __('lms.location.parroquia.table.parroquia') }}</th>
                                <th>{{ __('lms.location.parroquia.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>


        </div>
    </div>

@stop