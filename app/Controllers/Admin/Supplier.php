<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Model_barang;
use App\Models\Model_supplier;

class Supplier extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'UJIKOM | Supplier',
			'segment' => "supplier",
		];
		return view('admin/supplier', $data);
	}

	public function ambildatasupplier() {
		if ($this->request->isAJAX()) {
			$supplier = new Model_supplier;
			$data = [
				'semua_supplier' => $supplier->findAll()
			];

			$msg = [
				'data' => view('admin/ajax/datasupplier', $data)
			];

			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

	public function formtambah(){
		if ($this->request->isAJAX()) {
			$supplier = new Model_supplier;
			$data = [
				'supplier' => $supplier->findAll()
			];

			$msg = [
				'data' => view('admin/ajax/modaltambahsupplier', $data)
			];

			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

	public function simpansupplier(){
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$valid = $this->validate([
				'id_supplier' => [
					'label' => 'ID Barang',
					'rules' => 'required|is_unique[tabel_supplier.id_supplier]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} tidak boleh sama',
					]
				],
				'nama' => [
					'label' => 'Nama Suppplier',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'alamat' => [
					'label' => 'Alamat',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'kota' => [
					'label' => 'Kota',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'telp' => [
					'label' => 'Telepon',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],

			]);

			if (!$valid) {
				$msg = [
					'error' => [
						'id_supplier'=> $validation->getError('id_supplier'),
						'nama'=> $validation->getError('nama'),
						'alamat'=> $validation->getError('alamat'),
						'kota'=> $validation->getError('kota'),
						'telp'=> $validation->getError('telp'),
						]
					];
					
				} 
				else {
					$simpandatasupplier = [
						'id_supplier' => $this->request->getVar('id_supplier'),
						'nama' => $this->request->getVar('nama'),
						'alamat' => $this->request->getVar('alamat'),
						'kota' => $this->request->getVar('kota'),
						'telepon' => $this->request->getVar('telp'),
					];
					
					$supplier = new Model_supplier;
					$supplier->insert($simpandatasupplier);
					$msg = [
						'sukses' => 'Data Supplier Berhasil Tersimpan'
					];
					
				}
				echo json_encode($msg);
		}else {
			exit('Maaf tidak dapat diproses');
		}			
	}

	public function editsupplier(){
		if ($this->request->isAJAX()) {
			$supplier = new Model_supplier;
			$sup = $supplier->findAll();
			$id_supplier = $this->request->getVar('id_supplier');
			$supplierselect = $supplier->find($id_supplier);

			$data = [
				'id_supplier' => $supplierselect['id_supplier'],
				'nama' => $supplierselect['nama'],
				'alamat' => $supplierselect['alamat'],
				'kota' => $supplierselect['kota'],
				'telepon' => $supplierselect['telepon'],				
			];

			$msg = [
				'sukses' => view('admin/ajax/modaleditsupplier', $data)
			];
			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

	public function updatedatasupplier(){
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$valid = $this->validate([
				'nama' => [
					'label' => 'Nama Suplier',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'alamat' => [
					'label' => 'Alamat',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'kota' => [
					'label' => 'Kota',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'telp' => [
					'label' => 'Telepon',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
			]);

			if (!$valid) {
				$msg = [
					'error' => [
						'nama'=> $validation->getError('nama'),
						'alamat'=> $validation->getError('alamat'),
						'kota'=> $validation->getError('kota'),
						'telp'=> $validation->getError('telp'),
						]
					];
			}
			else {
				$msg = [
					'sukses' => 'Berhasil Diubah'
				];
			}
			echo json_encode($msg);
		}else {
			exit('Maaf tidak dapat diproses');
		}			
	}

	public function hapussupplier(){
		if ($this->request->isAJAX()) {
			$id_supplier = $this->request->getVar('id_supplier');
			$nama_supplier = $this->request->getVar('nama_supplier');
			$supplier = new Model_supplier;
			$supplier->delete($id_supplier);
			$msg = [
				'sukses' => "'$nama_supplier' Berhasil Dihapus"
			];
			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

}