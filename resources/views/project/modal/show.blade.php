<div class="modal-dialog modal-md">
    <div class="modal-content border-top border-0 border-4 border-primary">
        <form id="dataFrom">
            <div class="modal-header">
                <h5 class="modal-title text-primary">{{$modal_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-sm-5">
                            <h6 class="mb-0">Name</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">
                            : <span>{{$project->name}}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5">
                            <h6 class="mb-0">Assign To</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">
                            : <span>{{$project->user->name}}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5">
                            <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">
                            :<span class="badge" style="color:#000;background:{{$project->status->color()}}">{{$project->status->getLabel()}}</span>';
                        </div>
                    </div>
                    @if(!empty($project->image))
                    <div class="row mb-3">
                        <div class="col-sm-5">
                            <h6 class="mb-0">Image</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">
                            : <span><img src="/{{$project->image}}" alt=""></span>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$modal_btn}}</button>
            </div>
        </form>
    </div>
</div>