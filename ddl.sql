CREATE TABLE rekening_bank 
(
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    norek VARCHAR(12) NOT NULL,
    saldo INT NOT NULL,
    jenis VARCHAR(10) NOT NULL,
    PRIMARY KEY(id)
);