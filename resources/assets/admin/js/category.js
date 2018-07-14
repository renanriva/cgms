/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {



    var categoryPage = $('#page_category');

    if(categoryPage.length > 0) {

        var jsTitle = $('.js-title');
        var jsSelectType = $('#select-type');
        var jsSelectLabel = $('#select-label');
        var jsSelectSubLabel = $('#select-sublabel');
        var jsKnowledgeLabel = $('#select-knowledge');

        var optionLoading = '<option value="loading">Loading...</option>';

        console.log('title: ', jsTitle.text());

        insertType();
        function insertType() {

            $('.btn-save-type').click(function () {

                var data = {
                    title : $('#title').val(),
                    type: 'type'
                };

                $.ajax({
                    method: 'post',
                    url : '/admin/categories/insert',
                    data: data
                }).done(function (response, textStatus, xhr) {

                    // console.log(response);
                    location.reload();

                }).fail(function (errors, textStatus, errorThrown) {
                    console.log(error);
                });



            });


        }


        if (jsTitle.text() !== 'type'){
            loadType();
        }

        function loadType() {

            jsSelectType.html(optionLoading);

            $.ajax({
                method: 'get',
                url: '/admin/categories/type/list',
            }).done(function (response, textStatus, xhr) {

                renderSelect(jsSelectType, response.types);

                $('#select-type option:first').trigger('change');


            }).fail(function (erors, textStatus, errorThrown) {

            });


        }
        
        changeTypes();
        function changeTypes() {

            $('#select-type').on('change', function () {

                var jsLabelsTable = $('#label-table');
                clearTable(jsLabelsTable);

                jsSelectLabel.html('<option value="loading">Loading...</option>');

                $.ajax({
                    method: 'get',
                    url: '/admin/categories/label/'+this.value,
                }).done(function (response, textStatus, xhr) {

                    if (jsTitle.text() === 'sublabel' || jsTitle.text() === 'knowledge' || jsTitle.text() === 'subject'){
                        // get label list and show

                        jsSelectLabel.attr('disabled', true);

                        renderSelect(jsSelectLabel, response.labels);

                        $('#select-label option:first').trigger('change');

                    } else if (jsTitle.text() === 'label'){

                        renderTable(jsLabelsTable, response.labels);

                    }

                }).fail(function (errors, textStatus, errorThrown) {


                }).always(function () {
                   jsSelectLabel.removeAttr('disabled');
                });

            });
        }


        changeLabels();
        function changeLabels() {

            /**
             * Get sublabel list
             */

            $('#select-label').on('change', function () {

                var jsLabelsTable = $('#sublabel-table');
                clearTable(jsLabelsTable);

                $.ajax({
                    method: 'get',
                    url: '/admin/categories/sublabel/'+this.value,
                }).done(function (response, textStatus, xhr) {


                    if (jsTitle.text() === 'sublabel'){
                        // get label list and show
                        renderTable(jsLabelsTable, response.labels);

                    } else if (jsTitle.text() === 'knowledge' || jsTitle.text() ==='subject'){

                        renderSelect(jsSelectSubLabel, response.labels);

                        $('#select-sublabel option:first').trigger('change');

                    }


                }).fail(function (errors, textStatus, errorThrown) {

                }).always(function () {

                });

            });
        }

        changeSubLabel();
        function changeSubLabel() {

            $('#select-sublabel').on('change', function () {

                var jsLabelsTable = $('#knowledge-table');
                clearTable(jsLabelsTable);
                /**
                 * Get Knowledge List
                 */

                $.ajax({
                    method: 'get',
                    url: '/admin/categories/knowledge/'+this.value,
                }).done(function (response, textStatus, xhr) {

                    if (jsTitle.text() === 'knowledge') {
                        // get label list and show

                        renderTable(jsLabelsTable, response.labels);

                    } else if (jsTitle.text() === 'subject') {

                        renderSelect(jsKnowledgeLabel, response.labels);
                        $('#select-knowledge option:first').trigger('change');

                    }

                }).fail(function (errors, textStatus, errorThrown) {


                }).always(function () {
                        // jsSelectLabel.removeAttr('disabled');
                });

            });

        }


        changeKnowledge();
        function changeKnowledge() {

            $('#select-knowledge').on('change', function () {

                var jsLabelsTable = $('#subject-table');
                clearTable(jsLabelsTable);
                /**
                 * Get Subject List
                 */

                $.ajax({
                    method: 'get',
                    url: '/admin/categories/subject/'+this.value,
                }).done(function (response, textStatus, xhr) {

                    if (jsTitle.text() === 'subject') {
                        // get label list and show
                        renderTable(jsLabelsTable, response.labels);
                    }

                }).fail(function (errors, textStatus, errorThrown) {


                }).always(function () {
                    // jsSelectLabel.removeAttr('disabled');
                });

            });

        }
        
        function renderSelect(select, data) {

            select.html('');
            $.each(data, function (key, value) {

                select.append(getOption(value));

            });

        }
        function getOption(item) {

            return '<option value="'+item.id+'">'+item.title+'</option>';
        }

        function renderTable(table, data) {

            table.html('');

            $.each(data, function (key, value) {

                var buttons = '<td class="text-right"> <div class="btn-group">'+
                    '<button type="button" class="btn btn-edit-type btn-sm btn-flat btn-default">Edit</button>' +
                    '<button type="button" data-id="'+value.id+'" class="btn btn-remove btn-sm btn-flat btn-default">Remove</button></div></td>';

                var row = '<tr id="row_type_'+value.id+'"><td>'+value.id+'</td><td>'+value.title+'</td><td>'+buttons+'</td></tr>';

                table.append(row);

            });

        }

        function clearTable(table) {
            table.html('');
        }

        removeItem();
        function removeItem() {

            categoryPage.on('click', '.btn-remove', function (e) {

                e.preventDefault();

                var id = $(this).attr('data-id');
                $('#row_type_'+id).addClass('warning');

                $.ajax({
                    method: 'delete',
                    url: '/admin/categories/delete/'+id
                }).done(function (response, textStatus, xhr) {

                    if (xhr.status === 204){

                        $('#row_type_'+id).remove();

                    }
                }).fail(function (errors) {

                });

                console.log('id ', id);

            });
        }
    }



});