<?php
class Pengarang extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','pagination','form_validation','upload'));
        $this->load->model('m_pengarang');

        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function index($offset=0,$order_column='id_pengarang',$order_type='asc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id_pengarang';
        if(empty($order_type)) $order_type='asc';
        
        //load data
		$data['title']="Data pengarang";
        $data['pengarang']=$this->m_pengarang->semua($this->limit,$offset,$order_column,$order_type)->result();
        //$data['alamat']=$this->m_pengarang->getAlamat()->result();
        $config['base_url']=site_url('pengarang/index/');
        $config['total_rows']=$this->m_pengarang->jumlah();
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
            $this->template->display('pengarang/index',$data);
    }
	 
    
    function edit($id){
        $data['title']="Edit Data pengarang";
        $this->_set_rules();
        if($this->form_validation->run()==true){
		//setting konfiguras upload image
		$config['upload_path'] = './assets/img/pengarang/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']	= '1000';
	    $config['max_width']  = '2000';
	    $config['max_height']  = '1024';
                
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('gambar')){
                $gambar="";
            }else{
                $gambar=$this->upload->file_name;
            }
            
            $info=array(
                'nama_pengarang'=>$this->input->post('nama_pengarang'),
                'keterangan'=>$this->input->post('keterangan'),
                'image'=>$gambar
            );
            //update data angggota
            $this->m_pengarang->update($id,$info);
            
            //tampilkan pesan
            $data['message']="<div class='alert alert-success'>Data Berhasil diupdate</div>";
            
            //tampilkan data pengarang 
            $data['pengarang']=$this->m_pengarang->cek($id)->row_array();
            $this->template->display('pengarang/edit',$data);
        }else{
            $data['pengarang']=$this->m_pengarang->cek($id)->row_array();
            $data['message']="";
            $this->template->display('pengarang/edit',$data);
        }
    }
    
    
    function tambah(){
        $data['title']="Tambah Data pengarang";
        $this->_set_rules();	
        if($this->form_validation->run()==true){
			//setting konfiguras upload image
			$config['upload_path'] = './assets/img/pengarang/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '2000';
			$config['max_height']  = '1024';
			
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar')){
				$gambar="";
			}else{
				$gambar=$this->upload->file_name;
			}
			
			$info=array(
				'nama_pengarang'=>$this->input->post('nama_pengarang'),
				'keterangan'=>$this->input->post('keterangan'),
				'image'=>$gambar
			);
			$this->m_pengarang->simpan($info);
			redirect('pengarang/index/add_success');
        }else{
            $data['message']="";
            $this->template->display('pengarang/tambah',$data);
        }
    }
    
    
    function hapus(){
        $kode=$this->input->post('kode');
        $detail=$this->m_pengarang->cek($kode)->result();
	foreach($detail as $det):
	    unlink("assets/img/pengarang/".$det->image);
	endforeach;
        $this->m_pengarang->hapus($kode);
    }
    
    function cari(){
        $data['title']="Pencarian";
        $cari=$this->input->post('cari');
        $cek=$this->m_pengarang->cari($cari);
        if($cek->num_rows()>0){
            $data['message']="";
            $data['pengarang']=$cek->result();
            $this->template->display('pengarang/cari',$data);
        }else{
            $data['message']="<div class='alert alert-success'>Data tidak ditemukan</div>";
            $data['pengarang']=$cek->result();
            $this->template->display('pengarang/cari',$data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('nama_pengarang','nama_pengarang','required|max_length[50]');
        //$this->form_validation->set_rules('keterangan','keterangan','required|max_length[50]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}