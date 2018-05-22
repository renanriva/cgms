/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageLength = $('#page_university').length;

    if(pageLength > 0) {

        console.log('University');

        /**
         * Datepicker
         */
        $('#university-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'/admin/university/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'id', name: 'universities.id', searchable: true },
                { data: 'name', name: 'name', searchable: true},
                { data: 'created_by_name', name: 'users.created_by_name', searchable: true},
                { data: 'created_at', name: 'universities.created_by', searchable: true},
                { data :'action', searchable:false, orderable: false,}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                });
            },
        });


        var modal = $('#edit-universe-modal');

        /**
         * Create University
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-university').click(function () {

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('input').val('');

                modal.find('#btn-edit-university').text('Create');
                modal.find('#btn-edit-university').attr('data-type','create');
                modal.modal('show');

            });
        }

        showEditModal();
        function showEditModal() {

            $('#university-table').on('click','.btn-edit-university', function () {

                modal.find('.js-modal-title-edit').removeClass('hidden');
                modal.find('.js-modal-title-add').addClass('hidden');

                var data = {
                    id          : $(this).attr('data-id'),
                    name            : $(this).attr('data-university_name')
                };

                modal.find('.js-edit-university-name').val(data.name);


                modal.find('#btn-edit-university').attr('data-id', data.id);
                modal.find('#btn-edit-university').text('Update');
                modal.find('#btn-edit-university').attr('data-type','update');
                modal.modal('show');


            });

        }


        /**
         * Send data to server
         */
        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-university').click(function (e) {

                var data = {
                    id          : $(this).attr('data-id'),
                    name   : modal.find('.js-edit-university-name').val()
                };

                console.log('data ', data);

                if ( $(this).attr('data-type') ==='update'){
                    console.log('update now');
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    console.log('INSERT now');

                    insertUniversity(data);
                }

            });

        }

        /**
         *
         * @param data
         */
        function insertUniversity(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: '/admin/university/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        console.log(response.university);

                        var row = '<tr class="success"><td>'+response.university.id+'</td>' +
                            '<td>'+data.name+'</td><' +
                            'td>'+response.university.created_by_name +'</td>' +
                            '<td>'+response.university.created_at+'</td>' +
                            '<td>Actions</td></tr>';

                        $('#university-table tr:last').after(row);

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });

        }

        /**
         * Update University
         *
         * @param data
         */
        function update(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: '/admin/university/ajax/'+data.id
            };
            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {


                    if (jqXhr.status === 200) {

                        $('tr#university_id_'+data.id).each(function(){

                            $(this).find('td').eq(0).text(data.id);
                            $(this).find('td').eq(1).text(data.name);
                            $(this).find('td').eq(2).text(response.university.created_by_name);
                            $(this).find('td').eq(3).text(response.university.created_at);

                        });

                        $('tr#university_id_'+data.id).addClass('success');

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

            $('#university-table').on('click','.btn-remove', function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');

                deleteModal.find('.model-title').text('Delete University');
                deleteModal.find('.js-message').text('Are you sure to delete University ['+name+']?');
                deleteModal.find('#btn-delete-confirm').attr('data-url', '/admin/university/ajax/'+id);
                deleteModal.find('#btn-delete-confirm').attr('data-id', id);

                $('tr#university_id_'+id).addClass('danger');

                deleteModal.modal('show');

            });
        }


        deleteItem();
        function deleteItem() {

            $('#page_university  #btn-delete-confirm').click(function () {

                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#university_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');
                            $('tr#university_id_'+data.id).find('td').eq(4).text('Removing...');

                            (function () {
                                setTimeout(function(){
                                    $('tr#university_id_'+data.id).remove();
                                }, 1500)
                            })(this);
                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);

                });


            });
        }


    }


});