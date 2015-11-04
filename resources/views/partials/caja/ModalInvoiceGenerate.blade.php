@section('Modalinvoice')
<div id="create_invoice" class="modal ">
    <div class="modal-content">
        <h4>Datos del Cliente</h4>

        {!!Form::open([
        'route' => 'invoiceStoreAjax',
        'method' => 'POST',
        'id' => 'crear_invoiceForm',
        ])
        !!}
        <div class="row">
            <div class="input-field col s12">
                {!! Form::text('client_id', null,['class' => 'validate firstNameUser'])!!}
                {!! Form::label('client_id', 'Numero Identificacion  cliente ',['for' => 'client_id'])!!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                {!! Form::text('client_name', null,['class' => 'validate lastNameUser'])!!}
                {!! Form::label('client_name', 'Nombre del Cliente ',['for' => 'client_name'])!!}
            </div>
        </div>


        <div class="modal-footer">
            <a href="#" id="crear_InvoiceSubmit" data-id="{{$data['idtable']}}" type="submit" class="waves-effect waves-green btn-flat ">Crear</a>


        </div>
        <input name="idtable" type="hidden" value="{{$data['idtable']}}">
        {!!Form::close()!!}
            </div>
</div>
@endsection