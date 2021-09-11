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
                $this->load->view('admin/login');
            }else {
                switch ($content) {
                    case 'pendaftaran':
                        $data = [
                            'page'      => $content,
                            'title'     => 'Pendaftaran | Pendaftaran Vaksin',
                            'header'    => 'Pendaftaran',
                            'getData'   => $this->General_m->select('pendaftaran', [], 'result', 'cek_status', 'desc'),
                            'section'   => 'admin/content/pendaftaran'
                        ];
                        break;

                    case 'user':
                        $data = [
                            'page'      => $content,
                            'title'     => 'User | Pendaftaran Vaksin',
                            'header'    => 'User',
                            'getData'   => $this->General_m->select('user', [], 'result'),
                            'section'   => 'admin/content/user'
                        ];
                        break;

                    case 'range':
                        $data = [
                            'page'      => $content,
                            'title'     => 'Range | Pendaftaran Vaksin',
                            'header'    => 'Range Tanggal Pendaftaraan',
                            'getData'   => $this->General_m->select('range', [], 'result'),
                            'section'   => 'admin/content/range'
                        ];
                        break;
                    
                    default:
                        $data = [
                            'title'     => 'Dashboard | Pendaftaran Vaksin',
                            'header'    => 'Dashboard',
                            'jumlah_pendaftar'   => $this->General_m->select('pendaftaran', null, 'num_rows'),
                            'section'   => 'admin/content/home'
                        ];
                        break;
                }
                $this->load->view('admin/main', $data);
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
                            $field->email      = null;
                    }else {
                        $field = $this->General_m->select('user', ['id' => $id], 'row');
                    }
                    $data = [
                        'page'      => $type,
                        'title'     => 'User | Pendaftaran Vaksin',
                        'header'     => ucfirst($action) .' User',
                        'action'    => $action,
                        'field'     => $field,
                        'section'   => 'admin/form/form_user'
                    ];
                    break;
                    
                case 'pendaftaran':
                    if ($action == 'create') {
                        $field = new stdClass();
                            $field->id        = null;
                            $field->cek_status = null;
                    }else {

                        $field = $this->General_m->select('pendaftaran', ['id' => $id], 'row');
                    }
                    $data = [
                        'page'      => $type,
                        'title'     => 'Pendaftaran | Pendaftaran Vaksin',
                        'header'     => ucfirst($action) .' Pendaftaran',
                        'action'    => $action,
                        'field'     => $field,
                        'section'   => 'admin/form/pendaftaran'
                    ];
                    break;
                case 'range':
                    if ($action == 'create') {
                        $field = new stdClass();
                            $field->id        = null;
                            $field->tanggal_awal = null;
                            $field->tanggal_akhir = null;
                    }else {

                        $field = $this->General_m->select('range', ['id' => $id], 'row');
                    }
                    $data = [
                        'page'      => $type,
                        'title'     => 'Range Tanggal Pendaftaran | Pendaftaran Vaksin',
                        'header'     => ucfirst($action) .' Range Tanggal Pendaftaran',
                        'action'    => $action,
                        'field'     => $field,
                        'section'   => 'admin/form/range'
                    ];
                    break;
            }
            $this->load->view('admin/main', $data);
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

                case 'user':
                    $table = "user" ;
                    $data = [
                        'username'    => $this->input->post('username'),
                        'email'            => $this->input->post('email'),
                        'pass'            => md5($this->input->post('pass'))
                    ];
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
                case 'pendaftaran':
                    $table = "pendaftaran" ;
                    $where = ['id' => $this->input->post('id')];
                    $data = [
                        'cek_status'    => $this->input->post('cek_status')
                    ];
                    
                break; 
                case 'user':
                    $table = "user" ;
                    $where = ['id' => $this->input->post('id')];
                    $data = [
                        'username'    => $this->input->post('username'),
                        'email'            => $this->input->post('email')
                    ];

                    if ($this->input->post('pass') != '') {
                        $data['pass'] = md5($this->input->post('pass'));
                    }
                break;
                case 'range':
                    $table = "range" ;
                    $where = ['id' => $this->input->post('id')];
                    $data = [
                        'tanggal_awal'    => $this->input->post('tanggal_awal'),
                        'tanggal_akhir'            => $this->input->post('tanggal_akhir')
                    ];
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
            redirect('main/index/'.$type);
        }

        /*
        |--------------------------------------------------------------------------
        | Action Delete Data
        |--------------------------------------------------------------------------
        */
        public function delete($type = null){
            switch ($type) {
                // case 'pekerjaan':
                //     $table = "pekerjaan" ;
                //     $where = ['id' => $this->input->post('id')];
                //     $get = $this->General_m->select('pekerjaan', $where, 'row');
                //     $gambar = explode(';', $get->foto);
                //     for ($i=0; $i < count($gambar) ; $i++) { 
                //         $fileSource     = './uploads/images/'. $gambar[$i];
                //         if (file_exists($fileSource) && $gambar[$i] != NULL) {
                //             unlink($fileSource);
                //         }
                //     }

                //     $this->filesUpload('uploadPdf', 'file_pdf', 'UploadDelete', 'delete', 'pekerjaan' , 'id');
                // break;
                case 'user':
                    $table = "user" ;
                    $where = ['id' => $this->input->post('id')];
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
            $get = $this->General_m->select('pendaftaran', $where, 'row');

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

        public function getEmailUser(){
            $arrayEmail = [];
            $getEmailUser     = $this->General_m->select("user", null, "result", "username", "desc", "*");
            foreach ($getEmailUser as $key => $value) {
                array_push($arrayEmail, $value->email);
            }
    
            echo json_encode($arrayEmail);
        }

        // 
        // Login Action
        //
        public function login(){
            $email      = $this->input->post('email');
            $password   = $this->input->post('pass');
            
            $user = $this->General_m->select("user", ['email' => $email], "row", null, null, null);
    
            if (empty($user)) {
                $this->session->set_flashdata('message', 'Email tidak ditemukan');
            }else {
                if (md5($password) == $user->pass) {
                    $session = array(
                        'authenticated_cms' => true,
                        'id_user'           => $user->id,
                        'email'             => $user->email,
                        'username'          => $user->username
                    );
                    $this->session->set_userdata($session);
                }else {
                    $this->session->set_flashdata('message', 'Password tidak sesuai');
                }
                
            }
            redirect('main');
            
        }

        // 
        // Logout Action
        //
        public function logout(){
            $this->session->sess_destroy();
            $this->session->unset_userdata('authenticated_cms');
            redirect('/main'); 
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
            // $tgl = date('Y-m-d');
            $data = [
                'title' => "Laporan Pekerjaan ". tanggal_indo(($tanggal)),
                'getData' => $this->General_m->select('pekerjaan', ['tanggal' => $tanggal], 'result', 'tanggal', 'desc'),
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

    }