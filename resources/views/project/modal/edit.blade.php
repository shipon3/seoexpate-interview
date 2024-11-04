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
                        <input type="text" class="form-control" name="name" value="{{$project->name}}" {{Auth::user()->user_type->value != $admin->value ? 'readonly' : ''}}>
                        <span class="text-danger text-empty require-name"></span>
                    </div>
                    @if(Auth::user()->user_type->value == $admin->value)
                    <div class="col-md-6">
                        <label class="form-label">Staff</label>
                        <select class="single-select mb-3 form-control" name="user_id">
                            <option value="">Assing Staff</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected($user->id == $project->user_id)>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger text-empty require-user_id"></span>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <label class="form-label">Status</label>
                        <select class="single-select mb-3 form-control" name="status">
                            <option value="">Select Status</option>
                            @foreach ($project_status as $key => $value)
                            <option value="{{ $value->value }}" @selected($value->value == $project->status->value)>{{ $value->getLabel() }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger text-empty require-status"></span>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Image</label>
                        <br>
                        @if(Auth::user()->user_type->value != $admin->value)
                        @else
                        <input type="file" name="image" id="file">
                        @endif
                        {{-- <div class="drag-area" ondrop="upload_file(event)" ondragover="return false">
                            <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <header>Drag & Drop to Upload File</header>
                            <span>OR</span>
                            <button>Browse File</button>
                            <input type="file" name="avater" id="file" hidden>
                        </div> --}}
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Description</label>
                        <br>
                        @if(Auth::user()->user_type->value != $admin->value)
                        <p>{{$project->description}}</p>
                        @else
                        <textarea style="width:100%" name="description" class="from-control" id="" cols="30" rows="5">{{$project->description}}</textarea>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="updateBtn" data-id="{{$project->id}}" class="btn btn-primary px-5">{{$modal_btn}}</button>
            </div>
        </div>
    </form>
</div>