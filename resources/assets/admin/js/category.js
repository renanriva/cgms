/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {



    var categoryPage = $('#page_category');

    if(categoryPage.length > 0) {
        console.log('Category page');

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

    }

});