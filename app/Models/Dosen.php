<?php

class Dosen
{
    private $dosen = [
        [
            'nidn' => '001',
            'nama' => 'Bu Qonita'
        ],
        [
            'nidn' => '002',
            'nama' => 'Pak Radit'
        ],
        [
            'nidn' => '003',
            'nama' => 'Bu Ulfa'
        ],
        [
            'nidn' => '004',
            'nama' => 'Pak Fikri'
        ],
        [
            'nidn' => '005',
            'nama' => 'Bu Nimah'
        ],
        [
            'nidn' => '006',
            'nama' => 'Pak Roki'
        ],
    ];

    public function getAll()    
    {
        return $this->dosen;
    }

    public function getByNidn($nidn)
    {
        foreach ($this->dosen as $dsn) {
            if ($dsn['nidn'] == $nidn) {
                return $dsn;
            }
        }

        return null;
    }
}