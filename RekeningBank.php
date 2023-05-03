<?php

function getConnection(): PDO
{
    $host = "localhost";
    $port = 3306;
    $database = "pemweb";
    $username = "root";
    $password = "password_baru";

    return new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
}

function noRekeningGenerator(): string
{
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Jakarta"));
    $noRekening = $date->format("ymdHis");
    return $noRekening;
}

function register($nama, $saldo, $jenis): void
{
    $noRek = noRekeningGenerator();
    $connection = getConnection();

    $sql = <<<SQL
        INSERT INTO rekening_bank(nama, saldo, norek, jenis)
        VALUES ('$nama','$saldo','$noRek','$jenis');
    SQL;

    try {
        $connection->exec($sql);
        header("location:DaftarRekening");
    }catch(PDOException $e){
        echo "Error : {$e->getMessage()}";
    }finally{
        $connection = null;
    }
}

function getAllRekening()
{
    $connection = getConnection();
    $sql = "SELECT * FROM rekening_bank;";        
    try {
        $table = $connection->query($sql);
    }catch(PDOException $e){
        echo "Error : {$e->getMessage()}";
    }finally{
        $connection = null;
    }
    return $table;
}

function getRekening($id)
{
    $connection = getConnection();
    $sql = "SELECT * FROM rekening_bank WHERE id='$id';";        
    try {
        $result = $connection->query($sql);
        foreach ($result as $row){
            $rekening = $row;
        }
    }catch(PDOException $e){
        echo "Error : {$e->getMessage()}";
    }finally{
        $connection = null;
    }
    return $rekening;
}

function deleteRekening($id)
{
    $connection = getConnection();

    $sql = "DELETE FROM rekening_bank WHERE id='$id';";
    try {
        $connection->exec($sql);
        header("location:DaftarRekening");
    }catch(PDOException $e){
        echo "Error : {$e->getMessage()}";
    }finally{
        $connection = null;
    }
}

function transfer($idPengirim, $idPenerima, $nominalTransfer)
{
    $connection = getConnection();
    $rekeningPengirim = getRekening($idPengirim);
    $rekeningPenerima = getRekening($idPenerima);

    try {
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        if($rekeningPengirim && $rekeningPenerima && $rekeningPengirim['saldo'] > $nominalTransfer){
            $connection->beginTransaction();
    
            $connection->exec("UPDATE rekening_bank SET saldo = saldo - $nominalTransfer WHERE id='$idPengirim';");
            $connection->exec("UPDATE rekening_bank SET saldo = saldo + $nominalTransfer WHERE id='$idPenerima';");
            
            $connection->commit();
        }
        
        header("location:DaftarRekening");
    } catch (Exception $error) {
        $connection->rollback();
        echo "Transaction error: ", $error->getMessage();
    }finally{
        $connection = null;
    }
} 

function insertTuples(array $tuples){
    foreach ($tuples as $tuple){
        $nama = $tuple['nama'];
        $saldo = $tuple['saldo'];
        $jenis = $tuple['jenis'];
        $noRek = noRekeningGenerator();
        $connection = getConnection();

        $sql = <<<SQL
            INSERT INTO rekening_bank(nama, saldo, norek, jenis)
            VALUES ('$nama','$saldo','$noRek','$jenis');
        SQL;

        try {
            $connection->exec($sql);
        }catch(PDOException $e){
            echo "Error : {$e->getMessage()}";
        }finally{
            $connection = null;
        }    
    }
}