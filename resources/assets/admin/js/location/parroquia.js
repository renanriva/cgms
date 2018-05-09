$(document).ready(function () {


    var page = $('#page_parroquia').length;

    if (page > 0){

        console.log('Parroquia ready');

        $('#parroquia-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'/admin/location/parroquia/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'province_name', name: 'provinces.name', searchable: true },
                { data: 'canton_name', name: 'cantons.name', searchable: true},
                { data: 'parroquia_name', name: 'parroquia.name', searchable: true},
                { data :'action', searchable:false, orderable: false}
            ],
            initComplete: function () {
                console.log('init complete ');
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                });
            },
        })
;

        var modal = $('#edit-parroquia-modal');

        parroquiaShowEditModal();
        function parroquiaShowEditModal() {

            $('#cantons-table').on('click', '.btn-edit-parroquia', function () {

                modal.find('.js-modal-title').text('Edit Parroquia');

                var data = {
                    id : $(this).attr('data-id'),
                    province_id : $(this).attr('data-province_id'),
                    name : $(this).attr('data-canton_name'),
                    capital : $(this).attr('data-canton_capital'),
                    dist_name : $(this).attr('data-canton_dist_name'),
                    dist_code : $(this).attr('data-canton_dist_code'),
                    zone : $(this).attr('data-canton_zone'),
                };


                modal.find('.js-edit-parroquia-province option[value="'+data.province_id+'"]').attr('selected', true);
                modal.find('.js-edit-parroquia-name').val(data.name);
                modal.find('.js-edit-parroquia-capital').val(data.capital);
                modal.find('.js-edit-parroquia-district').val(data.dist_name);
                modal.find('.js-edit-parroquia-dist_code').val(data.dist_code);
                modal.find('.js-edit-parroquia-zone option[value="'+data.zone+'"]').attr('selected', true);
                modal.find('#btn-edit-parroquia').attr('data-id', data.id);

                modal.find('#btn-edit-parroquia').text('Update');
                modal.find('#btn-edit-parroquia').attr('data-type','update');
                modal.modal('show');
            });
        }

        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-parroquia').click(function (e) {

                e.preventDefault();

                var data = {
                    id : $(this).attr('data-id'),
                    province_name : modal.find('.js-edit-canton-province option:selected').text(),
                    province_id : modal.find('.js-edit-canton-province option:selected').val(),
                    canton_name : modal.find('.js-edit-canton option:selected').text(),
                    canton_id : modal.find('.js-edit-canton option:selected').val(),
                    name : modal.find('.js-edit-parroquia-name').val(),
                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insertParroquia(data);
                }

            });

        }


        /**
         *
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-parroquia').click(function () {

                modal.find('.js-modal-title').text('Add New Parroquia');
                modal.find('input').val('');

                modal.find('#btn-edit-parroquia').text('Create');
                modal.find('#btn-edit-parroquia').attr('data-type','create');
                modal.modal('show');

            });
        }

        /**
         * Update data
         * @param data
         */

        function update(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: '/admin/location/parroquia/'+ data.id+'/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        $('tr#canton_id_'+data.id).each(function(){

                            $(this).find('td').eq(1).text(data.name);
                            $(this).find('td').eq(2).text(data.capital);
                            $(this).find('td').eq(3).text(data.dist_name);
                            $(this).find('td').eq(4).text(data.dist_code);
                            $(this).find('td').eq(5).text(data.zone);

                        });

                        $('tr#canton_id_'+data.id).addClass('success');

                        modal.modal('hide');

                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                alert('Error: '+errorThrown);
                console.log('error ', jqXhr);

            });
        }

        /**
         * Save data
         * @param data
         */
        function insertParroquia(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: '/admin/location/parroquia/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        var row = '<tr class="success"><td>'+data.province_name+'</td><td>'+data.canton_name+'</td><td>'
                            +data.name +'</td><td>Actions</td></tr>';

                        $('#parroquia-table tr:last').after(row);

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });

        }


        var deleteModal = $('#delete-modal');

        /**
         * Show Delete modal
         */
        showDelete();
        function showDelete() {

            $('#cantons-table').on('click','.btn-remove', function () {

                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');

                    deleteModal.find('.model-title').text('Delete Parroquia');
                    deleteModal.find('.js-message').text('Are you sure to delete Parroquia ['+name+']?');
                    deleteModal.find('#btn-delete-confirm').attr('data-url', '/admin/location/parroquia/'+id+'/ajax');
                    deleteModal.find('#btn-delete-confirm').attr('data-id', id);
                    deleteModal.modal('show');

                });
        }
        
        
        deleteItem();
        function deleteItem() {

            $('#btn-delete-confirm').click(function () {


                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#canton_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');

                            (function () {
                                setTimeout(function(){
                                    console.log('remove now');
                                    $('tr#canton_id_'+data.id).remove();
                                }, 1500)
                            })(this);
                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);

                });


            });
        }

    }// page
});