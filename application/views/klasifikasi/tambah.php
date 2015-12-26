
<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="<?php echo site_url('klasifikasi/tambah');?>" method="post" enctype="multipart/form-data"> 
    <div class="form-group">
        <label class="col-lg-2 control-label">Id klasifikasi</label>
        <div class="col-lg-5">
            <input type="text" name="id_klasifikasi" class="form-control">
        </div>
    </div>
	    <div class="form-group">
        <label class="col-lg-2 control-label">Jenis klasifikasi</label>
        <div class="col-lg-5">
            <input type="text" name="jenis_klasifikasi" class="form-control">
        </div>
    </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Keterangan</label>
        <div class="col-lg-10">
            <textarea name="keterangan"></textarea>
        </div>
			</div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('klasifikasi');?>" class="btn btn-default">Kembali</a>
    </div>
</form>
