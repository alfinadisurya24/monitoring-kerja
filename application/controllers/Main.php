    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Main extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            //Do your magic here
            $this->load->model('General_m');
            $this->load->helper('helpers');
            $this->load->helper('download');
        }


        public function index($content = null)
        {  
            if (!$this->session->userdata('authenticated_cms')){
                $this->load->view('login');
            }else {
                switch ($content) {
                    case 'pekerjaan':
                        $data = [
                            'page'      => $content,
                            'title'     => 'Pekerjaan | Monitoring Pekerjaan',
                            'header'    => 'Pekerjaan',
                            'getData'   => $this->General_m->select('pekerjaan', [], 'result', 'tanggal', 'desc'),
                            'section'   => 'content/pekerjaan'
                        ];
                        break;

                    case 'user':
                        $data = [
                            'page'      => $content,
                            'title'     => 'User | Monitoring Pekerjaan',
                            'header'    => 'User',
                            'getData'   => $this->General_m->select('user', [], 'result'),
                            'section'   => 'content/user'
                        ];
                        break;
                    
                    default:
                        $data = [
                            'title'     => 'Dashboard | Monitoring Pekerjaan',
                            'header'    => 'Dashboard',
                            'getData'   => $this->General_m->select('pekerjaan', ['tanggal' => date('Y-m-d')], 'result', 'tanggal', 'desc'),
                            'sukses'    => $this->General_m->select('pekerjaan', ['tanggal' => date('Y-m-d'), 'status' => 'selesai'], 'num_rows', 'tanggal', 'desc'),
                            'jumlah_pekerjaan'   => $this->General_m->select('pekerjaan', [], 'num_rows', 'tanggal', 'desc'),
                            'section'   => 'content/home'
                        ];
                        break;
                }
                $this->load->view('main', $data);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Load View Form Create atau Update Data
        |--------------------------------------------------------------------------
        */
        public function proses($type = NULL, $action = NULL, $id = NULL) {
            switch ($type) {

                case 'user':
                    if ($action == 'create') {
                        $field = new stdClass();
                            $field->id      = null;
                            $field->username      = null;
                    }else {
                        $field = $this->General_m->select('user', ['id' => $id], 'row');
                    }
                    $data = [
                        'page'      => $type,
                        'title'     => 'User | Monitoring Pekerjaan',
                        'header'     => ucfirst($action) .' User',
                        'action'    => $action,
                        'field'     => $field,
                        'section'   => 'form/form_user'
                    ];
                    break;
                    
                case 'pekerjaan':
                    if ($action == 'create') {
                        $field = new stdClass();
                            $field->id        = null;
                            $field->pekerjaan = null;
                            $field->tanggal   = null;
                            $field->jam       = null;
                    }else {

                        $field = $this->General_m->select('pekerjaan', ['id' => $id], 'row');
                    }
                    $data = [
                        'page'      => $type,
                        'title'     => 'Pekerjaan | Monitoring Pekerjaan',
                        'header'     => ucfirst($action) .' Pekerjaan',
                        'action'    => $action,
                        'field'     => $field,
                        'section'   => 'form/pekerjaan'
                    ];
                    break;
            }
            $this->load->view('main', $data);
        }

        /*
        |--------------------------------------------------------------------------
        | Action Create Data
        |--------------------------------------------------------------------------
        */
        public function create($type = null){
            switch ($type) {
                case 'pekerjaan':
                    $table = "pekerjaan" ;
                    $data = [
                        'pekerjaan'    => $this->input->post('pekerjaan'),
                        'tanggal'     => $this->input->post('tanggal'),
                        'jam'            => $this->input->post('jam')
                    ];

                    $jumlah = $this->General_m->select('pekerjaan', ['tanggal' => $this->input->post('tanggal')], 'num_rows');
                    if ($jumlah > 3) {
                        $this->session->set_flashdata([
                            'alert'     => 'danger',
                            'message'   => '<strong>Create Gagal, jumlah pekerjaan tanggal '. tanggal_indo($this->input->post('tanggal')) .' sudah mencapai 4 perkarjaan. <i class="fa fa-times-circle"></i></strong>',
                        ]);
                        redirect('main/index/'.$type.'');
                        die;
                    }
                break;

                break;
            }


            if ($this->General_m->save($table, $data)) {
                $this->session->set_flashdata([
                    'alert'     => 'success',
                    'message'   => '<strong>Create Sukses <i class="fa fa-check-circle"></i></strong>',
                    ]);
            }else {
                $this->session->set_flashdata([
                    'alert'     => 'danger',
                    'message'   => '<strong>Create Gagal <i class="fa fa-times-circle"></i></strong>',
                    ]);
            }
            redirect('main/index/'.$type.'');
        }

        /*
        |--------------------------------------------------------------------------
        | Action Update Data
        |--------------------------------------------------------------------------
        */
        public function update($type = null){
            switch ($type) {
                case 'pekerjaan':
                    $table = "pekerjaan" ;
                    $where = ['id' => $this->input->post('id')];
                    $data = [
                        'pekerjaan'    => $this->input->post('pekerjaan'),
                        'tanggal'     => $this->input->post('tanggal'),
                        'jam'            => $this->input->post('jam'),
                        'status'          => $this->input->post('status'),
                        'keterangan'       => $this->input->post('keterangan')
                    ];
        
                    if (!empty($_FILES['imagesUpload']['name'][0])) {
                        $get = $this->General_m->select('pekerjaan', $where, 'row');
                        $gambar = explode(';', $get->foto);
                        for ($i=0; $i < count($gambar) ; $i++) { 
                            $fileSource     = './uploads/images/'. $gambar[$i];
                            if (file_exists($fileSource) && $gambar[$i] != NULL) {
                                unlink($fileSource);
                            }
                        }
                        $data['foto'] = $this->imagesUpload();
                    }

                    if (!empty($_FILES['uploadPdf']['name'])) {
                        $data['file_pdf'] = $this->filesUpload('uploadPdf', 'file_pdf', 'UploadUpdate', 'update', 'pekerjaan' , 'id');
                    }
                    
                break; 
                case 'user':
                    $table = "user" ;
                    $where = ['id' => $this->input->post('id')];
                    $data = [
                        'username'    => $this->input->post('username')
                    ];

                    if ($this->input->post('pin') != '') {
                        $data['pin'] = md5($this->input->post('pin'));
                    }

                    if ($this->input->post('pin') != $this->input->post('pin_confirm')) {
                        $this->session->set_flashdata([
                            'alert'     => 'danger',
                            'message'   => '<strong>Password tidak serasi <i class="fa fa-check-circle"></i></strong>',
                        ]);
                        redirect('main/proses/user/update/'.$this->input->post('id'));
                        die;
                    }
                    
                break;
            }
            
            if ($this->General_m->update($table, $data, $where)) {
                $this->session->set_flashdata([
                    'alert'     => 'success',
                    'message'   => '<strong>Update Sukses <i class="fa fa-check-circle"></i></strong>',
                    ]);
            }else {
                $this->session->set_flashdata([
                    'alert'     => 'danger',
                    'message'   => '<strong>Update Gagal <i class="fa fa-times-circle"></i></strong>',
                    ]);
            }
            redirect('main/index/'.$type.'');
        }

        /*
        |--------------------------------------------------------------------------
        | Action Delete Data
        |--------------------------------------------------------------------------
        */
        public function delete($type = null){
            switch ($type) {
                case 'pekerjaan':
                    $table = "pekerjaan" ;
                    $where = ['id' => $this->input->post('id')];
                    $get = $this->General_m->select('pekerjaan', $where, 'row');
                    $gambar = explode(';', $get->foto);
                    for ($i=0; $i < count($gambar) ; $i++) { 
                        $fileSource     = './uploads/images/'. $gambar[$i];
                        if (file_exists($fileSource) && $gambar[$i] != NULL) {
                            unlink($fileSource);
                        }
                    }

                    $this->filesUpload('uploadPdf', 'file_pdf', 'UploadDelete', 'delete', 'pekerjaan' , 'id');
                break;
            }

            if ($this->General_m->delete($table, $where)) {
                $this->session->set_flashdata([
                    'alert'     => 'success',
                    'message'   => '<strong>Delete Sukses <i class="fa fa-check-circle"></i></strong>',
                    ]);
            }else {
                $this->session->set_flashdata([
                    'alert'     => 'danger',
                    'message'   => '<strong>Delete Gagal <i class="fa fa-times-circle"></i></strong>',
                    ]);
            }
            redirect('main/index/'.$type.'');
        }

        public function detailJson($id = null)
        {
            $where = ['id' => $id];
            $get = $this->General_m->select('pekerjaan', $where, 'row');

            echo json_encode($get);
        }


        // public function v_register()
        // {
        //     $this->load->view('register');
        // }

        // public function register(){
        //     $namaDepan      = $this->input->post('namaDepan');
        //     $namaBelakang   = $this->input->post('namaBelakang');
        //     $emailRegis     = $this->input->post('emailRegis');
        //     $passRegis      = $this->input->post('passRegis');

        //     $data   = [
        //         'nama_depan'        => $namaDepan,
        //         'nama_belakang'     => $namaBelakang,
        //         'email'             => $emailRegis,
        //         'pass'              => md5($passRegis),
        //         'role'              => 'user'
        //     ];

        //     $result = $this->General_m->save('user', $data);

        //     echo json_encode($result);
        // }

        // 
        // Login Action
        //
        public function login(){
            $pin   = $this->input->post('pin');
            
            $user = $this->General_m->select("user", null, "row");
            
            if (md5($pin) == $user->pin) {
                $session = array(
                    'authenticated_cms' => true,
                    'id_user'           => $user->id,
                    'username'          => $user->username
                );
                $this->session->set_userdata($session);
            }else {
                $this->session->set_flashdata('message', 'PIN tidak sesuai');
            }

            redirect('main');
            
        }

        // 
        // Logout Action
        //
        public function logout(){
            $this->session->sess_destroy();
            $this->session->unset_userdata('authenticated_cms');
            redirect('main'); 
        }

        // 
        // Upload Files
        //
        private function filesUpload($name, $field, $object, $crud, $table = null , $id_primary = null){
            $getImage = '';
            $config = array();

            $config['upload_path']      = './uploads/pdf/';  
            $config['allowed_types']    = 'pdf';
            $config['encrypt_name']     = TRUE;
            
            if ($crud == "update") {
                $extension = pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION);
                if ($extension != $config['allowed_types']) {
                    echo '<script>alert("Maaf format file harus PDF");window.history.back();</script>';
                    exit; 
                }else {
                    $this->load->library('upload', $config, $object);
                    $this->$object->do_upload($name);
                    $getImage  = $this->$object->data('file_name');
                    
                    //hapus data yang ada difolder
                    $imageName      = $this->General_m->select($table, [$id_primary => $this->input->post('id')], 'row');
                    $fileSource     = './uploads/pdf/'.$imageName->$field;
                    
                    if (file_exists($fileSource) && $imageName->$field != NULL) {
                        unlink($fileSource);
                    }
                }
            }elseif ($crud == "delete") {
                $imageName          = $this->General_m->select($table, [$id_primary => $this->input->post('id')], 'row');
                $fileSource         = './uploads/pdf/'.$imageName->$field;

                if (file_exists($fileSource) && $imageName->$field != NULL) {
                    unlink($fileSource);
                }
            }elseif ($crud == "create") {
                $extension = pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION);
                if ($extension != $config['allowed_types']) {
                    echo '<script>alert("Maaf format file harus PDF");window.history.back();</script>';
                    exit; 
                }else {
                    $this->load->library('upload', $config, $object);
                    if ( ! $this->$object->do_upload($name)) {
                        $error  = ['error' => $this->upload->display_errors()];
                        $error2 = $error["error"];
                        echo '<script>alert("'.$error2.'");window.history.back();</script>';
                        return exit();
                    } else {
                        $getImage = $this->$object->data('file_name');
                    }
                }
            }
            return $getImage;
        }

        private function imagesUpload(){
            $namafile = array();
            $count = count($_FILES['imagesUpload']['size']);
            foreach ($_FILES as $key => $value) {
                if ($key == 'uploadPdf') {
                    continue;
                }
                for ($index=0; $index < $count ; $index++) { 
                    $_FILES['imagesUpload']['name']     = $value['name'][$index];
                    $_FILES['imagesUpload']['type']     = $value['type'][$index];
                    $_FILES['imagesUpload']['tmp_name'] = $value['tmp_name'][$index];
                    $_FILES['imagesUpload']['error']    = $value['error'][$index];
                    $_FILES['imagesUpload']['size']     = $value['size'][$index];
                    $config['upload_path']      = './uploads/images/';  
                    $config['allowed_types']    = 'jpeg|gif|jpg|png';
                    // $config['max_size']             = '100';
                    // $config['width']            = '500';
                    // $config['max_height']           = '768';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('imagesUpload')) {
                        echo $this->upload->display_errors();
                    } else {
                        $data = $this->upload->data();
                        $this->resizeImage($data['file_name']);
                        $namafile[] = $data['file_name'];
                    }
                }
                $names = implode(';', $namafile);                
            }

            return $names;
        }

        public function resizeImage($filename)
        {
            $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/' . $filename;
            $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/';
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'width' => 500,
            );
        
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
        
            $this->image_lib->clear();
        }

        // 
        // Download Files
        //
        public function downloadPdf($file)
        {
            force_download('uploads/pdf/'.$file, null);
        }

        public function generatePdf($tanggal = null)
        {
            $tgl = date('Y-m-d');
            $data = [
                'title' => "Laporan Pekerjaan Tanggal ". tanggal_indo(($tgl)),
                'getData' => $this->General_m->select('pekerjaan', ['tanggal' => $tgl], 'result', 'tanggal', 'desc'),
            ];
            
            $pdf = new \TCPDF();
            $pdf->SetTitle($data['title']);
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage('L', 'mm', 'A4');
            $i=0;
            $html='<h3>'.$data['title'].'</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                        <tr bgcolor="#ffffff">
                            <th width="5%" align="center">No</th>
                            <th width="25%" align="center">Pekerjaan</th>
                            <th width="15%" align="center">Tanggal</th>
                            <th width="5%" align="center">Jam</th>
                            <th width="15%" align="center">Status</th>
                            <th width="35%" align="center">Keterangan</th>
                        </tr>';
            foreach ($data['getData'] as $row) 
                {
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td>'.$row->pekerjaan.'</td>
                            <td>'.tanggal_indo($row->tanggal).'</td>
                            <td>'.substr($row->jam,0 ,5).'</td>
                            <td>'.$row->status.'</td>
                            <td>'.$row->keterangan.'</td>
                            
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');

            ob_end_clean();
            $pdf->Output($data['title'].'.pdf');
        }

        // 
        // Export excel
        //
        public function excelPekerjaan()
        {
            $tahapan_1 = 'if(rab_id is not null AND tor_id is not null AND tug_id is not null AND justifikasi_id is not null AND ba_id is not null, 18, 0) as tahapan_1';
            $tahapan_2 = 'if(profile_risiko_id is not null AND profile_risiko_id is not null, 14, 0) as tahapan_2';
            $tahapan_3 = 'if(kkp_id is not null AND rks_id is not null AND referensi_harga_id is not null AND hpe_id is not null, 16, 0) as tahapan_3';
            $tahapan_4 = 'if(hps_id is not null AND ba_aanwijzing_id is not null AND cda_id is not null AND perjanjian_id is not null AND jaminan_pelaksanaan_pemeliharaan_id is not null, 16, 0) as tahapan_4';
            $tahapan_5 = 'if(kick_off_id is not null AND spk_id is not null AND spm_id is not null AND lpp_id is not null AND nrpp_id is not null AND ba_stp_id is not null AND ba_pembayaran_id is not null AND ba_smp_id is not null AND ba_pemeriksaan_id is not null AND amandemen_perjanjian_id is not null AND ba_denda_id is not null AND dokumen_audit_id is not null, 18, 0) as tahapan_5';
            $tahapan_6 = 'if(pembayaran_id is not null, 18, 0) as tahapan_6';
            $data = [
                'getData'   => $this->General_m->select('pekerjaan', [], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6.''),
            ];   

            $this->load->view('excel_pekerjaan', $data);
        }
    }