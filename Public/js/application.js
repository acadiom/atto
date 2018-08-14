
// Variable to hold request and results
var request;
var results;

$( window ).load(function() {
    // Run code
    console.log("document loaded");
    search(true);
});

$(document).on({
    ajaxStart: function() { HoldOn.open({ theme:"sk-cube-grid" }); },
    ajaxComplete: function() { HoldOn.close(); }    
});

$(window).scroll(function() {
    if (results == undefined) {
        return;
    }

    if (results.moreData && $(window).scrollTop() >= $(document).height() - $(window).height() - 100) {
        // Run our call for pagination when we are 90% page down
        console.log('paginate');
        search(false, results.offset);
    }
}); 


/**
 * Show modal on create new button click
 */
$('#search-form').submit(function(event) {

    // Prevent the default behaviour
    event.preventDefault();

    // Search and clear the table contents
    search(true);

});

search = function(clearTable, offset = 0) {
    
    // Prevent multiple ajax calls
    if (request) {
        return false;
    }

    var value = $('#search-code').val();

    // Fire off the request to /form.php
    request = $.ajax({
        url: link('/search'),
        type: 'post',
        data: 'code=' + value + '&offset=' + offset
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log(response);

        // Store the results for pagination
        results = response;

        // Remove all data from the table body
        var eTable = '';
        $.each(response.codeList, function(index, code) {

            eTable += "<tr>";

            eTable += '<td class="visible-sm visible-md visible-lg"><strong>' + code.acronym + '</strong></td>';
            eTable += '<td class="visible-sm visible-md visible-lg">' + code.code + '</td>';
            eTable += '<td>' + code.acronym_code + '</td>';
            eTable += '<td class="visible-sm visible-md visible-lg">' + code.language + '</td>';
            eTable += '<td>' + code.message + '</td>';

            eTable += "</tr>";

        });

        // Create a simple no data row is there are no results
        if (response.codeList.length == 0) {
            eTable += "<tr>";
            eTable += '<td colspan="5">There are no codes matching your search criteria.</td>';
            eTable += "</tr>";
        }

        if (clearTable) {
            $('#table-body').html(eTable);
        } else {
            $('#table-body').append(eTable);
        }

    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error(jqXHR);

        var message;
        if (jqXHR.responseJSON.code) {
            console.error(jqXHR.responseJSON.code);
            console.error(jqXHR.responseJSON.message);
            message = '<strong>Error ' + jqXHR.responseJSON.code + '</strong> ' + jqXHR.responseJSON.message;
        } else {
            message = '<strong>Error 500</strong> There was a problem with the request, please try again later.';
        }


        $('#alert-message').html(message);
        $('#alert-component').fadeIn(1000);
        setTimeout(function() { 
            $('#alert-component').fadeOut(1000);
        }, 5000);

    });

    // To prevent enter key several times on ajax call
    request.complete(function(jqXHR, textStatus) {
        request = false;
    });
};
