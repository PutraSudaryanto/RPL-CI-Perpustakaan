<?php
class M_buku extends CI_Model{
    private $table="buku";
    private $viewTable="view_buku";
    private $primary="kode_buku";
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->viewTable,$limit,$offset);
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
		if(!empty($info)) {
			foreach($info as $key => $val)
				$data[$key] = $val;
		} else
			$data = $_POST['Model'];
		
        $this->db->where($this->primary,$kode);
        return $this->db->update($this->table,$data);
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