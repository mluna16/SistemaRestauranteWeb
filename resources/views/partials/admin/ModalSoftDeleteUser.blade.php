<div  class="modal bottom-sheet modalSoftDeleteUser">
    <div class="modal-content">

        <div class="row">
            <div class="col s8">
                <h5><span class="headerSoftDeleteUser"></span> a <span class="fullNameSoftDeleteUser"></span></h5>
            </div>
            <div class="col s4">
                <div class="row">
                    <div class="col s6">
                        <a class="waves-effect waves-light btn red text-white modal-action modal-close closeSoftDelete">No</a>

                    </div>
                    <div class="col s6">
                        <a class="waves-effect waves-light btn green text-white submitSoftDelete">Si</a>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::open([
                'route' => [
                        'userSoftDelete',
                        ':USER_ID'
                        ],
                'method' => 'POST',
                'id' => 'formSoftDeleteUser'])
        !!}

        {!!Form::close()!!}

    </div>
</div>