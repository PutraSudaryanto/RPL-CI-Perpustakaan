<?php
class Penerbit extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_penerbit');

        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_penerbit',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_penerbit';
        if(empty($order_type)) $order_type='asc';
        
        //load data
		$data['title']="Data penerbit";
        $data['penerbit']=$this->m_penerbit->semua($this->limit,$offset,$order_column,$order_type)->result();
        //$data['alamat']=$this->m_penerbit->getAlamat()->result();
        $config['base_url']=site_url('penerbit/index/');
        $config['total_rows']=$this->m_penerbit->jumlah();
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
            $this->template->display('penerbit/index',$data);
    }
	 
    
    function edit($id){
        $data['title']="Edit Data penerbit";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $id_penerbit=$this->input->post('id_penerbit');
            $info=array(
                'id_penerbit'=>$this->input->post('id_penerbit'),
                    'penerbit'=>$this->input->post('penerbit'),
					'alamat_penerbit'=>$this->input->post('alamat_penerbit'),
                    'keterangan'=>$this->input->post('keterangan'),
            );
            //update data angggota
            $this->m_penerbit->update($id_penerbit,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data penerbit 
            $data['penerbit']=$this->m_penerbit->cek($id)->row_array();
            $this->template->display('penerbit/edit',$data);
        }else{
            $data['penerbit']=$this->m_penerbit->cek($id)->row_array();
            $data['message']="";
            $this->template->display('penerbit/edit',$data);
        }
    }
    
    
    function tambah(){
        $data['title']="Tambah Data penerbit";
        $this->_set_rules();	
        if($this->form_validation->run()==true){
            $id_penerbit=$this->input->post('id_penerbit');
            $cek=$this->m_penerbit->cek($id_penerbit);
		//$data['list_keterangan'] = $list_keterangan;
            if($cek->num_rows()>0){
                $data['message']="<div class='alert alert-warning'>id_penerbit sudah digunakan</div>";
                $this->template->display('penerbit/tambah',$data);
            }else{
                $info=array(
                    'id_penerbit'=>$this->input->post('id_penerbit'),
                    'penerbit'=>$this->input->post('penerbit'),
					'alamat_penerbit'=>$this->input->post('alamat_penerbit'),
                    'keterangan'=>$this->input->post('keterangan'),
                );
                $this->m_penerbit->simpan($info);
                redirect('penerbit/index/add_success');
            }
        }else{
            $data['message']="";
            $this->template->display('penerbit/tambah',$data);
        }
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_penerbit->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/penerbit/".$det->image);
	endforeach;
        $this->m_penerbit->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_penerbit->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['penerbit']=$cek->result();
            $this->template->display('penerbit/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['penerbit']=$cek->result();
            $this->template->display('penerbit/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id_penerbit','id_penerbit','required|max_length[10]');
        $this->form_validation->set_rules('penerbit','penerbit','required|max_length[50]');
		$this->form_validation->set_rules('alamat_penerbit','alamat_penerbit','required|max_length[60]');
        //$this->form_validation->set_rules('keterangan','keterangan','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}