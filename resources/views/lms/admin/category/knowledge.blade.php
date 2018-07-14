<form class="form-horizontal"  action="{{ url('/admin/categories/knowledge') }}" method="post">

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

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Label'])
            <select class="form-control" id="select-label" name="label">
                <option disabled="">Select Option</option>
            </select>
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Sub Label'])
            <select class="form-control" id="select-sublabel" name="sublabel">
                <option disabled="">Select Option</option>
            </select>
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="submit" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> Save</button>
        @endcomponent

    </div>

</form>
@include('lms.admin.category.table')
{{--<table class="table table-responsive table-sm">--}}

    {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>Id</th>--}}
            {{--<th>Knowledge Title</th>--}}
            {{--<th width="200px" class="text-right">Action</th>--}}
        {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody id="knowledge-table">--}}
    {{--</tbody>--}}

{{--</table>--}}