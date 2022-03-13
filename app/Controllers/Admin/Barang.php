<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Model_barang;
use App\Models\Model_supplier;

class Barang extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'UJIKOM | Barang',
			'segment' => "barang",
		];
		return view('admin/barang', $data);
	}

	public function ambildatabarang() {
		if ($this->request->isAJAX()) {
			$barang = new Model_barang;
			$data = [
				'semua_barang' => $barang->getDataBarang()
			];

			$msg = [
				'data' => view('admin/ajax/databarang', $data)
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
				'data' => view('admin/ajax/modaltambahbarang', $data)
			];

			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

	public function simpanbarang(){
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$valid = $this->validate([
				'id_barang' => [
					'label' => 'ID Barang',
					'rules' => 'required|is_unique[tabel_barang.id_barang]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} tidak boleh sama',
					]
				],
				'kategori' => [
					'label' => 'Kategori Barang',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'namabarang' => [
					'label' => 'Nama Barang',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'harga' => [
					'label' => 'harga',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'stok' => [
					'label' => 'stok',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'supplier' => [
					'label' => 'supplier',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],

			]);

			if (!$valid) {
				$msg = [
					'error' => [
						'id_barang'=> $validation->getError('id_barang'),
						'kategori'=> $validation->getError('kategori'),
						'namabarang'=> $validation->getError('namabarang'),
						'harga'=> $validation->getError('harga'),
						'stok'=> $validation->getError('stok'),
						'supplier'=> $validation->getError('supplier'),
						]
					];
					
				} 
				else {
					$id_sup = $this->request->getVar('supplier');
					$supplier = new Model_supplier;
					$sup = $supplier->getNamaSupplier($id_sup);
					foreach ($sup as $key) {
						$nama_sup = $key['nama'];
					}

					$simpandatabarang = [
						'id_barang' => $this->request->getVar('id_barang'),
						'kategori' => $this->request->getVar('kategori'),
						'nama_barang' => $this->request->getVar('namabarang'),
						'harga' => $this->request->getVar('harga'),
						'stok' => $this->request->getVar('stok'),
						'id_sup' => $this->request->getVar('supplier'),
						'supplier' => $nama_sup,
					];
					
					$barang = new Model_barang;
					$barang->insert($simpandatabarang);
					$msg = [
						'sukses' => 'Data Barang Berhasil Tersimpan'
					];
					
				}
				echo json_encode($msg);
		}else {
			exit('Maaf tidak dapat diproses');
		}			
	}

	public function editbarang(){
		if ($this->request->isAJAX()) {
			
			$barang = new Model_barang;
			$supplier = new Model_supplier;
			$sup = $supplier->findAll();
			$id_barang = $this->request->getVar('id_barang');
			$barangselect = $barang->find($id_barang);
			$nama_barang_select = $barang->find($barangselect['nama_barang']);

			$data = [
				'id_barang' => $barangselect['id_barang'],
				'kategori' => $barangselect['kategori'],
				'namabarang' => $barangselect['nama_barang'],
				'harga' => $barangselect['harga'],
				'stok' => $barangselect['stok'],
				'supplier' => $barangselect['supplier'],
				'id_sup' => $barangselect['id_sup'],
				'sup' => $sup,
			];

			$msg = [
				'sukses' => view('admin/ajax/modaleditbarang', $data)
			];
			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

	public function updatedatabarang(){
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$valid = $this->validate([
				'kategori' => [
					'label' => 'Kategori Barang',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'namabarang' => [
					'label' => 'Nama Barang',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'harga' => [
					'label' => 'harga',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'stok' => [
					'label' => 'stok',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
				'supplier' => [
					'label' => 'supplier',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
					]
				],
			]);

			if (!$valid) {
				$msg = [
					'error' => [
						'id_barang'=> $validation->getError('id_barang'),
						'kategori'=> $validation->getError('kategori'),
						'namabarang'=> $validation->getError('namabarang'),
						'harga'=> $validation->getError('harga'),
						'stok'=> $validation->getError('stok'),
						'supplier'=> $validation->getError('supplier'),
						]
					];
			} 
			else {
				$id_sup = $this->request->getVar('supplier');
				$supplier = new Model_supplier;
				$sup = $supplier->getNamaSupplier($id_sup);
				foreach ($sup as $key) {
					$nama_sup = $key['nama'];
				}

				$simpandatabarang = [
					'kategori' => $this->request->getVar('kategori'),
					'nama_barang' => $this->request->getVar('namabarang'),
					'harga' => $this->request->getVar('harga'),
					'stok' => $this->request->getVar('stok'),
					'id_sup' => $this->request->getVar('supplier'),
					'supplier' => $nama_sup,
				];

				$barang = new Model_barang;
				$id_barang = $this->request->getVar('id_barang');
				$barang->update($id_barang, $simpandatabarang);
				$msg = [
					'sukses' => 'Berhasil Diubah'
				];
			}
			echo json_encode($msg);
		}else {
			exit('Maaf tidak dapat diproses');
		}			
	}

	public function hapusbarang(){
		if ($this->request->isAJAX()) {
			$id_barang = $this->request->getVar('id_barang');
			$nama_barang = $this->request->getVar('nama_barang');
			$barang = new Model_barang;
			$barang->delete($id_barang);
			$msg = [
				'sukses' => "'$nama_barang' Berhasil Diubah"
			];
			echo json_encode($msg);

		} else {
			exit('Maaf tidak dapat diproses');
		}
	}

}