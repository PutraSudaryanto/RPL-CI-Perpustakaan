
<legend><?php echo $title;?></legend>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" />
    <?php echo validation_errors(); echo $message;?>
    <div class="form-group">
        <label class="col-lg-2 control-label">Kode Buku</label>
        <div class="col-lg-5">
            <input type="text" name='Model[kode_buku]' class="form-control">
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Judul Buku</label>
        <div class="col-lg-5">
            <input type="text" name='Model[judul]' class="form-control">
        </div>
    </div>
	<div class="form-group">
        <label class="col-lg-2 control-label">penerbit</label>
        <div class="col-lg-5">
                 
                           <?php 	   
				?>
				<?php echo form_dropdown('Model[id_penerbit]',$combo_penerbit, null, "class='form-control'");?>
            
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Pengarang</label>
                    <div class="col-lg-5">
                        <?php /*<select name="pengarang" class="form-control" id="pengarang">
                           <option></option>
                           <?php foreach($anggota as $anggota):?>
                           <option value="<?php echo $anggota->nid;?>"><?php echo $anggota->nid;?></option>
                            <?php endforeach;?>
                        </select>*/?>
						<?php echo form_dropdown('Model[id_pengarang]',$combo_pengarang, null, "class='form-control'");?>
                    </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Klasifikasi</label>
        <div class="col-lg-5">
                 
                           <?php 
				?>
				<?php echo form_dropdown('Model[id_klasifikasi]',$combo_klasifikasi, null, "class='form-control'");?>
           
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-2 control-label">Image</label>
        <div class="col-lg-5">
            <input type="file" name='gambar' class="form-control">
        </div>
    </div>
    
    <div class="form-group well">
        <button class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
        <a href="<?php echo site_url('buku');?>" class="btn btn-default">Kembali</a>
    </div>
</form>