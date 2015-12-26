<?php
class Penerbit extends CI_Model 
{
	var $_table;
        
	function __construct()
	{
		parent::__construct();
		$this->_table = 'penerbit';
	}
	
	function findAll($limit=10, $offset=0, $condition=null)
	{
		if($condition == null) {
			//primary key
			$this->db->order_by('id_penerbit', 'desc');
			
		} else {
			if(!empty($condition['select']))
				$this->db->select($condition['select']);
			if(!empty($condition['condition']))
				$this->db->where($condition['condition']);
			//primary key
			if(!empty($condition['order']))
				$this->db->order_by('id_penerbit', 'desc'); 
			else {
				foreach($condition['order'] as $key => $val)
					$this->db->order_by($key, strtolower($val)); 
			}
		}
		$this->db->limit($limit, $offset);
			
		$model = $this->db->get($this->_table);
		return $model->result();
	}
	
	function find($condition=null)
	{
		if(!empty($condition['select']))
			$this->db->select($condition['select']);
		if(!empty($condition['condition']))
			$this->db->where($condition['condition']);
		//primary key
		if(!empty($condition['order']))
			$this->db->order_by('id_penerbit', 'desc'); 
		else {
			foreach($condition['order'] as $key => $val)
				$this->db->order_by($key, strtolower($val)); 
		}
		$this->db->limit(1);
		$model = $this->db->get($this->_table);
		return $model->row();
	}
	
	function findByPk($id, $condition=null)
	{
		if(!empty($condition['select']))
			$this->db->select($condition['select']);
		//primary key
		$this->db->where('id_penerbit', $id);
		$model = $this->db->get($this->_table);
		return $model->row();
	}
	
	function count_all()
	{
		$model = $this->db->count_all($this->_table);
		return $model;
	}
	
	function insertData()
	{
		$data = $_POST['Model'];
		return $this->db->insert($this->_table, $data);
	}
	
	function updateByPk($id)
	{
		$data = $_POST['Model'];
		//primary key
		$this->db->where('id_penerbit', $id);
		return $this->db->update($this->_table, $data);
	}
	
	function deleteByPk($id)
	{
		//primary key
		$this->db->where('id_penerbit', $id);
		return $this->db->delete($this->_table);
	}
	
 
}
?>