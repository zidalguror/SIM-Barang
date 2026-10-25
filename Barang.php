<?php
class Barang
{
    public function __construct(
        public string $kode,
        public string $nama,
        public int $jumlah,
        public string $kategori = "",
        public string $kondisi = ""
    ) {
    }

    public function tampilkanInfo(): string
    {
        return "{$this->kode} - {$this->nama} ({$this->jumlah} unit)";
    }

    public function tampilkanBaris(): string
    {
        $kode     = htmlspecialchars($this->kode);
        $nama     = htmlspecialchars($this->nama);
        $kategori = htmlspecialchars($this->kategori);
        $kondisi  = htmlspecialchars($this->kondisi);
        return "<tr><td>$kode</td><td>$nama</td><td>$kategori</td><td>{$this->jumlah}</td><td>$kondisi</td></tr>";
    }
}