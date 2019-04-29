<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct(){
		
		parent ::__construct();

		//load model
		$this->load->model('model_barang'); 
        $this->load->model('admin');

	}

	public function index()
	{

		if($this->admin->logged_id())
		{

		$data = array(

			'title' 	=> 'Data Barang',
			'data_barang'	=> $this->model_barang->get_all(),

		);

		$this->load->view('data_barang', $data);
		}else{
			
			redirect("login");
		}
	}

	public function tambah()
	{
		if($this->admin->logged_id())
		{
		$data = array(

			'title' 	=> 'Tambah Data Barang'

		);

		$this->load->view('tambah_barang', $data);
		}else{
			
			redirect("login");
		}
	}

	public function simpan()
	{
		$data = array(

			'kode_barang' 			=> $this->input->post("kode_barang"),
			'nama_barang' 		=> $this->input->post("nama_barang"),
			'harga_jual' 	=> $this->input->post("harga_jual"),
			
		);

		$this->model_barang->simpan($data);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase.
			                                    </div>');

		//redirect
		redirect('barang/');

	}

	public function edit($id_barang)
	{
		if($this->admin->logged_id())
		{
		$id_barang = $this->uri->segment(3);

		$data = array(

			'title' 	=> 'Edit Data Barang',
			'data_barang' => $this->model_barang->edit($id_barang)

		);

		$this->load->view('edit_barang', $data);
		}else{
			
			redirect("login");
		}
	}

	public function update()
	{
		$id['id_barang'] = $this->input->post("id_barang");
		$data = array(

			'kode_barang' 			=> $this->input->post("kode_barang"),
			'nama_barang' 		=> $this->input->post("nama_barang"),
			'harga_jual' 	=> $this->input->post("harga_jual"),
			
		);

		$this->model_barang->update($data, $id);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil diupdate didatabase.
			                                    </div>');

		//redirect
		redirect('barang/');

	}

	public function hapus($id_barang)
	{
		$id['id_barang'] = $this->uri->segment(3);
		
		$this->model_barang->hapus($id);

		//redirect
		redirect('barang/');

	}

}
