<div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('klasifikasi/cari');?>" method="post">
        <div class="form-group">
            <label>Cari klasifikasi</label>
            <input type="text" class="form-control" placeholder="Search" name="cari">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
</div>
<a href="<?php echo site_url('klasifikasi/tambah');?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
<hr>
<?php echo $message;?>
<Table class="table table-striped">
    <thead>
        <tr>
            <td>No.</td>
            <td>Id klasifikasi</td>
            <td>jenis klasifikasi</td>
            <td>Keterangan</td>
            <td colspan="2"></td>
        </tr>
    </thead>
    <?php $no=0; foreach($klasifikasi as $row ): $no++;?>
    <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $row->id_klasifikasi;?></td>
        <td><?php echo $row->jenis_klasifikasi;?></td>
        <td><?php echo $row->keterangan;?></td>
        <td><a href="<?php echo site_url('klasifikasi/edit/'.$row->id_klasifikasi);?>"><i class="glyphicon glyphicon-edit"></i></a></td>
        <td><a href="#" class="hapus" kode="<?php echo $row->id_klasifikasi;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                url:"<?php echo site_url('klasifikasi/hapus');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('klasifikasi/index/delete_success');?>";
                }
            });
        });
    });
</script>