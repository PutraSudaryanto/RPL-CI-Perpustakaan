<table class="table table-striped">
        <thead>
            <tr>
                <td>Kode Buku</td>
                <td>Judul Buku</td>
                <td>Pengarang</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($buku as $tmp):?>
        <tr>
            <td><?php echo $tmp->buku;?></td>
            <td><?php echo $tmp->judul;?></td>
            <td><?php echo $tmp->nama_pengarang;?></td>
            <td><a href="#" class="tambah" kode="<?php echo $tmp->buku;?>"
            judul="<?php echo $tmp->judul;?>"
            pengarang="<?php echo $tmp->nama_pengarang;?>"><i class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>