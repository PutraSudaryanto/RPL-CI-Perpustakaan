<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('penerbit/cari');?>" method="post">
        <div class="form-group">
            <label>Cari penerbit</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('penerbit/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>Id penerbit</td>
            <td>Nama penerbit</td>
			<td>Alamat penerbit</td>
            <td>Keterangan</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($penerbit as $row ): $no++;?>
    <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $row->id_penerbit;?></td>
        <td><?php echo $row->penerbit;?></td>
		<td><?php echo $row->alamat_penerbit;?></td>
        <td><?php echo $row->keterangan;?></td>
        <td><a href="<?php echo site_url('penerbit/edit/'.$row->id_penerbit);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_penerbit;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
    <?php endforeach;?>
</Table>


<script>
    $(function(){
        $(".hapus").click(function(){
            var kode=$(this).attr("kode");
            
            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });
        
        $("#konfirmasi").click(function(){
            var kode=$("#idhapus").val();
            
            $.ajax({
                url:"<?php echo site_url('penerbit/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('penerbit/index/delete_success');?>";
                }
            });
        });
    });
</script>