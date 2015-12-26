<?php
class klasifikasi extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_klasifikasi');

        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_klasifikasi',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_klasifikasi';
        if(empty($order_type)) $order_type='asc';
        
        //load data
		$data['title']="Data klasifikasi";
        $data['klasifikasi']=$this->m_klasifikasi->semua($this->limit,$offset,$order_column,$order_type)->result();
        //$data['alamat']=$this->m_klasifikasi->getAlamat()->result();
        $config['base_url']=site_url('klasifikasi/index/');
        $config['total_rows']=$this->m_klasifikasi->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message']='';
            $this->template->display('klasifikasi/index',$data);
    }
	 
    
    function edit($id){
        $data['title']="Edit Data klasifikasi";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $info=array(
                'id_klasifikasi'=>$this->input->post('id_klasifikasi'),
					'jenis_klasifikasi'=>$this->input->post('jenis_klasifikasi'),
                    'keterangan'=>$this->input->post('keterangan'),
            );
            //update data angggota
            $this->m_klasifikasi->update($id,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data klasifikasi 
            $data['klasifikasi']=$this->m_klasifikasi->cek($id)->row_array();
            $this->template->display('klasifikasi/edit',$data);
        }else{
            $data['klasifikasi']=$this->m_klasifikasi->cek($id)->row_array();
            $data['message']="";
            $this->template->display('klasifikasi/edit',$data);
        }
    }
    
    
    function tambah(){
        $data['title']="Tambah Data klasifikasi";
        $this->_set_rules();	
        if($this->form_validation->run()==true){
			$info=array(
				'jenis_klasifikasi'=>$this->input->post('jenis_klasifikasi'),
				'keterangan'=>$this->input->post('keterangan'),
			);
			$this->m_klasifikasi->simpan($info);
			redirect('klasifikasi/index/add_success');
        }else{
            $data['message']="";
            $this->template->display('klasifikasi/tambah',$data);
        }
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_klasifikasi->cek($kode)->result();
        $this->m_klasifikasi->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_klasifikasi->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['klasifikasi']=$cek->result();
            $this->template->display('klasifikasi/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['klasifikasi']=$cek->result();
            $this->template->display('klasifikasi/cari',$data);
        }
    }
    
    function _set_rules(){
		$this->form_validation->set_rules('jenis_klasifikasi','jenis_klasifikasi','required|max_length[60]');
        //$this->form_validation->set_rules('keterangan','keterangan','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}