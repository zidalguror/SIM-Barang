CREATE DATABASE IF NOT EXISTS sim_barang
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sim_barang;

DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS kategori;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id_user      INT AUTO_INCREMENT PRIMARY KEY,
  username     VARCHAR(50)  NOT NULL UNIQUE,
  password     VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100) NOT NULL
);

CREATE TABLE kategori (
  id_kategori   INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE barang (
  id_barang    INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang  VARCHAR(20)  NOT NULL UNIQUE,
  nama_barang  VARCHAR(100) NOT NULL,
  id_kategori  INT NOT NULL,
  jumlah       INT NOT NULL DEFAULT 0,
  harga_satuan DECIMAL(15,2) NOT NULL DEFAULT 0,
  kondisi      ENUM('Baik','Rusak Ringan','Rusak Berat') NOT NULL DEFAULT 'Baik',
  CONSTRAINT fk_barang_kategori FOREIGN KEY (id_kategori)
    REFERENCES kategori(id_kategori)
    ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO users (username, password, nama_lengkap) VALUES
('admin',   SHA2('password123', 256), 'Administrator'),
('petugas', SHA2('lab12345', 256),    'Petugas Laboratorium');

INSERT INTO kategori (nama_kategori) VALUES
('Elektronik'), ('Perabot'), ('Alat Laboratorium');

INSERT INTO barang (kode_barang, nama_barang, id_kategori, jumlah, harga_satuan, kondisi) VALUES
('BRG-001', 'Laptop',    1, 10, 7500000, 'Baik'),
('BRG-002', 'Proyektor', 1, 3,  5000000, 'Baik'),
('BRG-003', 'Kursi Lab', 2, 25, 350000,  'Rusak Ringan');