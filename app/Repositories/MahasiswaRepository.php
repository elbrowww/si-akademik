<?php

require_once __DIR__ . '/../Models/Mahasiswa.php';

/**
 * Class MahasiswaRepository
 *
 * Menerima objek Database melalui constructor (constructor injection),
 * lalu bertugas melakukan seluruh operasi CRUD data mahasiswa ke
 * database. Controller tidak perlu tahu detail query SQL.
 */
class MahasiswaRepository
{
    private $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT mahasiswa.*, dosen.nama AS nama_dosen
                FROM mahasiswa
                LEFT JOIN dosen ON mahasiswa.dosen_id = dosen.id
                ORDER BY mahasiswa.nama ASC";

        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'mapToEntity'], $rows);
    }

    public function getByNim($nim)
    {
        $sql = "SELECT mahasiswa.*, dosen.nama AS nama_dosen
                FROM mahasiswa
                LEFT JOIN dosen ON mahasiswa.dosen_id = dosen.id
                WHERE mahasiswa.nim = :nim";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->mapToEntity($row) : null;
    }

    public function create(Mahasiswa $mahasiswa)
    {
        $sql = "INSERT INTO mahasiswa (nim, nama, prodi, dosen_id)
                VALUES (:nim, :nama, :prodi, :dosen_id)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nim' => $mahasiswa->getNim(),
            'nama' => $mahasiswa->getNama(),
            'prodi' => $mahasiswa->getProdi(),
            'dosen_id' => $mahasiswa->getDosenId(),
        ]);
    }

    public function update($nim, Mahasiswa $mahasiswa)
    {
        $sql = "UPDATE mahasiswa
                SET nama = :nama, prodi = :prodi, dosen_id = :dosen_id
                WHERE nim = :nim";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nim' => $nim,
            'nama' => $mahasiswa->getNama(),
            'prodi' => $mahasiswa->getProdi(),
            'dosen_id' => $mahasiswa->getDosenId(),
        ]);
    }

    public function delete($nim)
    {
        $stmt = $this->pdo->prepare("DELETE FROM mahasiswa WHERE nim = :nim");

        return $stmt->execute(['nim' => $nim]);
    }

    private function mapToEntity(array $row)
    {
        $mahasiswa = new Mahasiswa($row['nim'], $row['nama'], $row['prodi'], $row['dosen_id']);
        $mahasiswa->setNamaDosen($row['nama_dosen'] ?? null);

        return $mahasiswa;
    }
}
