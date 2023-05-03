<?php
require_once "RekeningBank.php";

if (isset($_POST['nama']) && isset($_POST['saldo'] )&& isset($_POST['jenis'])) {    
    $nama = $_POST['nama'];
    $saldo = $_POST['saldo'];
    $jenis = $_POST['jenis'];

    register($nama, $saldo, $jenis);
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    deleteRekening($id);
} else if(isset($_POST['idPengirim']) && isset($_POST['idPenerima']) && isset($_POST['nominalTransfer'])){
    $idPengirim = $_POST['idPengirim'];
    $idPenerima = $_POST['idPenerima'];
    $nominalTransfer = $_POST['nominalTransfer'];

    transfer($_POST['idPengirim'], $_POST['idPenerima'], $_POST['nominalTransfer']);
}