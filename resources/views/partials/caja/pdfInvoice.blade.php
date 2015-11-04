<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura {{$data['invoiceId']}}</title>
</head>
<body>

<main>
    <div id="details" class="clearfix">
        <div id="invoice">
            <h1>{{$data['local']}}</h1>
            <h3>Factura #{{ $data['invoiceId'] }}</h3>
            <h4>Nombre Cliente : {{ $data['clientName'] }}</h4>
            <div class="date">Fecha: {{ $data['date'] }}</div>
        </div>
    </div>
    <table border="1" cellspacing="1" cellpadding="1">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">Producto</th>
            <th class="unit">Precio unitario</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['product'] as $i => $producto)
            <tr>
                <td class="no">{{ $i }}</td>
                <td class="desc">{{ $producto['ProductName'] }}</td>
                <td class="unit">{{ $producto['ProductCost'] }}</td>
            </tr>

        @endforeach


        </tbody>
        <tfoot>
        <tr border="0">
            <td colspan="1"></td>
            <td >TOTAL</td>
            <td>{{$data['cost']}}</td>
        </tr>
        </tfoot>
    </table>
</body>
</html>