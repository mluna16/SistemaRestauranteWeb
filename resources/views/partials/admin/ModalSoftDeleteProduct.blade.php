<div  class="modal bottom-sheet modalSoftDeleteProduct">
    <div class="modal-content">

        <div class="row">
            <div class="col s8">
                <h5><span class="headerSoftDeleteProduct"></span> a <span class="ProductNameSoftDeleteProduct"></span></h5>
            </div>
            <div class="col s4">
                <div class="row">
                    <div class="col s6">
                        <a class="waves-effect waves-light btn red text-white modal-action modal-close closeSoftDelete">No</a>

                    </div>
                    <div class="col s6">
                        <a class="waves-effect waves-light btn green text-white submitSoftDeleteProduct">Si</a>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::open([
        'route' => [
        'productSoftDelete',
        ':PRODUCT_ID'
        ],
        'method' => 'POST',
        'id' => 'formSoftDeleteProduct'])
        !!}

        {!!Form::close()!!}

    </div>
</div>