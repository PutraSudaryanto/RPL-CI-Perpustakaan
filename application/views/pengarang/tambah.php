
<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="<?php echo site_url('pengarang/tambah');?>" method="post" enctype="multipart/form-data"> 
    <div class="form-group">
        <label class="col-lg-2 control-label">id pengarang</label>
        <div class="col-lg-5">
            <input type="text" name="id_pengarang" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">nama pengarang</label>
        <div class="col-lg-5">
            <input type="text" name="nama_pengarang" class="form-control">
        </div>
    </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">keterangan</label>
				<div class="col-lg-10">
            <textarea name="keterangan"></textarea>
        </div>
    </div>
	 <div class="form-group">
        <label class="col-lg-2 control-label">Image</label>
        <div class="col-lg-5">
            <input type="file" name="gambar" class="form-control">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('pengarang');?>" class="btn btn-default">Kembali</a>
    </div>
</form>
