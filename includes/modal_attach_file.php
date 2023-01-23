<!-- Modal New Atachment file-->
<div class="modal fade" id="modal_new_attach" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New attachment file</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_attach" action="#" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="process_id" value="0">
          <div class="mb-3">
            <label for="new_attach" class="form-label">Add a new attachment file</label>
            <input type="file" class="form-control rounded" value="" id="new_attach" name="new_attach" required autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info rounded-pill fw-bolder">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>