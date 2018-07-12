<form class="form-horizontal"  action="#">

    <div class="box-body">
        {{ csrf_field() }}

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Title'])
            <input type="text" class="form-control" id="title"
                   value=""
                   placeholder="title" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Type'])
            <select class="form-control" id="select-type">
                @foreach($category['type'] as $type)
                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="button" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> Save</button>
        @endcomponent

    </div>

</form>
<table class="table table-responsive table-sm" id="table-modalities">

    <thead>
        <tr>
            <th>Id</th>
            <th>Label Title</th>
            <th>Type</th>
            <th width="200px" class="text-right">Action</th>
        </tr>
    </thead>
    <tbody id="type-table">

    @foreach($category['type'] as $type)
        <tr id="row_type_{{ $type->id }}">
            <td>{{ $type->id }}</td>
            <td>{{ $type->title }}</td>
            <td class="text-right">
                <div class="btn-group">
                    <button class="btn btn-edit-type btn-sm btn-flat btn-default">Edit</button>
                    <button class="btn btn-remove-type btn-sm btn-flat btn-default">Remove</button>
                </div>
            </td>
        </tr>
    @endforeach

    </tbody>

</table>
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