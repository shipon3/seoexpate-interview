<div class="modal-dialog modal-md">
    <form id="editDataFrom">
        <div class="modal-content border-top border-0 border-4 border-primary">
            <div class="modal-header">
                <h5 class="modal-title text-primary">{{$modal_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        <span class="text-danger text-empty require-name"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}">
                        <span class="text-danger text-empty require-email"></span>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Avater</label>
                        <br>
                        <input type="file" name="avater" id="file">
                        {{-- <div class="drag-area" ondrop="upload_file(event)" ondragover="return false">
                            <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <header>Drag & Drop to Upload File</header>
                            <span>OR</span>
                            <button>Browse File</button>
                            <input type="file" name="avater" id="file" hidden>
                          </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="updateBtn" data-id="{{$user->id}}" class="btn btn-primary px-5">{{$modal_btn}}</button>
            </div>
        </div>
    </form>
</div>