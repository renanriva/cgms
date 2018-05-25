/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    console.log('registration approval');


    searchCourses();
   function searchCourses() {

       var search_pending_approval_length = $('#search-pending-approval').length;

       if(search_pending_approval_length > 0) {

           console.log('load courses');

           $('#pending-table .btn-approve-confirm').click(function () {

               var id = $(this).attr('data-id');
               console.log('id ', id);

               if ($('.js-approve-check-'+id).is(':checked') === false){

                   $('#row-'+id).find('.js-td-is-approved').find('.checked').addClass('text-red');

                   alert('Please check to approve');

                   return 0;
               }

               var table = $('#pending-table');

               $.ajax({
                  url: '/admin/registration/'+id+'/update/approve',
                   method:'post',
                   data: {
                      is_approved: true
                   }
               }).done(function (response, textStatus, jqxhr) {

                   console.log('response ', response);

                   if (jqxhr.status == 200){


                       var isApproved = '<i class="fa fa-check"></i> Yes <br/>'
                       +'<small><i class="fa fa-clock-o"></i> '+response.registration.approval_time+'</small>';
                       table.find('#row-'+id).find('.js-td-is-approved').html(isApproved);
                       table.find('#row-'+id).find('.js-td-approved-by').html(response.adminUser);
                   }


               }).fail(function (jqXhr, textStatus, errorThrown) {

               });
           });



           var searchPendingApproval = $('#search-pending-approval');

           //select 2
           searchPendingApproval.select2({
               // dropdownParent: modal,
               ajax: {
                   url: '/admin/course/search/ajax',
                   dataType: 'json',
                   delay: 250,
                   data: function (params) {
                       var query = {
                           search: params.term,
                           type: 'public'
                       };

                       console.log('query ', query);

                       // Query parameters will be ?search=[term]&type=public
                       return query;
                   },
                   processResults: function (data) {
                       // Tranforms the top-level key of the response object from 'items' to 'results'
                       console.log('data process ', data);
                       return {
                           results: data.items
                       };
                   }
                   // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
               },
               width: 'resolve',
               minimumResultsForSearch: 20,
               minimumInputLength: 1, // only start searching when the user has input 3 or more characters
               maximumInputLength: 20 // only allow terms up to 20 characters long
           });

       }
   }


    /**
     * Close Delete Modal
     */
    var deleteModal = $('#delete-modal').length;

    if (deleteModal){

        $('#delete-modal .btn-close').click(function () {
            var table = $('.table');
            $(table).find('tr').removeClass('danger')
                                .removeClass('warning');
        });
    }

});