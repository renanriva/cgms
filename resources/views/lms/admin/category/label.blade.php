<form class="form-horizontal"  action="{{ url('/admin/categories/label') }}" method="post">

    <div class="box-body">
        {{ csrf_field() }}

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Title'])
            <input type="text" class="form-control" id="title"
                   value="" placeholder="title" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Type'])
            <select class="form-control" id="select-type" name="type">
            </select>
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="submit" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> Save</button>
        @endcomponent

    </div>

</form>
@include('lms.admin.category.table')
{{--<table class="table table-responsive table-sm" id="">--}}

    {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>Id</th>--}}
            {{--<th>Label Title</th>--}}
            {{--<th width="200px" class="text-right">Action</th>--}}
        {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody id="labels-table">--}}

    {{--@foreach($category['labels'] as $type)--}}
        {{--<tr id="row_type_{{ $type->id }}">--}}
            {{--<td>{{ $type->id }}</td>--}}
            {{--<td>{{ $type->title }}</td>--}}
            {{--<td class="text-right">--}}
                {{--<div class="btn-group">--}}
                    {{--<button class="btn btn-edit-type btn-sm btn-flat btn-default">Edit</button>--}}
                    {{--<button class="btn btn-remove-type btn-sm btn-flat btn-default">Remove</button>--}}
                {{--</div>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}

    {{--</tbody>--}}

{{--</table>--}}