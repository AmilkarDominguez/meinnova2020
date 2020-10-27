<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Seller;
use App\DetailSaleProduct;
use App\Batch;
use App\Catalogue;
use App\Sale;
use App\Product;
use App\Payment;

use Yajra\DataTables\DataTables;

class ReportController extends Controller
{

    public function SelleReport(Request $request)
    {
        
        return datatables()->of(Sale::all()->where('payment_status_id', 5)->where('seller_id',$request->seller_id)->whereBetween('date',[$request->minimum_date, $request->maximum_date]))
        ->addColumn('client_name', function ($item) {
            $client_name = Client::find($item->client_id);
            return  $client_name->name;
        })
        ->addColumn('zone_name', function ($item) {
            $client = Client::find($item->client_id);
            //$zone_name = Catalogue::where('catalog_zone_id',3)->where('id',$client->catalog_zone_id);
            $zone_name=Catalogue::where('id',$client->catalog_zone_id)->pluck('name')->first();
            return  $zone_name;
        })
        ->addColumn('seller_name', function ($item) {
            $seller_name = Seller::find($item->seller_id);
            return  $seller_name->name;
        })          
        ->toJson();
    }

    public function ReportLines(Request $request)
    {
        return datatables()->of(Batch::all()->where('state','ACTIVO')->where('line_id',$request->line_id))
        ->addColumn('product_name', function ($item) {
            $product_name = Product::find($item->product_id);
            return  $product_name->name;
        })
        ->addColumn('total_stock_price', function ($item) {
            $total_stock_price = $item->stock*$item->wholesaler_price;
            return  $total_stock_price;
        })  
        ->toJson();
    }



    public function ReportCollectors(Request $request)
    {
        
        return datatables()->of(Payment::all()->where('state','!=','ELIMINADO')->where('collector_id',$request->collector_id)->whereBetween('entry_date',[$request->minimum_date, $request->maximum_date]))
       ->addColumn('client_name', function ($item) {
            $sale = Sale::find($item->sale_id);
            $client_name=Client::where('id',$sale->client_id)->pluck('name')->first();
            return  $client_name;
        })
        ->addColumn('sale_id', function ($item) {
            $sale_id = Sale::find($item->sale_id);
            return  $sale_id->id;
        })         
        ->toJson();
    }

    public function ReportAccounts(Request $request)
    {
        $Sales =  Sale::where('state','!=','ELIMINADO')->where('payment_status_id',5)->whereBetween('date',[$request->minimum_date, $request->maximum_date])->orderBy('client_id')->with('client')->get();
        return datatables()->of($Sales)
       ->addColumn('client_name', function ($item) {

            return  $item->client->name;
        })
        ->addColumn('residue', function ($item) {
            $residue = $item->total-$item->receive;
            return  $residue;
        })  
        ->addColumn('residue_discount', function ($item) {
            $residue = $item->total_discount-$item->receive;
            return  $residue;
        })   
        ->toJson();
    }
    public function ReportSalesZones(Request $request)
    {
        //$zone = Client::where('catalog_zone_id',$request->catalog_zone_id);
        //$zonee = Sale::where('catalog_zone_id',$request->)
       $Sales =  Sale::where('state','!=','ELIMINADO')
       ->where('payment_status_id',5)
       ->whereBetween('date',[$request->minimum_date, $request->maximum_date])
       ->orderBy('client_id')
       ->with('client')->get()
       ->where('client.catalog_zone_id',$request->catalog_zone_id);
       //->where('Sale.Client.catalog_zone_id',$request->catalog_zone_id)

        return datatables()->of($Sales)
       ->addColumn('client_name', function ($item) {
            return  $item->client->name;
        })
        ->addColumn('zone', function ($item) {
            $zone = Catalogue::find($item->client->catalog_zone_id);
            return  $zone->name;
        })
        ->addColumn('residue', function ($item) {
            $residue = $item->total-$item->receive;
            return  $residue;
        })  
        ->addColumn('residue_discount', function ($item) {
            $residue = $item->total_discount-$item->receive;
            return  $residue;
        })   
        ->toJson();
    }


    public function sellerreport()
    {
        return view('report.sellerreport');
    }
    public function reportline()
    {
        return view('report.reportline');
    }
    public function reportcollector()
    {
        return view('report.reportcollector');
    }
    public function reportaccountsreceivable()
    {
        return view('report.reportaccounts');
    }
    public function reportzone()
    {
        return view('report.reportareareceivable');
    }
}
