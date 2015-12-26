<?php
class M_buku extends CI_Model{
    private $table="buku";
    private $primary="kode_buku";
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type)){
            $this->db->order_by($this->primary,'asc');
			return $this->db->select("{$this->table}.*, dkm.penerbit")
						->from($this->table)
						->join("penerbit dkm", "{$this->table}.id_penerbit = dkm.id_penerbit", "left")
						->limit($this->limit, $offset)
						->get()
						->result();}
        else
            $this->db->order_by($order_column,$order_type);
			
        return $this->db->get($this->table,$limit,$offset);
			$this->db->select("{$this->table}.*, dkm.penerbit")
						->from($this->table)
						->join("penerbit dkm", "{$this->table}.id_penerbit = dkm.id_penerbit", "left")
						->limit($this->limit, $offset)
						->get()
						->result();
			$this->db->select("{$this->table}.*, dkm.nama_pengarang")
						->from($this->table)
						->join("pengarang dkm", "{$this->table}.id_pengarang = dkm.id_pengarang", "left")
						->limit($this->limit, $offset)
						->get()
						->result();
    }
    
    function jumlah(){
        return $this->db->count_all($this->table);
    }
	
	function get_data($id)
	{
		return $this->db->get_where($this->table, array("id_pengarang" => $id))->row();
	}
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
	function cariPengarang($nid){
        $this->db->where("id_pengarang",$nid);
        return $this->db->get("pengarang");
    }
    
    function simpan($info){
        $this->db->insert($this->table,$info);
        return $this->db->insert_id();
    }
    
    function update($kode,$info){
        $this->db->where($this->primary,$kode);
        return $this->db->update($this->table,$info);
    }
    
    function hapus($kode){
        $this->db->where($this->primary,$kode);
        $this->db->delete($this->table);
    }
    
    function cari($cari){
        $this->db->like($this->primary,$cari);
        $this->db->or_like("judul",$cari);
        return $this->db->get($this->table);
    }
}