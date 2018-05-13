/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    console.log('Common');


    var selectProvinceLength = $('.js-select-province').length;

    if(selectProvinceLength > 0) {

        var selectProvince = $('.js-select-province');

        selectProvince.change(function () {

            var selectCanton = $('.js-select-canton');

            selectCanton.empty();
            selectCanton.attr('disabled', 'disabled');
            selectCanton.append('<option>Loading...</option>');

            var provinceId = $(selectProvince).find('option:selected').val();
            console.log('selected id ', provinceId);

            var ajaxObj = {
                method: 'get',
                url: '/admin/location/canton/ajax/'+provinceId
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        selectCanton.empty();

                        $.each(response.cantons, function (key, value) {
                            selectCanton.append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        selectCanton.attr('disabled', false);

                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);
                    selectCanton.empty();
                    selectCanton.attr('disabled', false);

            });


        });
    }


});