<?php

class Mahasiswa
{
    private $nim;
    private $nama;
    private $prodi;
    private $dosenId;
    private $namaDosen;

    public function __construct($nim = null, $nama = null, $prodi = null, $dosenId = null)
    {
        if ($nim !== null) {
            $this->setNim($nim);
        }

        if ($nama !== null) {
            $this->setNama($nama);
        }

        if ($prodi !== null) {
            $this->setProdi($prodi);
        }

        if ($dosenId !== null) {
            $this->setDosenId($dosenId);
        }
    }

    //GETTER

    public function getNim()
    {
        return $this->nim;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getProdi()
    {
        return $this->prodi;
    }

    public function getDosenId()
    {
        return $this->dosenId;
    }

    public function getNamaDosen()
    {
        return $this->namaDosen;
    }

    //SETTER (dengan validasi)

    public function setNim($nim)
    {
        $nim = trim((string) $nim);

        if ($nim === '' || !ctype_digit($nim)) {
            throw new InvalidArgumentException('NIM harus berupa angka dan tidak boleh kosong.');
        }

        $this->nim = $nim;
    }

    public function setNama($nama)
    {
        $nama = trim((string) $nama);

        if ($nama === '') {
            throw new InvalidArgumentException('Nama mahasiswa tidak boleh kosong.');
        }

        $this->nama = $nama;
    }

    public function setProdi($prodi)
    {
        $prodi = trim((string) $prodi);

        if ($prodi === '') {
            throw new InvalidArgumentException('Program studi tidak boleh kosong.');
        }

        $this->prodi = $prodi;
    }

    public function setDosenId($dosenId)
    {
        $dosenId = trim((string) $dosenId);

        // Dosen pembimbing bersifat opsional, boleh dikosongkan.
        if ($dosenId === '') {
            $this->dosenId = null;
            return;
        }

        if (!ctype_digit($dosenId)) {
            throw new InvalidArgumentException('ID Dosen harus berupa angka.');
        }

        $this->dosenId = $dosenId;
    }

    public function setNamaDosen($namaDosen)
    {
        $this->namaDosen = $namaDosen;
    }

    // Bantuan untuk ditampilkan di View (mis. foreach di tabel).
    public function toArray()
    {
        return [
            'nim' => $this->nim,
            'nama' => $this->nama,
            'prodi' => $this->prodi,
            'dosen_id' => $this->dosenId,
            'nama_dosen' => $this->namaDosen,
        ];
    }
}
