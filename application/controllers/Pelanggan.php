<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct(){
		
		parent ::__construct();

		//load model
		$this->load->model('model_pelanggan');
        $this->load->model('admin'); 

	}

	public function index()
	{

		if($this->admin->logged_id())
		{
		$data = array(

			'title' 	=> 'Data Pelanggan',
			'data_pelanggan'	=> $this->model_pelanggan->get_all(),

		);

		$this->load->view('data_pelanggan', $data);
		}else{
			
			redirect("login");
		}
	}

	public function tambah()
	{

		if($this->admin->logged_id())
		{
		$data = array(

			'title' 	=> 'Tambah Data Pelanggan'

		);

		$this->load->view('tambah_pelanggan', $data);
		}else{
			
			redirect("login");
		}
	}

	public function simpan()
	{
		$data = array(

			'nama_pelanggan' 		=> $this->input->post("nama_pelanggan"),
			'alamat_pelanggan' 		=> $this->input->post("alamat_pelanggan"),
			'telepon' 	=> $this->input->post("telepon"),
			
		);

		$this->model_pelanggan->simpan($data);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase.
			                                    </div>');

		//redirect
		redirect('pelanggan/');

	}

	public function edit($id_pelanggan)
	{

		if($this->admin->logged_id())
		{
		$id_pelanggan = $this->uri->segment(3);

		$data = array(

			'title' 	=> 'Edit Data Pelanggan',
			'data_pelanggan' => $this->model_pelanggan->edit($id_pelanggan)

		);

		$this->load->view('edit_pelanggan', $data);
		}else{
			
			redirect("login");
		}
	}

	public function update()
	{
		$id['id_pelanggan'] = $this->input->post("id_pelanggan");
		$data = array(

			'nama_pelanggan' 		=> $this->input->post("nama_pelanggan"),
			'alamat_pelanggan' 		=> $this->input->post("alamat_pelanggan"),
			'telepon' 	=> $this->input->post("telepon"),
			
		);

		$this->model_pelanggan->update($data, $id);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil diupdate didatabase.
			                                    </div>');

		//redirect
		redirect('pelanggan/');

	}

	public function hapus($id_pelanggan)
	{
		$id['id_pelanggan'] = $this->uri->segment(3);
		
		$this->model_pelanggan->hapus($id);

		//redirect
		redirect('pelanggan/');

	}

}
