<legend>Backup Database</legend>	
	<?php echo $this->session->flashdata("k");?>
	
Klik pada tombol "Backup" disamping untuk memulai proses backup &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_URL()?>index.php/backup/tool/backup" class="btn btn-success">Backup</a>

<br><br>
<legend>Optimize Database</legend>		
Klik pada tombol "Optimize" disamping untuk memulai proses optimize database &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_URL()?>index.php/backup/tool/optimize" class="btn btn-inverse">Optimize</a>


<br><br>
<legend>Restore Database</legend>		
<form action="<?php echo base_URL()?>index.php/backup/tool/restore" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	
	<label style="width: 150px; float: left">File Backup</label><input class="span4" type="file" name="file_backup" required><br>
	<button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin..? Hati-hati, semua data akan terhapus, lho...!!!');">Restore</button>
</form>