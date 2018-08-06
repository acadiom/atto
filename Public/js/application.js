


/**
 * Show modal on create new button click
 */
$('#toggleCreateCode').on('click', function() {
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


$(function() {

    $.ajax({
        url: "/ssl.atto.dev/public/languages",
        success: function(result) {
            var select = $('#search-language');                       
            select.find('option').remove();  
            $.each(result, function(key, value) {              
                $('<option>').val(value).text(value).appendTo(select);
            });
        }
    });

    $.ajax({
        url: "/ssl.atto.dev/public/acronyms",
        success: function(result) {
            var select = $('#search-acronym');                       
            select.find('option').remove();  
            $.each(result, function(key, value) {              
                $('<option>').val(value).text(value).appendTo(select);
            });
        }
    });

});

