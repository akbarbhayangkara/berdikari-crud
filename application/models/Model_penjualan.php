<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_penjualan extends CI_model{


	public function get_all()
	{
		$query = $this->db->select("pp.no_transaksi,pp.tgl_penjualan,pp.total,p.nama_pelanggan,pp.id_pesanan_penjualan")
				 ->from('tbl_pesanan_penjualan pp')
				 ->join('tbl_pelanggan p','p.id_pelanggan=pp.id_pelanggan')
				 ->order_by('id_pesanan_penjualan', 'DESC')
				 ->get();
		return $query->result();
	}
	public function get_allpenjualan($no_transaksi)
	{
		$query = $this->db->select("pp.qty,p.nama_barang,pp.sub_total,pp.harga_jual")->where("no_transaksi", $no_transaksi)->join('tbl_barang p','p.id_barang=pp.id_barang')
				->get("tbl_penjualan pp");
		return $query->result();
	}

	public function simpan($data)
	{
		
		$query = $this->db->insert("tbl_penjualan", $data);

		if($query){
			return true;
		}else{
			return false;
		}

	}

	public function simpan_pesanan($data)
	{
		
		$query = $this->db->insert("tbl_pesanan_penjualan", $data);

		if($query){
			return true;
		}else{
			return false;
		}

	}

	public function edit($no_transaksi)
	{
		
		$query = $this->db->where("no_transaksi", $no_transaksi)->join('tbl_pelanggan p','p.id_pelanggan=pp.id_pelanggan')
				->get("tbl_pesanan_penjualan pp");

		if($query){
			return $query->row();
		}else{
			return false;
		}

	}

public function last_kode_penjualan(){
		$q = $this->db->query("SELECT MAX(right(no_transaksi,4)) as kode FROM tbl_pesanan_penjualan");
		$row = $q->num_rows();

		if($row > 0){
      $rows = $q->result();
      $hasil = (int)$rows[0]->kode;
    } else {
      $hasil = 0;
    }
		return $hasil;
}
	public function update($data, $id)
	{
		
		$query = $this->db->update("tbl_penjualan", $data, $id);

		if($query){
			return true;
		}else{
			return false;
		}

	}

	public function hapus($id)
	{
		
		$query = $this->db->delete("tbl_penjualan", $id);

		if($query){
			return true;
		}else{
			return false;
		}

	}


}