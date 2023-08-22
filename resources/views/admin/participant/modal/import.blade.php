<div class="modal-import-participant modal fade show" id="modal-import-participant" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-bg-white ">
            <div class="modal-header">
                <h6 class="modal-title">Import Participant</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span data-feather="x"></span></button>
            </div>
            <div class="modal-body">
                <form id="formImport" enctype="multipart/form-data">
                    @csrf
                    <div class="atbd-tag-wrap">
                        <div class="atbd-upload">
                            <div class="atbd-upload__input">
                                <label for="formGroupExampleInput" class="color-dark fs-14 fw-500 align-center">Upload
                                    File Excel</label>
                            </div>
                            <div class="atbd-upload__button">
                                <a href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload"
                                    onclick="$('#upload-1').click()"> <span data-feather="upload"></span> Click to
                                    Upload</a>
                                <i class='bx bx-cloud-download'></i>
                                <p style="font-size: 12px; color:#0d47a1;">File yang diizinkan :
                                    .xls/.xlsx</p>
                                <input type="file" name="upload-1" class="upload-file" id="upload-1"
                                    accept=".xlsx, .xls" hidden>
                            </div>
                            <div class="atbd-upload__file mb-2">
                                <ul class="uploaded-files-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput" class="color-dark fs-14 fw-500 align-center">Event</label>
                        <div class="atbd-select ">
                            <select name="event_id" id="select-search" class="form-control event_id">
                                @foreach ($events as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="importParticipant()">Import</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
