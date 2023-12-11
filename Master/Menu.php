<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/utsku/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Data Pegawai', 'Link' => $base . 'data_pegawai'),
            array('Text' => 'Data Jabatan', 'Link' => $base . 'data_jabatan'),
            array('Text' => 'Hak Akses', 'Link' => $base . 'hak_akses'),
        ];
        return $data;
    }
}
