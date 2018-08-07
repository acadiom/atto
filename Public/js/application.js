
$(document).on({
    ajaxStart: function() { HoldOn.open({ theme:"sk-cube-grid" }); },
    ajaxStop:  function() { HoldOn.close(); }    
});

// Variable to hold request
var request;

/**
 * Show modal on create new button click
 */
$('#search-form').submit(function(event) {

    // Prevent the default behaviour
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }

    var value = $('#search-code').val();

    // Fire off the request to /form.php
    request = $.ajax({
        url: "/ssl.atto.dev/public/search",
        type: "post",
        data: "code=" + value
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log(response);

        // Remove all data from the table body
        var eTable = '';
        $.each(response.codeList, function(index, code) {

            eTable += "<tr>";

            eTable += '<td class="visible-sm visible-md visible-lg"><a href="#">' + code.acronym + '</a></td>';
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

        $('#table-body').html(eTable);

    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: " +
            textStatus, errorThrown
        );
    });

});

/**
 * Show modal on create new button click
 */
$('#btn-create-code').on('click', function() {
    $('#createCode').modal('show');
});

/**
 * Set the focus to the first input text
 */
$('#createCode').on('shown.bs.modal', function() {
    $('#concatenated').focus();
});

/**
 * Splits the text and populate the acronym and the code
 */
$("#concatenated").keyup(function() {
    var concatenated = this.value.split(/_(.*)/);
    console.log(concatenated);
    
    // Set the acronym
    $("#acronym").val(concatenated[0].toUpperCase());

    if (concatenated.length > 1) {
        // Set the code 
        $("#code").val(concatenated[1]);
    }

});



