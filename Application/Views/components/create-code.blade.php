
  <!-- Modal -->
  <div class="modal fade" id="createCode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="fa fa-code" aria-hidden="true"></i> Create a new code</h4>
        </div>

        <div class="modal-body">
          <form class="form-horizontal">
            <fieldset>
              <!-- Concatenated -->
              <div class="form-group">
                <label for="concatenated" class="col-lg-2 control-label">Concatenated</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="concatenated" name="concatenated" placeholder="acronym_00000001">
                  <span class="help-block" id="latestCode">Latest code: </span>
                </div>
              </div>

              <!-- Acronym -->
              <div class="form-group">
                <label for="acronym" class="col-lg-2 control-label">Acronym</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="acronym" name="acronym" placeholder="acronym" autocomplete="off">
                </div>
              </div>

              <!-- Error code -->
              <div class="form-group">
                <label for="code" class="col-lg-2 control-label">Code</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="code" name="code" placeholder="00000001" autocomplete="off">
                </div>
              </div>

              <!-- Data type -->
              <div class="form-group">
                <label for="dataType" class="col-lg-2 control-label">Code</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="dataType" name="dataType" value="CODIGO_ERROR_APP">
                </div>
              </div>

              <!-- Language -->
              <div class="form-group">
                <label for="language" class="col-lg-2 control-label">Language</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control input-sm" id="language" name="language" value=" es-ES">
                </div>
              </div>

              <!-- Code message -->
              <div class="form-group">
                <label for="description" class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                  <textarea class="form-control input-sm" rows="3" id="description" name="description"></textarea>
                  <span class="help-block">Code description in the selected language.</span>
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
