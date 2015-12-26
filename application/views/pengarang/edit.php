<legend><?php echo $title;?></legend>
<?php echo validation_errors();?>
<?php echo $message;?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-lg-2 control-label">Nama Pengarang</label>
        <div class="col-lg-5">
            <input type="text" name="nama_pengarang" class="form-control" value="<?php echo $pengarang['nama_pengarang'];?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Keterangan</label>
        <div class="col-lg-10">
            <textarea name="keterangan"></textarea>
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">Image</label>
        <div class="col-lg-5">
            <img src="<?php echo base_url('assets/img/pengarang/'.$pengarang['image']);?>" width="200px" height="200px">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-5">
            <input type="file" name="gambar" class="form-control">
        </div>
    </div>
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Update</button>
        <a href="<?php echo site_url('pengarang');?>" class="btn btn-default">Kembali</a>
    </div>
</form>