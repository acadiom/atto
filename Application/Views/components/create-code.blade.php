
  <!-- Modal -->
  <div class="modal fade" id="createCode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="fa fa-code" aria-hidden="true"></i> Create a new code</h4>
        </div>

        <div class="modal-body">
          <form class="form-horizontal" id="frmCreateCode">
            <fieldset>
              <!-- Concatenated -->
              <div class="form-group">
                <label for="concatenated" class="col-lg-2 control-label">Concatenated</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="concatenatedInput" name="concatenated" placeholder="acronym_00000001" required>
                  <span class="help-block" id="concatenatedHelp"></span>
                </div>
              </div>

              <!-- Acronym -->
              <div class="form-group">
                <label for="acronym" class="col-lg-2 control-label">Acronym</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="acronymInput" name="acronym" placeholder="acronym" autocomplete="off" required>
                  <span class="help-block" id="acronymHelp"></span>
                </div>
              </div>

              <!-- Error code -->
              <div class="form-group">
                <label for="code" class="col-lg-2 control-label">Code</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="codeInput" name="code" placeholder="00000001" autocomplete="off" required>
                  <span class="help-block" id="codeHelp"></span>
                </div>
              </div>

              <!-- Data type -->
              <div class="form-group">
                <label for="dataType" class="col-lg-2 control-label">Code</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="dataType" name="dataType" value="CODIGO_ERROR_APP" required>
                </div>
              </div>

              <!-- Language -->
              <div class="form-group">
                <label for="language" class="col-lg-2 control-label">Language</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="language" name="language" value=" es-ES" required>
                </div>
              </div>

              <!-- Code message -->
              <div class="form-group">
                <label for="description" class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                  <textarea class="form-control input-sm" rows="3" id="descriptionTextarea" name="description" required></textarea>
                  <span class="help-block" id="descriptionHelp"></span>
                </div>
              </div>
              
            </fieldset>
          </form>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnSaveChanges">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


@section('javascript')
<script>
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
  $("#concatenatedInput").keyup(function() {
      var concatenated = this.value.split(/_(.*)/);
      console.log(concatenated);
      
      // Set the acronym
      $("#acronymInput").val(concatenated[0].toUpperCase());

      if (concatenated.length > 1) {
          // Set the code 
          $("#codeInput").val(concatenated[1]);
      }

      // Validate data 
      validateFormData();
  });

  $("#descriptionTextarea").keyup(function() {
      // Validate data 
      validateFormData();
  });

  $('#btnSaveChanges').click(function(event) {
    validateFormData();

    console.log($('#frmCreateCode').serialize());

    // Fire off the request to /form.php
    request = $.ajax({
        url: link('/create'),
        type: 'post',
        data: $('#frmCreateCode').serialize()
    });

    request.done(function (response, textStatus, jqXHR) {
      console.log(response);
      if (response === true) {
        // Todo: remove data from the form
        $('#frmCreateCode').trigger("reset");
        $('#createCode').modal('hide');
      }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
      console.log(response);
    });

  });

  function validateFormData() {
    validateConcatenated();
    validateAcronym();
    validateDescription();
  }

  function validateConcatenated() {
    var concatenatedInput = $('#concatenatedInput');
    var concatenatedHelp = $('#concatenatedHelp');

    if ( ! concatenatedInput.val().match(/^[a-z0-9]{6}_[a-z0-9]+$/i)) {
      concatenatedInput.parent().addClass('has-error').removeClass('has-success');
      // Show error message
      concatenatedHelp.html('The code must match the following regex: "/^[a-z0-9]{6}_[a-z0-9]+$/i", e.g. ABCDEF_000001');
    } else {
      concatenatedInput.parent().removeClass('has-error').addClass('has-success');
      concatenatedHelp.html('');
    }
  }

  function validateAcronym() {
    var acronymInput = $('#acronymInput');
    var acronymHelp = $('#acronymHelp');

    if ( ! acronymInput.val().match(/^[A-Z0-9]{6}$/)) {
      acronymInput.parent().addClass('has-error').removeClass('has-success');
      acronymHelp.html('The acronym must match the following regex: "/^[A-Z0-9]{6}$/", e.g. ABCDEF');
    } else {
      acronymInput.parent().removeClass('has-error').addClass('has-success');
      acronymHelp.html('');
    }
  }

  function validateDescription() {
    var descriptionTextarea = $('#descriptionTextarea');
    var descriptionHelp = $('#descriptionHelp');

    if (descriptionTextarea.val() == '') {
      descriptionTextarea.parent().addClass('has-error').removeClass('has-success');
      descriptionHelp.html('The code message cannot be empty.');
    } else {
      descriptionTextarea.parent().removeClass('has-error').addClass('has-success');
      descriptionHelp.html('');
    }
  }

</script>
@stop