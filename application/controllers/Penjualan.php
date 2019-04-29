<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct(){
		
		parent ::__construct();

		//load model
		$this->load->model('model_penjualan'); 
        $this->load->model('admin');

	}

	public function index()
	{

		if($this->admin->logged_id())
		{
		$data = array(

			'title' 	=> 'Data Penjualan',
			'data_penjualan'	=> $this->model_penjualan->get_all(),

		);

		$this->load->view('data_penjualan', $data);
		}else{
			
			redirect("login");
		}
	}

	public function kode_penjualan()
	{
			$last_kd = $this->model_penjualan->last_kode_penjualan();
			if($last_kd > 0){
				$no_akhir = $last_kd+1;
				$kd = 'PJL'.sprintf("%04s", $no_akhir);
			}else{
				$kd = 'PJL'.'0001';
			}
			return $kd;
	}

	public function harga()
	{
			$id_barang	= $this->input->get('id_barang');

			$dataharga = $this->db->from('tbl_barang b')->where('b.id_barang',$id_barang)->get();
			$harga_jual=0;
			foreach($dataharga->result() as $dtu)
			{
				$harga_jual=$dtu->harga_jual;
			}
				$d['harga_jual'] = $harga_jual;
			echo json_encode($d);
	}

	public function tambah()
	{

		if($this->admin->logged_id())
		{
		$data = array(

			'title' 	=> 'Tambah Data Penjualan',
			'no_transaksi' 	=> $this->kode_penjualan(),

		);

		$this->load->view('tambah_penjualan', $data);
		}else{
			
			redirect("login");
		}
	}

	public function simpan()
	{
		$data = array(

			'no_transaksi' 			=> $this->input->post("no_transaksi"),
			'id_pelanggan' 		=> $this->input->post("id_pelanggan"),
			'tgl_penjualan' 	=> $this->input->post("tgl_penjualan"),
			'total' 	=> $this->input->post("total"),
			'id_user' 	=> $this->session->userdata('user_id'),
			
		);

		$this->model_penjualan->simpan_pesanan($data);

				$count_item	= $this->input->post('count_item');
				$no_transaksi	= $this->input->post('no_transaksi');
				$id_barang	= $this->input->post('id_barang_t2');
				$qty	= $this->input->post('qty_t2');
				$harga_jual	= $this->input->post('harga_jual_t2');
				$sub_total	= $this->input->post('sub_total_t2');
				$temp= count($count_item);
				for($i=0; $i<$temp;$i++){
						$this->db->query("INSERT INTO tbl_penjualan(no_transaksi,id_barang,qty,harga_jual,sub_total)
															        VALUES('$no_transaksi','$id_barang[$i]','$qty[$i]','$harga_jual[$i]','$sub_total[$i]')");


				}

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase.
			                                    </div>');

		//redirect
		redirect('penjualan/');

	}

	public function edit($id_penjualan)
	{

		if($this->admin->logged_id())
		{
		$id_penjualan = $this->uri->segment(3);

		$data = array(

			'title' 	=> 'Edit Data Penjualan',
			'data_penjualan' => $this->model_penjualan->edit($id_penjualan),
			'penjualan'	=> $this->model_penjualan->get_allpenjualan($id_penjualan),

		);

		$this->load->view('edit_penjualan', $data);
		}else{
			
			redirect("login");
		}
	}

	public function update()
	{
		$id['id_penjualan'] = $this->input->post("id_penjualan");
		$data = array(

			'kode_penjualan' 			=> $this->input->post("kode_penjualan"),
			'nama_penjualan' 		=> $this->input->post("nama_penjualan"),
			'harga_jual' 	=> $this->input->post("harga_jual"),
			
		);

		$this->model_penjualan->update($data, $id);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil diupdate didatabase.
			                                    </div>');

		//redirect
		redirect('penjualan/');

	}

	public function hapus($id_penjualan)
	{
		$no_transaksi = $this->uri->segment(3);
		$this->db->delete('tbl_pesanan_penjualan', array('no_transaksi' => $no_transaksi)); 
		$this->db->delete('tbl_penjualan', array('no_transaksi' => $no_transaksi)); 

		//redirect
		redirect('penjualan/');

	}

}
