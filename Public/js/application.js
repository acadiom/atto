


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


<<<<<<< HEAD
=======
$(function() {
    

});

>>>>>>> d7c2ae97a7f35504f2811638db551feb93763c8f
