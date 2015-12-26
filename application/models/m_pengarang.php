<?php
class M_pengarang extends CI_Model{
    private $table="pengarang";
    private $primary="id_pengarang";
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
	function get_all($offset = 0, $keywords = "none")
	{
		if($keywords && $keywords != "none") {
			$this->db->like("nama_pengarang", $keywords);
		}
		
		return $this->db->from($this->table)->limit($this->limit, $offset)->get()->result();
	}
	function combo_data($options = array())
	{
		$result = $this->db->get($this->table)->result();
		foreach($result as $row) {
			$options[$row->id_pengarang] = $row->nama_pengarang;
		}

		return $options;
	}
	function get_data($id)
	{
		return $this->db->get_where($this->table, array("id_pengarang" => $id))->row();
	}
	
    
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    
    function simpan($jenis){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }
    
    function update($kode,$jenis){
        $this->db->where($this->primary,$kode);
        $this->db->update($this->table,$jenis);
    }
    
    function hapus($kode){
        $this->db->where($this->primary,$kode);
        $this->db->delete($this->table);
    }
    
    function cari($cari){
        $this->db->like($this->primary,$cari);
        $this->db->or_like("nama_pengarang",$cari);
        return $this->db->get($this->table);
    }
}