<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura {{$data['invoiceId']}}</title>
</head>
<body>
<style type="text/css">
    table.center {
        margin-left: auto;
        margin-right: auto;
    }
    h1 {    margin-top: 0;
            margin-bottom: 0;

    }
</style>

<main>
    <div id="details" class="clearfix">
        <div id="invoice" style="text-align: center">
            <h1>{{$data['local']}}</h1>
            <h4>{{$data['location']}}</h4>
            <h4>Rif : {{$data['rif']}}</h4>
            <h3>Factura #{{ $data['invoiceId'] }}</h3>
            <h4>Nombre Cliente : {{ $data['clientName'] }}</h4>
            <h4>ID cliente : {{ $data['clientId'] }}</h4>
            <div class="date">Fecha: {{ $data['date'] }}</div>
        </div>
    </div>

    <table border="0" cellspacing="0" cellpadding="1" class="center">
        <thead>
        <tr>
            <th  class="no">#</th>
            <th class="desc">Producto</th>
            <th class="unit">Precio unitario</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['product'] as $i => $producto)
            <tr>
                <td class="no">{{ $i }}</td>
                <td class="desc">{{ $producto['ProductName'] }}</td>
                <td class="unit">{{ $producto['ProductCost'] }} Bs</td>
            </tr>

        @endforeach

        </tbody>
        <br>
        <tfoot>
        <tr border="0">
            <td colspan="1"></td>
            <td ><b>TOTAL</b></td>
            <td>{{$data['cost']}} Bs</td>
        </tr>
        </tfoot>
    </table>
</body>
</html>