    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Front extends CI_Controller {

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
            switch ($content) {
                case 'detail':
                    $data = [];
                    $this->load->view('front/detail', $data);
                    break;

                default:
                    $data = [
                        'range' => $this->General_m->select('range', [], 'row', 'tanggal_akhir', 'desc')
                    ];
                    $this->load->view('front/home', $data);
                    break;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Action Create Data
        |--------------------------------------------------------------------------
        */
        public function create(){
            $table = "pendaftaran" ;
            $data = [
                'nama'          => $this->input->post('nama'),
                'nik'           => $this->input->post('nik'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'hp'            => $this->input->post('hp'),
                'email'         => $this->input->post('email'),
                'alamat'         => $this->input->post('alamat'),
                'foto'          => $this->imagesUpload()
            ];

            $no_urut = $this->General_m->select('pendaftaran', null, 'row', 'nomor_urut', 'desc');
            if (empty($no_urut)) {
                $data['nomor_urut'] = 1;
            }else{
                $data['nomor_urut'] = $no_urut->nomor_urut + 1;
            }

            $save = $this->General_m->save($table, $data); 

            if ($save) {
                $this->session->set_flashdata([
                    'data'      => $data,
                    'message'   => true,
                ]);
                redirect('front/index/detail');
            }else {
                $this->session->set_flashdata([
                    'message'   => false,
                    ]);
                redirect('front');
            }
        }

        public function detailJson($id = null)
        {
            $where = ['id' => $id];
            $get = $this->General_m->select('pekerjaan', $where, 'row');

            echo json_encode($get);
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
            $count = count($_FILES['foto']['size']);
            foreach ($_FILES as $key => $value) {
                if ($key == 'uploadPdf') {
                    continue;
                }
                for ($index=0; $index < $count ; $index++) { 
                    $_FILES['foto']['name']     = $value['name'][$index];
                    $_FILES['foto']['type']     = $value['type'][$index];
                    $_FILES['foto']['tmp_name'] = $value['tmp_name'][$index];
                    $_FILES['foto']['error']    = $value['error'][$index];
                    $_FILES['foto']['size']     = $value['size'][$index];
                    $config['upload_path']      = './uploads/images/';  
                    $config['allowed_types']    = 'jpeg|gif|jpg|png';
                    $config['encrypt_name']     = TRUE;
                    
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('foto')) {
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
            // echo $target_path; die;
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

        public function generatePdf($nik = null)
        {
            // $tgl = date('Y-m-d');
            $data = [
                'title' => "Nomor Antrian Vaksin",
                'getData' => $this->General_m->select('pendaftaran', ['nik' => $nik], 'row', 'nomor_urut', 'desc'),
            ];

            if (empty($data['getData'])) {
                echo '<script>alert("asdasds");window.history.back();</script>';
                die;
            }
            
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
            $html='
            <h3>'.$data['title'].'</h3>
            <table cellspacing="1" bgcolor="#666666" cellpadding="2">
            <tr bgcolor="#ffffff">
                <td width="15%">Nomor Antrian</td>
                <td width="75%">: '. $data['getData']->nomor_urut .'</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="15%">Nama Lengkap</td>
                <td width="75%">: '. $data['getData']->nama .'</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="15%">NIK</td>
                <td width="75%">: '. $data['getData']->nik .'</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="15%">Jenis Kelamin</td>
                <td width="75%">: '. $data['getData']->jenis_kelamin .'</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="15%">Email</td>
                <td width="75%">: '. $data['getData']->email .'</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="15%">Nomor Handphone</td>
                <td width="75%">: '. $data['getData']->hp .'</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="15%">Alamat</td>
                <td width="75%">: '. $data['getData']->alamat .'</td>
            </tr>';
            $pdf->writeHTML($html, true, false, true, false, '');

            ob_end_clean();
            $pdf->Output($data['title'].'.pdf');
        }

    }