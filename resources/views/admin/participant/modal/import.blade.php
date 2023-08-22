<div class="modal-import-participant modal fade show" id="modal-import-participant" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-bg-white ">
            <div class="modal-header">
                <h6 class="modal-title">Import</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span data-feather="x"></span></button>
            </div>
            <div class="modal-body">
                <form id="formImport" enctype="multipart/form-data">
                    @csrf
                    <div class="atbd-tag-wrap">
                        <div class="atbd-upload">
                            <div class="atbd-upload__button">
                                <a href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload"
                                    onclick="$('#upload-1').click()"> <span data-feather="upload"></span> Click to
                                    Upload</a>
                                <input type="file" name="upload-1" class="upload-one" id="upload-1">
                            </div>
                            <div class="atbd-upload__file">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="importParticipant()">Save
                    changes</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
