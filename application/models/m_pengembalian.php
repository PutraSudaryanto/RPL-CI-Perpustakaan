<?php
class M_Pengembalian extends CI_Model{
    
    function cariTransaksi($no){
        $query=$this->db->query("select a.*,b.nama from transaksi a,
                                anggota b
                                where a.id_transaksi='$no' and a.id_transaksi
                                not in(select id_transaksi from pengembalian)
                                and a.nia=b.nia");
        return $query;
    }
    
    function tampilBuku($no){
        $query=$this->db->query("select a.*,b.judul,b.pengarang
                                from transaksi a,buku b
                                where a.id_transaksi='$no' and
                                a.id_transaksi not in(select id_transaksi from pengembalian)
                                and a.kode_buku=b.kode_buku");
        return $query;
    }
    
    function simpan($info){
        $this->db->insert("pengembalian",$info);
    }
    
    function update($no,$update){
        $this->db->where("id_transaksi",$no);
        $this->db->update("transaksi",$update);
    }
    
    function cari_by_nia($nia){
        $query=$this->db->query("SELECT a.`id_transaksi`, a.`nia`, a.`tanggal_pinjam` FROM `transaksi` AS a LEFT JOIN `pengembalian` AS b ON a.`id_transaksi` = b.`id_transaksi` LEFT JOIN `anggota` AS c ON a.`nia`=c.`nia` WHERE c.`nama` LIKE'%$nia%' AND b.`id_transaksi` IS NULL GROUP BY a.`nia`");
        return $query;
    }
}