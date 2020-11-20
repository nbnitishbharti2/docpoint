<div class="row">
    <div class="col-sm-12">
        <div class="tab-content donation-layout">
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::pull('error') }}
            </div>
            @endif
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::pull('message') }}
            </div>
            @endif
        </div>
    </div>
</div>