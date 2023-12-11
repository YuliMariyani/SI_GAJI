<?php

namespace Master;

use Config\Query_builder;

class data_pegawai
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('data_pegawai')->get()->resultArray();
        $res = '<a href="?target=data_pegawai&act=tambah_data_pegawai" class="btn btn-info btn-sm">Tambah data_pegawai</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>NIP</th>
                    <th>nama_pegawai</th>
                    <th>jenis_kelamin</th>
                    <th>jabatan</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="100">' . $r['NIP'] . '</td>
                <td>' . $r['nama_pegawai'] . '</td>
                <td>' . $r['jenis_kelamin'] . '</td>
                <td>' . $r['jabatan'] . '</td>
                <td width="150">
                    <a href="?target=data_pegawai&act=edit_data_pegawai&id=' . $r['NIP'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=data_pegawai&act=delete_data_pegawai&id=' . $r['NIP'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=data_pegawai" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=data_pegawai&act=simpan_data_pegawai">
            <div class="mb-3">
                <label for="NIP" class="form-label">NIP</label>
                <input type="text" class="form-control" id="NIP" name="NIP">
            </div>
            <div class="mb-3">
                <label for="nama_pegawai" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai">
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">jenis_kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
            </div>
            <div class="mb-3">
            <label for="jabatan" class="form-label">jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan">
        </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $NIP = $_POST['NIP'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $jabatan = $_POST['jabatan'];
        $data = array(
            'NIP' => $NIP,
            'nama_pegawai' => $nama_pegawai,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan' => $jabatan,
        );
        return $this->db->table('data_pegawai')->insert($data);
    }
    public function edit($id)
    {
        // get data data_pegawai
        $r = $this->db->table('data_pegawai')->where("NIP='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=data_pegawai" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=data_pegawai&act=update_data_pegawai">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['NIP'] . '">
            <div class="mb-3">
                <label for="NIP" class="form-label">ID</label>
                <input type="text" class="form-control" id="NIP" name="NIP" value="' . $r['NIP'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_pegawai" class="form-label">Nama data_pegawai</label>
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="' . $r['nama_pegawai'] . '">
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">jenis_kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="' . $r['jenis_kelamin'] . '">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="' . $r['jabatan'] . '">
            </div>



            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2)
    {
        if ($val == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $NIP = $_POST['NIP'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $jabatan = $_POST['jabatan'];

        $data = array(
            'NIP' => $NIP,
            'nama_pegawai' => $nama_pegawai,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan' => $jabatan,
        );
        return $this->db->table('data_pegawai')->where("NIP='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('data_pegawai')->where("NIP='$id'")->delete();
    }
}
