<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Model_barang;
use App\Models\Model_supplier;

class Home extends BaseController
{
	public function index()
	{
		$barang = new Model_barang;
		$data = [
			'title' => 'UJIKOM | Home',
			'segment' => "home",
		];
		return view('admin/home', $data);
	}

	public function ambildatabarang() {
		if ($this->request->isAJAX()) {
			$barang = new Model_barang;
			$data = [
				'semua_barang' => $barang->getDataBarang()
			];

			$msg = [
				'data' => view('admin/ajax/databaranghome', $data)
			];

			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

}