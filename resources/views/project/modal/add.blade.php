<div class="modal-dialog modal-md">
    <form id="dataFrom">
        <div class="modal-content border-top border-0 border-4 border-primary">
            <div class="modal-header">
                <h5 class="modal-title text-primary">{{$modal_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        <span class="text-danger text-empty require-name"></span>
                    </div>
                    @if(Auth::user()->user_type->value == $admin->value)
                    <div class="col-md-6">
                        <label class="form-label">Staff</label>
                        <select class="single-select mb-3 form-control" name="user_id">
                            <option value="">Assing Staff</option>
                            @foreach ($users as $users)
                            <option value="{{ $users->id }}" @selected($users->id == old('user_id'))>{{ $users->name }}</option>
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
                            <option value="{{ $value->value }}" @selected($value->value == old('status'))>{{ $value->getLabel() }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger text-empty require-status"></span>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Image</label>
                        <br>
                        <input type="file" name="image">
                        {{-- <input id="fancy_file_upload" type="file" name="image" accept=".jpg, .png, image/jpeg, image/png"> --}}
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Description</label>
                        <br>
                        <textarea style="width:100%" name="description" class="from-control" id="" cols="30" rows="5">{{old('description')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="createBtn" class="btn btn-primary px-5">{{$modal_btn}}</button>
            </div>
        </div>
    </form>
</div>