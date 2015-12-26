<?php
class Backup extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
	public function tool() {
	 
		  $data['title']="Data Petugas";
		  $this->template->display('backup/index');
		$this->load->helper('download');
		$this->load->dbutil();	
			
		$a['page']		= "backup";
		
		$mau_ke			= $this->uri->segment(3);
		
		if ($mau_ke == "backup") {
			$nama_file	= 'bck_perpustakaan_'.date('Y-m-d');
			$prefs = array(
					'format'      => 'txt',             // gzip, zip, txt
					'filename'    => $nama_file.'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
					'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
					'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
					'newline'     => "\n"               // Newline character used in backup file
				);

			$backup =&$this->dbutil->backup($prefs);
			
			force_download($nama_file.'.sql', $backup);
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Backup database berhasil</div>");
			redirect('backup/tool');
		} else if ($mau_ke == "optimize") {
			$result = $this->dbutil->optimize_database();
			if ($result !== FALSE) {
				$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Optimize database selesai</div>");
				redirect('backup/tool');
			} else {
				$this->session->set_flashdata("k", "<div class=\"alert alert-error\">Optimize database gagal</div>");
				redirect('backup/tool');
			}
 		} else if ($mau_ke == "restore") {
			$config['upload_path'] 		= './upload/temp';
			$config['allowed_types'] 	= 'sql';
			$config['max_size']			= '8000';
			$config['max_width']  		= '10000';
			$config['max_height'] 		= '10000';

			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('file_backup')) {
				$up_data	 	= $this->upload->data();
				
				$direktori		= './upload/temp/'.$up_data['file_name'];
				
				$isi_file		= file_get_contents($direktori);
				$_satustelu		= substr($isi_file, 0, 103);
				
				$string_query	= rtrim($isi_file, "\n;" );
				$array_query	= explode(";", $string_query);
				
				foreach ($array_query as $query){
					$this->db->query(trim($query));
				}
				
				$path			= './upload/temp/';
				$this->load->helper("file"); // load the helper
				delete_files($path, true);
				$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Restore data sukses</div>");
				redirect('backup/tool');
			} else {
				$this->session->set_flashdata("k", "<div class=\"alert alert-danger\" id=\"alert\">".$this->upload->display_errors()."</div>");
				redirect('backup/tool');
			}
		}
		
		}
}