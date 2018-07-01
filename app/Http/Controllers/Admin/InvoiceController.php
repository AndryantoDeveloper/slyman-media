<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Invoice;
use App\InvoiceDetail;
use App\Authorizable;
use App\Part;

class InvoiceController extends Controller{

	use Authorizable;

	private $tax = 8.61;

	public function index(){
		$q = \Input::get('search');
		$result = Invoice::where('invoice_number', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);
		$result->appends(['search' => $q]);
    	return view('admin.invoice.index', compact('result'));
	}

	public function create(){
		return redirect()->route('invoices.index');
	}

	public function createDetail($id){
		$invoice = Invoice::findOrFail($id);
		$config = array(
			"invoice_id"=>$id,
			"parts"=>Part::Where('device_id','=',$invoice->device_id)->get()
		);
		return view('admin.invoice.detail.create', $config);
	}

	public function store(Request $request){
		return redirect()->route('invoices.index');
	}

	public function storeDetail(Request $request, $id){
		$part = Part::findOrFail($request->get('part_id'));
		$qty = $request->get('qty');
		$price = $part->price;
		$inv_tax = (float)($price * $this->tax)/100;
		$total = (float)($part->price * $qty) + $inv_tax;
		InvoiceDetail::create([
			"invoice_id"=>$id,
			"part_id"=>$part->id,
			"price"=>$part->price,
			"tax"=>$inv_tax,
			"qty"=>$qty,
			"total"=>$total
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('invoices.edit',["id"=>$id]);
	}

	public function show($id){
		$invoice = Invoice::findOrFail($id);
		$config = array(
			"invoice"=>$invoice,
			"detail"=>InvoiceDetail::Where('invoice_id','=',$id)->get()
		);
		return view('admin.invoice.show', $config);
	}

	public function edit($id){
		$invoice = Invoice::findOrFail($id);
		$config = array(
			"invoice"=>$invoice,
			"detail"=>InvoiceDetail::Where('invoice_id','=',$id)->get()
		);
		return view('admin.invoice.edit', $config);
	}

	public function editDetail($id,$invoice_id){
		$invoice = Invoice::findOrFail($invoice_id);
		$detail = InvoiceDetail::findOrFail($id);
		$config = array(
			"invoice_id"=>$invoice_id,
			"detail"=>$detail,
			"parts"=>Part::Where('device_id','=',$invoice->device_id)->get()
		);
		return view('admin.invoice.detail.edit', $config);
	}

	public function update(Request $request, $id){
		$invoice = Invoice::findOrFail($id);
		$invoice->admin_id = \Auth::User()->id;
		$invoice->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('invoices.index');
	}

	public function updateDetail(Request $request,$id,$invoice_id){
		$detail = InvoiceDetail::findOrFail($id);
		$detail->qty = $request->get('qty');
		$detail->part_id = $request->get('part_id');
		$detail->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('invoices.edit',["id"=>$invoice_id]);
	}

	public function destroy($id){
		Invoice::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('invoices.index');
	}

	public function destroyDetail($id,$invoice_id){
		InvoiceDetail::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('invoices.edit',["id"=>$invoice_id]);
	}

	public function followed($id){
		$number = $this->createNumber();
		if($number){
			$invoice = Invoice::findOrFail($id);
			$invoice->admin_id = \Auth::User()->id;
			$invoice->invoice_number = $number;
			$invoice->confirmed = 1;
			$invoice->save();
			\Session::flash('message', 'Your invoice has been follow up.');
			return redirect()->route('invoices.index');
		}
	}

	public function print($id){
		$invoice = Invoice::findOrFail($id);
		$config = array(
			"invoice"=>$invoice,
			"detail"=>InvoiceDetail::Where('invoice_id','=',$id)->get()
		);
		return view('admin.invoice.print', $config);
	}

	private function createNumber(){
		$num = rand(0,100000);
		$index = strlen($num);
		$digit = 5;
		for($i=$digit; $i>$index; $i--){
			$num = "0".$num;
		}
		$check = Invoice::Where('invoice_number','=',$num)->first();
		if($check){
			$this->createNumber();
		}
		return $num;
	}

}