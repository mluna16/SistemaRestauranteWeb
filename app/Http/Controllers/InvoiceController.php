<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Carbon\Carbon;
use DOMPDF;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Invoice;
use SistemaRestauranteWeb\InvoiceProduct;
use SistemaRestauranteWeb\Local;
use SistemaRestauranteWeb\Table;

class InvoiceController extends Controller {

	public  function store(Request $request)
    {
        $invoice        = new Invoice();
        $invoiceProduct = new InvoiceProduct();
        $table          = new Table();
        try{
            $statusCode = 200;
            $response = ['success'=> true];

            $tables = $table->getInfoTableForNumberTable($request['idtable']);
            $request['created_by'] = Auth::user()->id;
            $request['costo']      = $tables['CostTable'];
            $invoiceData = $invoice->createNew($request->all());

            foreach($tables['Pedidos'] as $mesa){
                $data = [
                        'id_product'    => $mesa['ProductId'],
                        'id_invoice'    => $invoiceData['id'],
                        'costo'         => $mesa['ProductCost'],
                ];
                $invoiceProduct->createNew($data);
            }
            $table->changeStatusTable($request['idtable']);
            $response['url'] = url().'/caja/factura/'.$invoiceData['id'];



        }catch (Exception $e) {
            $response = [
                "error" => $e->getMessage(),
            ];
            $statusCode = 400;
        }
        finally {
            return Response::json($response, $statusCode);
        }
    }

    public function generatePdf($data)
    {
        $view =  View::make('partials.caja.pdfInvoice', compact('data'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }

    public function getinvoiceDetails($id)
    {
        $data = ['idtable' => $id ];
        $view = View::make('partials.caja.ModalInvoiceGenerate')->with('data',$data);
        $sections = $view->renderSections();
        return Response::json(['data' => $sections['Modalinvoice']]); // se envie el sections con un formato json

    }

    public function getInvoice($id)
    {
        $invoiceProduct = new InvoiceProduct();
        $local          = new Local();

        try{
            $invoice = Invoice::findOrFail($id);

            $data = [
                'local'         => $local->getLocalNameForUser(),
                'date'         => Carbon::parse($invoice->created_at)->format('d/m/Y h:s'),
                'clientName'    => $invoice->client_name,
                'clientId'      => $invoice->client_id,
                'invoiceId'       => $invoice->id,
                'cost'          => $invoice->costo,
                'product'       => $invoiceProduct->getProduct($id)
            ];

        }catch (Exception $e) {
           return  ["error" => $e->getMessage()];
        }
        finally {
            return  $this->generatePdf($data);

        }



    }
}
