<?php

namespace Master;

use Config\Query_builder;

class hak_akses
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('hak_akses')->get()->resultArray();
        $res = '<a href="?target=hak_akses&act=tambah_hak_akses" class="btn btn-info btn-sm">Tambah hak_akses</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id_akses</th>
                    <th>Keterangan</th>
                    <th>akses</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['id_akses'] . '</td>
                <td>' . $r['keterangan'] . '</td>
                <td>' . $r['akses'] . '</td>
                <td width="150">
                    <a href="?target=hak_akses&act=edit_hak_akses&id=' . $r['id_akses'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=hak_akses&act=delete_hak_akses&id=' . $r['id_akses'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=hak_akses" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=hak_akses&act=simpan_hak_akses">
            <div class="mb-3">
                <label for="id_akses" class="form-label">id_akses</label>
                <input type="text" class="form-control" id="id_akses" name="id_akses">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="mb-3">
                <label for="akses" class="form-label">akses</label>
                <input type="text" class="form-control" id="akses" name="akses">
            </div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_akses = $_POST['id_akses'];
        $keterangan = $_POST['keterangan'];
        $akses = $_POST['akses'];
        
        $data = array(
            'id_akses' => $id_akses,
            'keterangan' => $keterangan,
            'akses' => $akses,
            
        );
        return $this->db->table('hak_akses')->insert($data);
    }
    public function edit($id)
    {
        // get data hak_akses
        $r = $this->db->table('hak_akses')->where("id_hak_akses='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=hak_akses" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=hak_akses&act=update_hak_akses">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_hak_akses'] . '">

            <div class="mb-3">
                <label for="id_hak_akses" class="form-label">id_akses</label>
                <input type="text" class="form-control" id="id_hak_akses" name="id_hak_akses" value="' . $r['id_hak_akses'] . '">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="' . $r['keterangan'] . '">
            </div>
            <div class="mb-3">
                <label for="akses" class="form-label">akses</label>
                <input type="text" class="form-control" id="akses" name="akses" value="' . $r['akses'] . '">
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
        $id_akses = $_POST['id_akses'];
        $keterangan = $_POST['keterangan'];
        $akses = $_POST['akses'];
        
       
        $data = array(
            'id_akses' => $id_akses,
            'keterangan' => $keterangan,
            'akses' => $akses,
            
            
        );
        return $this->db->table('hak_akses')->where("id_akses='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('hak_akses')->where("id_akses='$id'")->delete();
    }
}
