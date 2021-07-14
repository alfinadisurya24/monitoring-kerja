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
                case 'data-pekerjaan':
                    $tahapan_1 = 'if(rab_id is not null AND tor_id is not null AND tug_id is not null AND justifikasi_id is not null AND ba_id is not null, 18, 0) as tahapan_1';
                    $tahapan_2 = 'if(profile_risiko_id is not null AND profile_risiko_id is not null, 14, 0) as tahapan_2';
                    $tahapan_3 = 'if(kkp_id is not null AND rks_id is not null AND referensi_harga_id is not null AND hpe_id is not null, 16, 0) as tahapan_3';
                    $tahapan_4 = 'if(hps_id is not null AND ba_aanwijzing_id is not null AND cda_id is not null AND perjanjian_id is not null AND jaminan_pelaksanaan_pemeliharaan_id is not null, 16, 0) as tahapan_4';
                    $tahapan_5 = 'if(kick_off_id is not null AND spk_id is not null AND spm_id is not null AND lpp_id is not null AND nrpp_id is not null AND ba_stp_id is not null AND ba_pembayaran_id is not null AND ba_smp_id is not null AND ba_pemeriksaan_id is not null AND amandemen_perjanjian_id is not null AND ba_denda_id is not null AND dokumen_audit_id is not null, 18, 0) as tahapan_5';
                    $tahapan_6 = 'if(pembayaran_id is not null, 18, 0) as tahapan_6';
                    $data = [
                        'page'      => $content,
                        'title'     => 'Data Pekerjaan | Monitoring Pekerjaan',
                        'header'    => 'Data Pekerjaan',
                        'getData'   => $this->General_m->select('pekerjaan', [], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6.''),
                        'section'   => 'content/data_pekerjaan'
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
                    $tahapan_1 = 'if(rab_id is not null AND tor_id is not null AND tug_id is not null AND justifikasi_id is not null AND ba_id is not null, 18, 0) as tahapan_1';
                    $tahapan_2 = 'if(profile_risiko_id is not null AND profile_risiko_id is not null, 14, 0) as tahapan_2';
                    $tahapan_3 = 'if(kkp_id is not null AND rks_id is not null AND referensi_harga_id is not null AND hpe_id is not null, 16, 0) as tahapan_3';
                    $tahapan_4 = 'if(hps_id is not null AND ba_aanwijzing_id is not null AND cda_id is not null AND perjanjian_id is not null AND jaminan_pelaksanaan_pemeliharaan_id is not null, 16, 0) as tahapan_4';
                    $tahapan_5 = 'if(kick_off_id is not null AND spk_id is not null AND spm_id is not null AND lpp_id is not null AND nrpp_id is not null AND ba_stp_id is not null AND ba_pembayaran_id is not null AND ba_smp_id is not null AND ba_pemeriksaan_id is not null AND amandemen_perjanjian_id is not null AND ba_denda_id is not null AND dokumen_audit_id is not null, 18, 0) as tahapan_5';
                    $tahapan_6 = 'if(pembayaran_id is not null, 18, 0) as tahapan_6';

                    $sratus_persen = 0;
                    $belum_sratus   = 0;

                    $getData = $this->General_m->select('pekerjaan', [], 'result', 'id_pekerjaan', 'asc', $tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6);
                    foreach ($getData as $key => $value) {
                        $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                        if ($progress == 100) {
                            $sratus_persen += 1;
                        } else {
                            $belum_sratus += 1;
                        }
                        
                    }

                    $datePlusSeminggu = date("Y-m-d", strtotime("+7 day"));
                    $datePlusSebulan = date("Y-m-d", strtotime("+1 month"));
                    $datePlus3Bulan = date("Y-m-d", strtotime("+3 month"));
                    $datePlus6Bulan = date("Y-m-d", strtotime("+6 month"));
                    $datePlusSetahun = date("Y-m-d", strtotime("+1 year"));
                    $per_minggu = $this->General_m->select('pekerjaan', ["finish_date" => $datePlusSeminggu], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6);
                    $per_bulan = $this->General_m->select('pekerjaan', ["finish_date" => $datePlusSebulan], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6);
                    $per_3bulan = $this->General_m->select('pekerjaan', ["finish_date" => $datePlus3Bulan], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6);
                    $per_6bulan = $this->General_m->select('pekerjaan', ["finish_date" => $datePlus6Bulan], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6);
                    $per_tahun = $this->General_m->select('pekerjaan', ["finish_date" => $datePlusSetahun], 'result', 'id_pekerjaan', 'asc', '*, '.$tahapan_1.', '.$tahapan_2.', '.$tahapan_3.', '.$tahapan_4.', '.$tahapan_5.', '.$tahapan_6);

                    $data = [
                        'title'     => 'Dashboard | Monitoring Pekerjaan',
                        'header'    => 'Dashboard',
                        'pekerjaan' => count($this->General_m->select('pekerjaan', [], 'result')),
                        'user'      => count($this->General_m->select('user', [], 'result')),
                        'header'    => 'Dashboard',
                        'sratus_persen'=> $sratus_persen,
                        'belum_sratus'  => $belum_sratus,
                        'per_minggu'    => $per_minggu,
                        'per_bulan'    => $per_bulan,
                        'per_3bulan'    => $per_3bulan,
                        'per_6bulan'    => $per_6bulan,
                        'per_tahun'    => $per_tahun,
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
                $data = [
                    'page'      => $type,
                    'title'     => 'Pengumpulan Data | Monitoring Pekerjaan',
                    'header'     => ucfirst($action) .' Pengumpulan Data',
                    'action'    => $action,
                    'field'     => $field,
                    'section'   => 'form/form_rab'
                ];
                break;

            case 'user':
                if ($action == 'create') {
                    $field = new stdClass();
                        $field->id_user      = null;
                        $field->nama_depan      = null;
                        $field->nama_belakang   = null;
                        $field->email           = null;
                        $field->role            = null;
                        $field->verifikasi      = null;
                }else {
                    $field = $this->General_m->select('user', ['id_user' => $id], 'row');
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
                
            case 'data-pekerjaan':
                if ($action == 'create') {
                    $field = new stdClass();
                        $field->id_pekerjaan        = null;
                        $field->nama_pekerjaan      = null;
                        $field->no_perjanjian       = null;
                        $field->lokasi              = null;
                        $field->kapasitas           = null;
                        $field->anggaran            = null;
                        $field->sumber_dana         = null;
                        $field->direksi_pekerjaan   = null;
                        $field->pelaksana           = null;
                        $field->start_date          = null;
                        $field->finish_date         = null;
                }else {

                    $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                }
                $data = [
                    'page'      => $type,
                    'title'     => 'Data Pekerjaan | Monitoring Pekerjaan',
                    'header'     => ucfirst($action) .' Data Pekerjaan',
                    'action'    => $action,
                    'field'     => $field,
                    'ba'        => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba'),
                    'rab'       => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'rab'),
                    'tor'       => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'tor'),
                    'tug'       => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'tug'),
                    'justifikasi'   => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'justifikasi'),
                    'profile_risiko'=> $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'profile_risiko'),
                    'kajian_risiko' => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'kajian_risiko'),
                    'kkp'           => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'kkp'),
                    'rks'           => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'rks'),
                    'referensi_harga'=> $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'referensi_harga'),
                    'hpe'           => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'hpe'),
                    'hps'           => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'hps'),
                    'ba_aanwijzing' => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba_aanwijzing'),
                    'cda'           => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'cda'),
                    'perjanjian'    => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'perjanjian'),
                    'jaminan_pelaksanaan_pemeliharaan'=> $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'jaminan_pelaksanaan_pemeliharaan'),
                    'kick_off'  => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'kick_off'),
                    'spk'       => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'spk'),
                    'spm'       => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'spm'),
                    'lpp'       => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'lpp'),
                    'nrpp'      => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'nrpp'),
                    'ba_stp'    => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba_stp'),
                    'ba_pembayaran' => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba_pembayaran'),
                    'ba_smp'        => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba_smp'),
                    'ba_pemeriksaan'=> $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba_pemeriksaan'),
                    'amandemen_perjanjian'=> $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'amandemen_perjanjian'),
                    'ba_denda'   => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'ba_denda'),
                    'dokumen_audit'     => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'dokumen_audit'),
                    'pembayaran'   => $this->General_m->selectJoin(['id_pekerjaan' => $id], 'row', null, null, null, 'pembayaran'),
                    'section'   => 'form/form_pekerjaan'
                ];
                break;
        }
        $this->load->view('main', $data);
    }

    public function tahapan_v($type = NULL, $id = NULL) {
        switch ($type) {
            case 'pengumpulan':
                $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                
                if ($field->rab_id != null) {
                    $rab = $this->General_m->select('rab', ['id_rab' => $field->rab_id], 'row');
                }else{
                    $rab = new stdClass();
                        $rab->id_rab          = null;
                        $rab->no_rab          = null;
                        $rab->tanggal         = null;
                        $rab->nilai_rab       = null;
                        $rab->file_upload     = null;
                        $rab->upload_cek      = null;
                }

                if ($field->tor_id != null) {
                    $tor = $this->General_m->select('tor', ['id_tor' => $field->tor_id], 'row');
                }else{
                    $tor = new stdClass();
                        $tor->id_tor          = null;
                        $tor->no_tor          = null;
                        $tor->tanggal         = null;
                        $tor->durasi_pekerjaan= null;
                        $tor->file_upload     = null;
                        $tor->upload_cek      = null;
                }

                if ($field->tug_id != null) {
                    $tug = $this->General_m->select('tug', ['id_tug' => $field->tug_id], 'row');
                }else{
                    $tug = new stdClass();
                        $tug->id_tug          = null;
                        $tug->no_tug          = null;
                        $tug->tanggal         = null;
                        $tug->file_upload     = null;
                        $tug->upload_cek      = null;
                }

                if ($field->ba_id != null) {
                    $ba = $this->General_m->select('ba', ['id_ba' => $field->ba_id], 'row');
                }else{
                    $ba = new stdClass();
                        $ba->id_ba          = null;
                        $ba->no_ba          = null;
                        $ba->tanggal         = null;
                        $ba->file_upload     = null;
                        $ba->upload_cek      = null;
                }

                if ($field->justifikasi_id != null) {
                    $justifikasi = $this->General_m->select('justifikasi', ['id_justifikasi' => $field->justifikasi_id], 'row');
                }else{
                    $justifikasi = new stdClass();
                        $justifikasi->id_justifikasi = null;
                        $justifikasi->jasa           = null;
                        $justifikasi->file_upload    = null;
                        $justifikasi->upload_cek     = null;
                }
                
                $disabled = true;
                if (($rab->file_upload != null && $rab->upload_cek == 1) 
                && ($tor->file_upload != null && $tor->upload_cek == 1) 
                && ($tug->file_upload != null && $tug->upload_cek == 1) 
                && ($ba->file_upload != null && $ba->upload_cek == 1) 
                && ($justifikasi->file_upload != null && $justifikasi->upload_cek == 1)) {
                    $disabled = false;
                }

                $data = [
                    'page'      => $type,
                    'title'     => 'Pengumpulan Data | Monitoring Pekerjaan',
                    'header'    => 'Pengumpulan Data',
                    'field'     => $field,
                    'rab'       => $rab,
                    'tor'       => $tor,
                    'tug'       => $tug,
                    'ba'        => $ba,
                    'justifikasi'=> $justifikasi,
                    'disabled'=> $disabled,
                    'section'   => 'form/form_pengumpulan_data'
                ];
            break;

            case 'mro':
                $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                
                if ($field->profile_risiko_id != null) {
                    $profile_risiko = $this->General_m->select('profile_risiko', ['id_profile_risiko' => $field->profile_risiko_id], 'row');
                }else{
                    $profile_risiko = new stdClass();
                        $profile_risiko->id_profile_risiko  = null;
                        $profile_risiko->file_upload        = null;
                        $profile_risiko->upload_cek        = null;
                }

                if ($field->kajian_risiko_id != null) {
                    $kajian_risiko = $this->General_m->select('kajian_risiko', ['id_kajian_risiko' => $field->kajian_risiko_id], 'row');
                }else{
                    $kajian_risiko = new stdClass();
                        $kajian_risiko->id_kajian_risiko    = null;
                        $kajian_risiko->file_upload         = null;
                        $kajian_risiko->upload_cek         = null;
                }
                
                $disabled = true;
                if (($profile_risiko->file_upload != null && $profile_risiko->upload_cek == 1) 
                && ($kajian_risiko->file_upload != null && $kajian_risiko->upload_cek == 1)) {
                    $disabled = false;
                }

                $data = [
                    'page'      => $type,
                    'title'     => 'MRO Pengadaan | Monitoring Pekerjaan',
                    'header'    => 'MRO (Manajemen Risiko) Pengadaan',
                    'field'     => $field,
                    'profile_risiko'=> $profile_risiko,
                    'kajian_risiko'=> $kajian_risiko,
                    'disabled'=> $disabled,
                    'section'   => 'form/form_mro'
                ];
            break;

            case 'perencanaan_pengadaan':
                $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                
                if ($field->kkp_id != null) {
                    $kkp = $this->General_m->select('kkp', ['id_kkp' => $field->kkp_id], 'row');
                }else{
                    $kkp = new stdClass();
                        $kkp->id_kkp        = null;
                        $kkp->file_upload   = null;
                        $kkp->upload_cek    = null;
                }

                if ($field->rks_id != null) {
                    $rks = $this->General_m->select('rks', ['id_rks' => $field->rks_id], 'row');
                }else{
                    $rks = new stdClass();
                        $rks->id_rks        = null;
                        $rks->file_upload   = null;
                        $rks->upload_cek    = null;
                }

                if ($field->referensi_harga_id != null) {
                    $referensi_harga = $this->General_m->select('referensi_harga', ['id_referensi_harga' => $field->referensi_harga_id], 'row');
                }else{
                    $referensi_harga = new stdClass();
                        $referensi_harga->id_referensi_harga        = null;
                        $referensi_harga->file_upload   = null;
                        $referensi_harga->upload_cek    = null;
                }

                if ($field->hpe_id != null) {
                    $hpe = $this->General_m->select('hpe', ['id_hpe' => $field->hpe_id], 'row');
                }else{
                    $hpe = new stdClass();
                        $hpe->id_hpe        = null;
                        $hpe->file_upload   = null;
                        $hpe->upload_cek    = null;
                }

                $disabled = true;
                if (($kkp->file_upload != null && $kkp->upload_cek == 1) 
                && ($rks->file_upload != null && $rks->upload_cek == 1) 
                && ($referensi_harga->file_upload != null && $referensi_harga->upload_cek == 1) 
                && ($hpe->file_upload != null && $hpe->upload_cek == 1)) {
                    $disabled = false;
                }

                $data = [
                    'page'      => $type,
                    'title'     => 'Perencanaan Pengadaan | Monitoring Pekerjaan',
                    'header'    => 'Perencanaan Pengadaan',
                    'field'     => $field,
                    'kkp'       => $kkp,
                    'rks'       => $rks,
                    'referensi_harga'=> $referensi_harga,
                    'hpe'       => $hpe,
                    'disabled'=> $disabled,
                    'section'   => 'form/form_perencanaan_pengadaan'
                ];
            break;

            case 'pelaksanaan_pengadaan':
                $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                
                if ($field->hps_id != null) {
                    $hps = $this->General_m->select('hps', ['id_hps' => $field->hps_id], 'row');
                }else{
                    $hps = new stdClass();
                        $hps->id_hps        = null;
                        $hps->file_upload   = null;
                        $hps->upload_cek    = null;
                }

                if ($field->ba_aanwijzing_id != null) {
                    $ba_aanwijzing = $this->General_m->select('ba_aanwijzing', ['id_ba_aanwijzing' => $field->ba_aanwijzing_id], 'row');
                }else{
                    $ba_aanwijzing = new stdClass();
                        $ba_aanwijzing->id_ba_aanwijzing        = null;
                        $ba_aanwijzing->file_upload   = null;
                        $ba_aanwijzing->upload_cek    = null;
                }

                if ($field->cda_id != null) {
                    $cda = $this->General_m->select('cda', ['id_cda' => $field->cda_id], 'row');
                }else{
                    $cda = new stdClass();
                        $cda->id_cda        = null;
                        $cda->file_upload   = null;
                        $cda->upload_cek    = null;
                }

                if ($field->perjanjian_id != null) {
                    $perjanjian = $this->General_m->select('perjanjian', ['id_perjanjian' => $field->perjanjian_id], 'row');
                }else{
                    $perjanjian = new stdClass();
                        $perjanjian->id_perjanjian        = null;
                        $perjanjian->file_upload   = null;
                        $perjanjian->upload_cek    = null;
                }

                if ($field->jaminan_pelaksanaan_pemeliharaan_id != null) {
                    $jaminan_pelaksanaan_pemeliharaan = $this->General_m->select('jaminan_pelaksanaan_pemeliharaan', ['id_jaminan_pelaksanaan_pemeliharaan' => $field->jaminan_pelaksanaan_pemeliharaan_id], 'row');
                }else{
                    $jaminan_pelaksanaan_pemeliharaan = new stdClass();
                        $jaminan_pelaksanaan_pemeliharaan->id_jaminan_pelaksanaan_pemeliharaan        = null;
                        $jaminan_pelaksanaan_pemeliharaan->file_upload   = null;
                        $jaminan_pelaksanaan_pemeliharaan->upload_cek    = null;
                }
                
                $disabled = true;
                if (($hps->file_upload != null && $hps->upload_cek == 1) 
                && ($ba_aanwijzing->file_upload != null && $ba_aanwijzing->upload_cek == 1) 
                && ($cda->file_upload != null && $cda->upload_cek == 1) 
                && ($perjanjian->file_upload != null && $perjanjian->upload_cek == 1) 
                && ($jaminan_pelaksanaan_pemeliharaan->file_upload != null && $jaminan_pelaksanaan_pemeliharaan->upload_cek == 1)) {
                    $disabled = false;
                }

                $data = [
                    'page'      => $type,
                    'title'     => 'Pelaksanaan Pengadaan | Monitoring Pekerjaan',
                    'header'    => 'Pelaksanaan Pengadaan',
                    'field'     => $field,
                    'hps'       => $hps,
                    'ba_aanwijzing'       => $ba_aanwijzing,
                    'cda'=> $cda,
                    'perjanjian'       => $perjanjian,
                    'jaminan_pelaksanaan_pemeliharaan'       => $jaminan_pelaksanaan_pemeliharaan,
                    'disabled'=> $disabled,
                    'section'   => 'form/form_pelaksanaan_pengadaan'
                ];
            break;

            case 'pelaksanaan_pekerjaan':
                $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                
                if ($field->kick_off_id != null) {
                    $kick_off = $this->General_m->select('kick_off', ['id_kick_off' => $field->kick_off_id], 'row');
                }else{
                    $kick_off = new stdClass();
                        $kick_off->id_kick_off        = null;
                        $kick_off->file_upload   = null;
                        $kick_off->upload_cek    = null;
                }

                if ($field->spk_id != null) {
                    $spk = $this->General_m->select('spk', ['id_spk' => $field->spk_id], 'row');
                }else{
                    $spk = new stdClass();
                        $spk->id_spk        = null;
                        $spk->file_upload   = null;
                        $spk->upload_cek    = null;
                }

                if ($field->spm_id != null) {
                    $spm = $this->General_m->select('spm', ['id_spm' => $field->spm_id], 'row');
                }else{
                    $spm = new stdClass();
                        $spm->id_spm        = null;
                        $spm->file_upload   = null;
                        $spm->upload_cek    = null;
                }

                if ($field->lpp_id != null) {
                    $lpp = $this->General_m->select('lpp', ['id_lpp' => $field->lpp_id], 'row');
                }else{
                    $lpp = new stdClass();
                        $lpp->id_lpp        = null;
                        $lpp->file_upload   = null;
                        $lpp->upload_cek    = null;
                }

                if ($field->nrpp_id != null) {
                    $nrpp = $this->General_m->select('nrpp', ['id_nrpp' => $field->nrpp_id], 'row');
                }else{
                    $nrpp = new stdClass();
                        $nrpp->id_nrpp        = null;
                        $nrpp->file_upload   = null;
                        $nrpp->upload_cek    = null;
                }

                if ($field->ba_stp_id != null) {
                    $ba_stp = $this->General_m->select('ba_stp', ['id_ba_stp' => $field->ba_stp_id], 'row');
                }else{
                    $ba_stp = new stdClass();
                        $ba_stp->id_ba_stp        = null;
                        $ba_stp->file_upload   = null;
                        $ba_stp->upload_cek    = null;
                }

                if ($field->ba_pembayaran_id != null) {
                    $ba_pembayaran = $this->General_m->select('ba_pembayaran', ['id_ba_pembayaran' => $field->ba_pembayaran_id], 'row');
                }else{
                    $ba_pembayaran = new stdClass();
                        $ba_pembayaran->id_ba_pembayaran        = null;
                        $ba_pembayaran->file_upload   = null;
                        $ba_pembayaran->upload_cek    = null;
                }

                if ($field->ba_smp_id != null) {
                    $ba_smp = $this->General_m->select('ba_smp', ['id_ba_smp' => $field->ba_smp_id], 'row');
                }else{
                    $ba_smp = new stdClass();
                        $ba_smp->id_ba_smp        = null;
                        $ba_smp->file_upload   = null;
                        $ba_smp->upload_cek    = null;
                }

                if ($field->ba_pemeriksaan_id != null) {
                    $ba_pemeriksaan = $this->General_m->select('ba_pemeriksaan', ['id_ba_pemeriksaan' => $field->ba_pemeriksaan_id], 'row');
                }else{
                    $ba_pemeriksaan = new stdClass();
                        $ba_pemeriksaan->id_ba_pemeriksaan        = null;
                        $ba_pemeriksaan->file_upload   = null;
                        $ba_pemeriksaan->upload_cek    = null;
                }

                if ($field->amandemen_perjanjian_id != null) {
                    $amandemen_perjanjian = $this->General_m->select('amandemen_perjanjian', ['id_amandemen_perjanjian' => $field->amandemen_perjanjian_id], 'row');
                }else{
                    $amandemen_perjanjian = new stdClass();
                        $amandemen_perjanjian->id_amandemen_perjanjian        = null;
                        $amandemen_perjanjian->file_upload   = null;
                        $amandemen_perjanjian->upload_cek    = null;
                }

                if ($field->ba_denda_id != null) {
                    $ba_denda = $this->General_m->select('ba_denda', ['id_ba_denda' => $field->ba_denda_id], 'row');
                }else{
                    $ba_denda = new stdClass();
                        $ba_denda->id_ba_denda        = null;
                        $ba_denda->file_upload   = null;
                        $ba_denda->upload_cek    = null;
                }

                if ($field->dokumen_audit_id != null) {
                    $dokumen_audit = $this->General_m->select('dokumen_audit', ['id_dokumen_audit' => $field->dokumen_audit_id], 'row');
                }else{
                    $dokumen_audit = new stdClass();
                        $dokumen_audit->id_dokumen_audit        = null;
                        $dokumen_audit->file_upload   = null;
                        $dokumen_audit->upload_cek    = null;
                }

                $disabled = true;
                if (($kick_off->file_upload != null && $kick_off->upload_cek == 1) 
                && ($spk->file_upload != null && $spk->upload_cek == 1) 
                && ($spm->file_upload != null && $spm->upload_cek == 1) 
                && ($lpp->file_upload != null && $lpp->upload_cek == 1)
                && ($nrpp->file_upload != null && $nrpp->upload_cek == 1) 
                && ($ba_stp->file_upload != null && $ba_stp->upload_cek == 1) 
                && ($ba_pembayaran->file_upload != null && $ba_pembayaran->upload_cek == 1) 
                && ($ba_smp->file_upload != null && $ba_smp->upload_cek == 1) 
                && ($ba_pemeriksaan->file_upload != null && $ba_pemeriksaan->upload_cek == 1) 
                && ($amandemen_perjanjian->file_upload != null && $amandemen_perjanjian->upload_cek == 1) 
                && ($ba_denda->file_upload != null && $ba_denda->upload_cek == 1) 
                && ($dokumen_audit->file_upload != null && $dokumen_audit->upload_cek == 1)) {
                        $disabled = false;
                }
                
                $data = [
                    'page'      => $type,
                    'title'     => 'Pelaksanaan Pekerjaan | Monitoring Pekerjaan',
                    'header'    => 'Pelaksanaan Pekerjaan',
                    'field'     => $field,
                    'kick_off'  => $kick_off,
                    'spk'       => $spk,
                    'spm'       => $spm,
                    'lpp'       => $lpp,
                    'nrpp'      => $nrpp,
                    'ba_stp'    => $ba_stp,
                    'ba_pembayaran'=> $ba_pembayaran,
                    'ba_smp'    => $ba_smp,
                    'ba_pemeriksaan'=> $ba_pemeriksaan,
                    'amandemen_perjanjian'=> $amandemen_perjanjian,
                    'ba_denda'    => $ba_denda,
                    'dokumen_audit'=> $dokumen_audit,
                    'disabled'=> $disabled,
                    'section'   => 'form/form_pelaksanaan_pekerjaan'
                ];
            break;

            case 'pembayaran':
                $field = $this->General_m->select('pekerjaan', ['id_pekerjaan' => $id], 'row');
                
                if ($field->pembayaran_id != null) {
                    $pembayaran = $this->General_m->select('pembayaran', ['id_pembayaran' => $field->pembayaran_id], 'row');
                }else{
                    $pembayaran = new stdClass();
                        $pembayaran->id_pembayaran  = null;
                        $pembayaran->file_upload        = null;
                        $pembayaran->upload_cek        = null;
                }

                $data = [
                    'page'      => $type,
                    'title'     => 'Pelaksanaan Pembayaran | Monitoring Pekerjaan',
                    'header'    => 'Pelaksanaan Pembayaran',
                    'field'     => $field,
                    'pembayaran'=> $pembayaran,
                    'section'   => 'form/form_pembayaran'
                ];
            break;
        }
        $this->load->view('main', $data);
    }

    public function tahapan_kerja($type = null, $id = NULL){
        switch ($type) {
            /*
            |--------------------------------------------------------------------------
            | Pengumpulan Data
            |--------------------------------------------------------------------------
            */
            case 'rab':
                $table = "rab";
                $next = true;
                $tahapan = 'pengumpulan';
                $nextFor = "tor";
                $data = [
                    'no_rab'    => $this->input->post('no'),
                    'tanggal'   => $this->input->post('tanggal'),
                    'nilai_rab' => $this->input->post('nilai'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $rab_id = $this->input->post('id');

                if ($rab_id != null || $rab_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'rab/'.$this->filesUpload('rab', 'upload', 'file_upload', 'rabUploadUpdate', 'update', 'rab' , 'id_rab');
                    }
                    $result = $this->General_m->update($table, $data, ["id_rab" => $rab_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'rab/'.$this->filesUpload('rab', 'upload', null, 'rabUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["rab_id" => $result], ["id_pekerjaan" => $id]);
                }
            break;
            
            case 'tor':
                $table = "tor";
                $next = true;
                $tahapan = 'pengumpulan';
                $nextFor = "tug";
                $data = [
                    'no_tor'    => $this->input->post('no'),
                    'tanggal'   => $this->input->post('tanggal'),
                    'durasi_pekerjaan' => $this->input->post('durasi_pekerjaan'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $tor_id = $this->input->post('id');

                if ($tor_id != null || $tor_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'tor/'.$this->filesUpload('tor', 'upload', 'file_upload', 'torUploadUpdate', 'update', 'tor' , 'id_tor');
                    }
                    $result = $this->General_m->update($table, $data, ["id_tor" => $tor_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'tor/'.$this->filesUpload('tor', 'upload', null, 'torUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["tor_id" => $result], ["id_pekerjaan" => $id]);
                }
            break;
            
            case 'tug':
                $table = "tug";
                $next = true;
                $tahapan = 'pengumpulan';
                $nextFor = "justifikasi";
                $data = [
                    'no_tug'    => $this->input->post('no'),
                    'tanggal'   => $this->input->post('tanggal'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $tug_id = $this->input->post('id');

                if ($tug_id != null || $tug_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'tug/'.$this->filesUpload('tug', 'upload', 'file_upload', 'tugUploadUpdate', 'update', 'tug' , 'id_tug');
                    }
                    $result = $this->General_m->update($table, $data, ["id_tug" => $tug_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'tug/'.$this->filesUpload('tug', 'upload', null, 'tugUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["tug_id" => $result], ["id_pekerjaan" => $id]);
                }
            break;

            case 'ba':
                $table = "ba";
                $next = true;
                $tahapan = 'pengumpulan';
                $nextFor = "rab";
                $data = [
                    'no_ba'    => $this->input->post('no'),
                    'tanggal'   => $this->input->post('tanggal'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_id = $this->input->post('id');

                if ($ba_id != null || $ba_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba/'.$this->filesUpload('ba', 'upload', 'file_upload', 'baUploadUpdate', 'update', 'ba' , 'id_ba');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba" => $ba_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba/'.$this->filesUpload('ba', 'upload', null, 'baUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_id" => $result], ["id_pekerjaan" => $id]);
                }
            break;

            case 'justifikasi':
                $table = "justifikasi";
                $next = false;
                $data = [
                    'jasa'   => $this->input->post('jasa'),
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $justifikasi_id = $this->input->post('id');

                if ($justifikasi_id != null || $justifikasi_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'justifikasi/'.$this->filesUpload('justifikasi', 'upload', 'file_upload', 'justifikasiUploadUpdate', 'update', 'justifikasi' , 'id_justifikasi');
                    }
                    $result = $this->General_m->update($table, $data, ["id_justifikasi" => $justifikasi_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'justifikasi/'.$this->filesUpload('justifikasi', 'upload', null, 'justifikasiUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["justifikasi_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            /*
            |--------------------------------------------------------------------------
            | MRO
            |--------------------------------------------------------------------------
            */
            case 'profile_risiko':
                $table = "profile_risiko";
                $next = true;
                $tahapan = 'mro';
                $nextFor = "kajian_risiko";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $profile_risiko_id = $this->input->post('id');

                if ($profile_risiko_id != null || $profile_risiko_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'profile_risiko/'.$this->filesUpload('profile_risiko', 'upload', 'file_upload', 'profile_risikoUploadUpdate', 'update', 'profile_risiko' , 'id_profile_risiko');
                    }
                    $result = $this->General_m->update($table, $data, ["id_profile_risiko" => $profile_risiko_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'profile_risiko/'.$this->filesUpload('profile_risiko', 'upload', null, 'profile_risikoUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["profile_risiko_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;
            
            case 'kajian_risiko':
                $table = "kajian_risiko";
                $next = false;
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $kajian_risiko_id = $this->input->post('id');

                if ($kajian_risiko_id != null || $kajian_risiko_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'kajian_risiko/'.$this->filesUpload('kajian_risiko', 'upload', 'file_upload', 'kajian_risikoUploadUpdate', 'update', 'kajian_risiko' , 'id_kajian_risiko');
                    }
                    $result = $this->General_m->update($table, $data, ["id_kajian_risiko" => $kajian_risiko_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'kajian_risiko/'.$this->filesUpload('kajian_risiko', 'upload', null, 'kajian_risikoUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["kajian_risiko_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            /*
            |--------------------------------------------------------------------------
            | Perencanaan Pengadaan
            |--------------------------------------------------------------------------
            */
            case 'kkp':
                $table = "kkp";
                $next = true;
                $tahapan = 'perencanaan_pengadaan';
                $nextFor = "rks";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $kkp_id = $this->input->post('id');

                if ($kkp_id != null || $kkp_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'kkp/'.$this->filesUpload('kkp', 'upload', 'file_upload', 'kkpUploadUpdate', 'update', 'kkp' , 'id_kkp');
                    }
                    $result = $this->General_m->update($table, $data, ["id_kkp" => $kkp_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'kkp/'.$this->filesUpload('kkp', 'upload', null, 'kkpUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["kkp_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;
            
            case 'rks':
                $table = "rks";
                $next = true;
                $tahapan = 'perencanaan_pengadaan';
                $nextFor = "referensi_harga";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $rks_id = $this->input->post('id');

                if ($rks_id != null || $rks_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'rks/'.$this->filesUpload('rks', 'upload', 'file_upload', 'rksUploadUpdate', 'update', 'rks' , 'id_rks');
                    }
                    $result = $this->General_m->update($table, $data, ["id_rks" => $rks_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'rks/'.$this->filesUpload('rks', 'upload', null, 'rksUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["rks_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'referensi_harga':
                $table = "referensi_harga";
                $next = true;
                $tahapan = 'perencanaan_pengadaan';
                $nextFor = "hpe";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $referensi_harga_id = $this->input->post('id');

                if ($referensi_harga_id != null || $referensi_harga_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'referensi_harga/'.$this->filesUpload('referensi_harga', 'upload', 'file_upload', 'referensi_hargaUploadUpdate', 'update', 'referensi_harga' , 'id_referensi_harga');
                    }
                    $result = $this->General_m->update($table, $data, ["id_referensi_harga" => $referensi_harga_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'referensi_harga/'.$this->filesUpload('referensi_harga', 'upload', null, 'referensi_hargaUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["referensi_harga_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'hpe':
                $table = "hpe";
                $next = false;
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $hpe_id = $this->input->post('id');

                if ($hpe_id != null || $hpe_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'hpe/'.$this->filesUpload('hpe', 'upload', 'file_upload', 'hpeUploadUpdate', 'update', 'hpe' , 'id_hpe');
                    }
                    $result = $this->General_m->update($table, $data, ["id_hpe" => $hpe_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'hpe/'.$this->filesUpload('hpe', 'upload', null, 'hpeUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["hpe_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            /*
            |--------------------------------------------------------------------------
            | Pelaksanaan Pengadaan
            |--------------------------------------------------------------------------
            */
            case 'hps':
                $table = "hps";
                $next = true;
                $tahapan = 'pelaksanaan_pengadaan';
                $nextFor = "ba_aanwijzing";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $hps_id = $this->input->post('id');

                if ($hps_id != null || $hps_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'hps/'.$this->filesUpload('hps', 'upload', 'file_upload', 'hpsUploadUpdate', 'update', 'hps' , 'id_hps');
                    }
                    $result = $this->General_m->update($table, $data, ["id_hps" => $hps_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'hps/'.$this->filesUpload('hps', 'upload', null, 'hpsUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["hps_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;
            
            case 'ba_aanwijzing':
                $table = "ba_aanwijzing";
                $next = true;
                $tahapan = 'pelaksanaan_pengadaan';
                $nextFor = "cda";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_aanwijzing_id = $this->input->post('id');

                if ($ba_aanwijzing_id != null || $ba_aanwijzing_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_aanwijzing/'.$this->filesUpload('ba_aanwijzing', 'upload', 'file_upload', 'ba_aanwijzingUploadUpdate', 'update', 'ba_aanwijzing' , 'id_ba_aanwijzing');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba_aanwijzing" => $ba_aanwijzing_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_aanwijzing/'.$this->filesUpload('ba_aanwijzing', 'upload', null, 'ba_aanwijzingUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_aanwijzing_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'cda':
                $table = "cda";
                $next = true;
                $tahapan = 'pelaksanaan_pengadaan';
                $nextFor = "perjanjian";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $cda_id = $this->input->post('id');

                if ($cda_id != null || $cda_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'cda/'.$this->filesUpload('cda', 'upload', 'file_upload', 'cdaUploadUpdate', 'update', 'cda' , 'id_cda');
                    }
                    $result = $this->General_m->update($table, $data, ["id_cda" => $cda_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'cda/'.$this->filesUpload('cda', 'upload', null, 'cdaUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["cda_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'perjanjian':
                $table = "perjanjian";
                $next = true;
                $tahapan = 'pelaksanaan_pengadaan';
                $nextFor = "jaminan_pelaksanaan_pemeliharaan";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $perjanjian_id = $this->input->post('id');

                if ($perjanjian_id != null || $perjanjian_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'perjanjian/'.$this->filesUpload('perjanjian', 'upload', 'file_upload', 'perjanjianUploadUpdate', 'update', 'perjanjian' , 'id_perjanjian');
                    }
                    $result = $this->General_m->update($table, $data, ["id_perjanjian" => $perjanjian_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'perjanjian/'.$this->filesUpload('perjanjian', 'upload', null, 'perjanjianUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["perjanjian_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'jaminan_pelaksanaan_pemeliharaan':
                $table = "jaminan_pelaksanaan_pemeliharaan";
                $next = false;
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $jaminan_pelaksanaan_pemeliharaan_id = $this->input->post('id');

                if ($jaminan_pelaksanaan_pemeliharaan_id != null || $jaminan_pelaksanaan_pemeliharaan_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'jaminan_pelaksanaan_pemeliharaan/'.$this->filesUpload('jaminan_pelaksanaan_pemeliharaan', 'upload', 'file_upload', 'jaminan_pelaksanaan_pemeliharaanUploadUpdate', 'update', 'jaminan_pelaksanaan_pemeliharaan' , 'id_jaminan_pelaksanaan_pemeliharaan');
                    }
                    $result = $this->General_m->update($table, $data, ["id_jaminan_pelaksanaan_pemeliharaan" => $jaminan_pelaksanaan_pemeliharaan_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'jaminan_pelaksanaan_pemeliharaan/'.$this->filesUpload('jaminan_pelaksanaan_pemeliharaan', 'upload', null, 'jaminan_pelaksanaan_pemeliharaanUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["jaminan_pelaksanaan_pemeliharaan_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            /*
            |--------------------------------------------------------------------------
            | Pelaksanaan Pekerjaan
            |--------------------------------------------------------------------------
            */
            case 'kick_off':
                $table = "kick_off";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "spk";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $kick_off_id = $this->input->post('id');

                if ($kick_off_id != null || $kick_off_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'kick_off/'.$this->filesUpload('kick_off', 'upload', 'file_upload', 'kick_offUploadUpdate', 'update', 'kick_off' , 'id_kick_off');
                    }
                    $result = $this->General_m->update($table, $data, ["id_kick_off" => $kick_off_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'kick_off/'.$this->filesUpload('kick_off', 'upload', null, 'kick_offUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["kick_off_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;
            
            case 'spk':
                $table = "spk";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "spm";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $spk_id = $this->input->post('id');

                if ($spk_id != null || $spk_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'spk/'.$this->filesUpload('spk', 'upload', 'file_upload', 'spkUploadUpdate', 'update', 'spk' , 'id_spk');
                    }
                    $result = $this->General_m->update($table, $data, ["id_spk" => $spk_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'spk/'.$this->filesUpload('spk', 'upload', null, 'spkUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["spk_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'spm':
                $table = "spm";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "lpp";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $spm_id = $this->input->post('id');

                if ($spm_id != null || $spm_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'spm/'.$this->filesUpload('spm', 'upload', 'file_upload', 'spmUploadUpdate', 'update', 'spm' , 'id_spm');
                    }
                    $result = $this->General_m->update($table, $data, ["id_spm" => $spm_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'spm/'.$this->filesUpload('spm', 'upload', null, 'spmUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["spm_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'lpp':
                $table = "lpp";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "nrpp";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $lpp_id = $this->input->post('id');

                if ($lpp_id != null || $lpp_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'lpp/'.$this->filesUpload('lpp', 'upload', 'file_upload', 'lppUploadUpdate', 'update', 'lpp' , 'id_lpp');
                    }
                    $result = $this->General_m->update($table, $data, ["id_lpp" => $lpp_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'lpp/'.$this->filesUpload('lpp', 'upload', null, 'lppUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["lpp_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'nrpp':
                $table = "nrpp";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "ba_stp";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $nrpp_id = $this->input->post('id');

                if ($nrpp_id != null || $nrpp_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'nrpp/'.$this->filesUpload('nrpp', 'upload', 'file_upload', 'nrppUploadUpdate', 'update', 'nrpp' , 'id_nrpp');
                    }
                    $result = $this->General_m->update($table, $data, ["id_nrpp" => $nrpp_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'nrpp/'.$this->filesUpload('nrpp', 'upload', null, 'nrppUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["nrpp_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'ba_stp':
                $table = "ba_stp";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "ba_pembayaran";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_stp_id = $this->input->post('id');

                if ($ba_stp_id != null || $ba_stp_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_stp/'.$this->filesUpload('ba_stp', 'upload', 'file_upload', 'ba_stpUploadUpdate', 'update', 'ba_stp' , 'id_ba_stp');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba_stp" => $ba_stp_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_stp/'.$this->filesUpload('ba_stp', 'upload', null, 'ba_stpUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_stp_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'ba_pembayaran':
                $table = "ba_pembayaran";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "ba_smp";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_pembayaran_id = $this->input->post('id');

                if ($ba_pembayaran_id != null || $ba_pembayaran_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_pembayaran/'.$this->filesUpload('ba_pembayaran', 'upload', 'file_upload', 'ba_pembayaranUploadUpdate', 'update', 'ba_pembayaran' , 'id_ba_pembayaran');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba_pembayaran" => $ba_pembayaran_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_pembayaran/'.$this->filesUpload('ba_pembayaran', 'upload', null, 'ba_pembayaranUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_pembayaran_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'ba_smp':
                $table = "ba_smp";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "ba_pemeriksaan";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_smp_id = $this->input->post('id');

                if ($ba_smp_id != null || $ba_smp_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_smp/'.$this->filesUpload('ba_smp', 'upload', 'file_upload', 'ba_smpUploadUpdate', 'update', 'ba_smp' , 'id_ba_smp');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba_smp" => $ba_smp_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_smp/'.$this->filesUpload('ba_smp', 'upload', null, 'ba_smpUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_smp_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'ba_pemeriksaan':
                $table = "ba_pemeriksaan";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "amandemen_perjanjian";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_pemeriksaan_id = $this->input->post('id');

                if ($ba_pemeriksaan_id != null || $ba_pemeriksaan_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_pemeriksaan/'.$this->filesUpload('ba_pemeriksaan', 'upload', 'file_upload', 'ba_pemeriksaanUploadUpdate', 'update', 'ba_pemeriksaan' , 'id_ba_pemeriksaan');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba_pemeriksaan" => $ba_pemeriksaan_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_pemeriksaan/'.$this->filesUpload('ba_pemeriksaan', 'upload', null, 'ba_pemeriksaanUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_pemeriksaan_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'amandemen_perjanjian':
                $table = "amandemen_perjanjian";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "ba_denda";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $amandemen_perjanjian_id = $this->input->post('id');

                if ($amandemen_perjanjian_id != null || $amandemen_perjanjian_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'amandemen_perjanjian/'.$this->filesUpload('amandemen_perjanjian', 'upload', 'file_upload', 'amandemen_perjanjianUploadUpdate', 'update', 'amandemen_perjanjian' , 'id_amandemen_perjanjian');
                    }
                    $result = $this->General_m->update($table, $data, ["id_amandemen_perjanjian" => $amandemen_perjanjian_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'amandemen_perjanjian/'.$this->filesUpload('amandemen_perjanjian', 'upload', null, 'amandemen_perjanjianUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["amandemen_perjanjian_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'ba_denda':
                $table = "ba_denda";
                $next = true;
                $tahapan = 'pelaksanaan_pekerjaan';
                $nextFor = "dokumen_audit";
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $ba_denda_id = $this->input->post('id');

                if ($ba_denda_id != null || $ba_denda_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_denda/'.$this->filesUpload('ba_denda', 'upload', 'file_upload', 'ba_dendaUploadUpdate', 'update', 'ba_denda' , 'id_ba_denda');
                    }
                    $result = $this->General_m->update($table, $data, ["id_ba_denda" => $ba_denda_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'ba_denda/'.$this->filesUpload('ba_denda', 'upload', null, 'ba_dendaUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["ba_denda_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            case 'dokumen_audit':
                $table = "dokumen_audit";
                $next = false;
                $data = [
                    'upload_cek'=> $this->input->post('upload_cek')
                ];

                $dokumen_audit_id = $this->input->post('id');

                if ($dokumen_audit_id != null || $dokumen_audit_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'dokumen_audit/'.$this->filesUpload('dokumen_audit', 'upload', 'file_upload', 'dokumen_auditUploadUpdate', 'update', 'dokumen_audit' , 'id_dokumen_audit');
                    }
                    $result = $this->General_m->update($table, $data, ["id_dokumen_audit" => $dokumen_audit_id]); 
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data['file_upload'] =  'dokumen_audit/'.$this->filesUpload('dokumen_audit', 'upload', null, 'dokumen_auditUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["dokumen_audit_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;

            /*
            |--------------------------------------------------------------------------
            | Pembayaran
            |--------------------------------------------------------------------------
            */
            case 'pembayaran':
                $table = "pembayaran";
                $next = false;
                $tahap = $this->input->post('tahap');
                $data = [
                    $tahap => $this->input->post('upload_cek')
                ];

                $pembayaran_id = $this->input->post('id');

                if ($pembayaran_id != null || $pembayaran_id != '') {
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data[$tahap] =  'pembayaran/'.$this->filesUpload('pembayaran', 'upload', $tahap, 'pembayaranUploadUpdate', 'update', 'pembayaran' , 'id_pembayaran');
                    }
                    $result = $this->General_m->update($table, $data, ["id_pembayaran" => $pembayaran_id]); 
                    // var_dump($result);die;
                }else{
                    if (! empty( $_FILES['upload']['name'] )) {
                        $data[$tahap] =  'pembayaran/'.$this->filesUpload('pembayaran', 'upload', null, 'pembayaranUpload', 'create');
                    }
                    $result = $this->General_m->save($table, $data); 
                    $this->General_m->update("pekerjaan", ["pembayaran_id" => $result], ["id_pekerjaan" => $id]);
                }   
            break;
        }

        if ($next == true) {
            redirect('main/tahapan_v/'.$tahapan.'/'.$id.'?child='.$nextFor);
        }else{
            if ($result) {
                $this->session->set_flashdata([
                    'alert'     => 'success',
                    'message'   => '<strong>Sukses <i class="fa fa-check-circle"></i></strong>',
                    ]);
            }else {
                $this->session->set_flashdata([
                    'alert'     => 'danger',
                    'message'   => '<strong>Gagal <i class="fa fa-times-circle"></i></strong>',
                    ]);
            }

            redirect('main/proses/data-pekerjaan/detail/'.$id);
        }
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
            case 'data-pekerjaan':
                $table = "pekerjaan" ;
                $data = [
                    'nama_pekerjaan'    => $this->input->post('nama_pekerjaan'),
                    'no_perjanjian'     => $this->input->post('no_perjanjian'),
                    'lokasi'            => $this->input->post('lokasi'),
                    'kapasitas'         => $this->input->post('kapasitas'),
                    'anggaran'          => $this->input->post('anggaran'),
                    'sumber_dana'       => $this->input->post('sumber_dana'),
                    'direksi_pekerjaan' => $this->input->post('direksi_pekerjaan'),
                    'pelaksana'         => $this->input->post('pelaksana'),
                    'start_date'        => $this->input->post('start_date'),
                    'finish_date'       => $this->input->post('finish_date')
                ];
            break;
            
            case 'user':
                $table = "user" ;
                $data = [
                    'nama_depan'    => $this->input->post('nama_depan'),
                    'nama_belakang'     => $this->input->post('nama_belakang'),
                    'email'            => $this->input->post('email'),
                    'pass'            => md5($this->input->post('pass')),
                    'role'       => $this->input->post('role'),
                    'verifikasi'         => $this->input->post('verifikasi')
                ];
                
                if ($this->input->post('verifikasi') == true) {
                    $data['verifikasi'] = 1;
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
            break;
            case 'data-pekerjaan':
                $table = "pekerjaan" ;
                $where = ['id_pekerjaan' => $this->input->post('id')];
                $data = [
                    'nama_pekerjaan'    => $this->input->post('nama_pekerjaan'),
                    'no_perjanjian'     => $this->input->post('no_perjanjian'),
                    'lokasi'            => $this->input->post('lokasi'),
                    'kapasitas'         => $this->input->post('kapasitas'),
                    'anggaran'          => $this->input->post('anggaran'),
                    'sumber_dana'       => $this->input->post('sumber_dana'),
                    'direksi_pekerjaan' => $this->input->post('direksi_pekerjaan'),
                    'pelaksana'         => $this->input->post('pelaksana'),
                    'start_date'        => $this->input->post('start_date'),
                    'finish_date'       => $this->input->post('finish_date')
                ];
            break; 
            case 'user':
                $table = "user" ;
                $where = ['id_user' => $this->input->post('id')];
                $data = [
                    'nama_depan'    => $this->input->post('nama_depan'),
                    'nama_belakang'     => $this->input->post('nama_belakang'),
                    'email'            => $this->input->post('email'),
                    'role'         => $this->input->post('role')
                ];

                if ($this->input->post('pass') != '') {
                    $data['pass'] = md5($this->input->post('pass'));
                }

                if ($this->input->post('verifikasi') == true) {
                    $data['verifikasi'] = 1;
                }else{
                    $data['verifikasi'] = 0;
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
            case 'pengumpulan':
                $table = 'rab';
                $where = ['id_rab' => $this->input->post('id')];
                $this->filesUpload('rab', '', "file_upload", '', 'delete', 'rab' , 'id_rab');
                break;
            case 'data-pekerjaan':
                $table = "pekerjaan" ;
                $where = ['id_pekerjaan' => $this->input->post('id')];
                break;
            case 'user':
                $table = "user" ;
                $where = ['id_user' => $this->input->post('id')];
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
            'role'              => 'user'
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
            if ($user->role == 'user' && $user->verifikasi == 0) {
                $this->session->set_flashdata('message', 'Email belum diverifikasi oleh Admin');
            }else{
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
