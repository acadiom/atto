

$("#concatenated").keyup(function() {
    var concatenated = this.value.split('_');
    
    if (concatenated.length > 0) {
        $("#acronym").value = concatenated[0];
        $("#code").value = concatenated[1];
    }

});
