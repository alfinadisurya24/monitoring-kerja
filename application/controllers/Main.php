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
                case 'pengumpulan':
                    $data = [
                        'page'      => $content,
                        'title'     => 'Pengumpulan Data | Monitoring Pekerjaan',
                        'header'    => 'Pengumpulan Data',
                        'getData'   => $this->General_m->select('rab', [], 'result', 'no_rab', 'asc'),
                        'section'   => 'content/pengumpulan_data'
                    ];
                    break;
                
                default:
                    $data = [
                        'title'     => 'Dashboard | Monitoring Pekerjaan',
                        'header'    => 'Dashboard',
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
            case 'pengumpulan':
                if ($action == 'create') {
                    $field = new stdClass();
                        $field->id_rab          = null;
                        $field->no_rab          = null;
                        $field->tanggal         = null;
                        $field->nilai_rab       = null;
                        $field->file_upload     = null;
                        $field->upload_cek      = null;
                        // $field->role_id = null;
                }else {
                    $field = $this->General_m->select('rab', ['id_rab' => $id], 'row');
                }
                // var_dump($field);die;
                $data = [
                    'page'      => $type,
                    'title'     => 'Pengumpulan Data | Monitoring Pekerjaan',
                    'header'     => ucfirst($action) .' Pengumpulan Data',
                    'action'    => $action,
                    'field'     => $field,
                    'section'   => 'form/form_rab'
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
            case 'pengumpulan':
                $table = "rab" ;
                $data = [
                    'no_rab'    => $this->input->post('no_rab'),
                    'tanggal'   => $this->input->post('tanggal'),
                    'nilai_rab' => $this->input->post('nilai_rab'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                if (! empty( $_FILES['rab_upload']['name'] )) {
                    $data['file_upload'] =  'rab/'.$this->filesUpload('rab', 'rab_upload', null, 'rabUpload', 'create');
                }
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
            case 'pengumpulan':
                $table = "rab" ;
                $where = ['id_rab' => $this->input->post('id')];
                $data = [
                    'no_rab'    => $this->input->post('no_rab'),
                    'tanggal'   => $this->input->post('tanggal'),
                    'nilai_rab' => $this->input->post('nilai_rab'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                if (! empty( $_FILES['rab_upload']['name'] )) {
                    $data['file_upload'] =  'rab/'.$this->filesUpload('rab', 'rab_upload', 'file_upload', 'rabUploadUpdate', 'update', 'rab' , 'id_rab');
                }
            
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
            case 'pengumpulan':
                $table = 'rab';
                $where = ['id_rab' => $this->input->post('id')];
                $this->filesUpload('rab', '', "file_upload", '', 'delete', 'rab' , 'id_rab');
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


    public function v_register()
    {
        $this->load->view('register');
    }

    public function getEmailUser(){
        $arrayEmail = [];
        $getEmailUser     = $this->General_m->select("user", null, "result", "nama_depan", "desc", "*");
        foreach ($getEmailUser as $key => $value) {
            array_push($arrayEmail, $value->email);
        }

        echo json_encode($arrayEmail);
    }


    public function register(){
        $namaDepan      = $this->input->post('namaDepan');
        $namaBelakang   = $this->input->post('namaBelakang');
        $emailRegis     = $this->input->post('emailRegis');
        $passRegis      = $this->input->post('passRegis');

        $data   = [
            'nama_depan'        => $namaDepan,
            'nama_belakang'     => $namaBelakang,
            'email'             => $emailRegis,
            'pass'              => md5($passRegis),
            'role'              => 1
        ];

        $result = $this->General_m->save('user', $data);

        echo json_encode($result);
    }

    // 
    // Login Action
    //
    public function login(){
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        
        $user = $this->General_m->select("user", ['email' => $email], "row", null, null, null);

        if (empty($user)) {
            $this->session->set_flashdata('message', 'Email tidak ditemukan');
        }else {
            if (md5($password) == $user->pass) {
                $session = array(
                    'authenticated_cms' => true,
                    'id_user'           => $user->id_user,
                    'email'             => $user->email,
                    'nama_depan'        => $user->nama_depan,
                    'nama_belakang'     => $user->nama_belakang,
                    'role'              => $user->role
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
        redirect('main'); 
    }

    // 
    // Upload Files
    //
    private function filesUpload($folder, $name, $field, $object, $crud, $table = null , $id_primary = null){
        $getImage = '';
        $config = array();

        $config['upload_path']      = './assets/files/'.$folder.'/';  
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
                $fileSource     = './assets/files/'.$imageName->$field;
                
                if (file_exists($fileSource) && $imageName->$field != NULL) {
                    unlink($fileSource);
                }
            }
        }elseif ($crud == "delete") {
            $imageName          = $this->General_m->select($table, [$id_primary => $this->input->post('id')], 'row');
            $fileSource         = './assets/files/'.$imageName->$field;

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

    // 
    // Download Files
    //
    public function downloadPdf($folder, $file)
    {
        force_download('assets/files/'.$folder.'/'.$file, null);
    }

}
