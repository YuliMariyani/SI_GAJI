<?php

namespace Master;

use Config\Query_builder;

class data_jabatan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('data_jabatan')->get()->resultArray();
        $res = '<a href="?target=data_jabatan&act=tambah_data_jabatan" class="btn btn-info btn-sm">Tambah data_jabatan</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_jabatan</th>
                    <th>nama_jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="100">' . $r['id_jabatan'] . '</td>
                <td>' . $r['nama_jabatan'] . '</td>
                <td width="150">
                    <a href="?target=data_jabatan&act=edit_data_jabatan&id=' . $r['id_jabatan'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=data_jabatan&act=delete_data_jabatan&id=' . $r['id_jabatan'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=data_jabatan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=data_jabatan&act=simpan_data_jabatan">
            <div class="mb-3">
                <label for="id_jabatan" class="form-label">id_jabatan</label>
                <input type="text" class="form-control" id="id_jabatan" name="id_jabatan">
            </div>
            <div class="mb-3">
                <label for="nama_jabatan" class="form-label">nama_jabatan</label>
                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_jabatan = $_POST['id_jabatan'];
        $nama_jabatan = $_POST['nama_jabatan'];

        $data = array(
            'id_jabatan' => $id_jabatan,
            'nama_jabatan' => $nama_jabatan,
        );
        return $this->db->table('data_jabatan')->insert($data);
    }
    public function edit($id)
    {
        // get data data_jabatan
        $r = $this->db->table('data_jabatan')->where("id_jabatan='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=data_jabatan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=data_jabatan&act=update_data_jabatan">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_jabatan'] . '">

            <div class="mb-3">
                <label for="id_jabatan" class="form-label">id_jabatan</label>
                <input type="text" class="form-control" id="id_jabatan" name="id_jabatan" value="' . $r['id_jabatan'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_jabatan" class="form-label">id_jabatan</label>
                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="' . $r['nama_jabatan'] . '">
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
        $id_jabatan = $_POST['id_jabatan'];
        $nama_jabatan = $_POST['nama_jabatan'];

        $data = array(
            'id_jabatan' => $id_jabatan,
            'nama_jabatan' => $nama_jabatan,
        );
        return $this->db->table('data_jabatan')->where("id_jabatan='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('data_jabatan')->where("id_jabatan='$id'")->delete();
    }
}
