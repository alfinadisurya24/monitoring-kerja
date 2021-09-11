<?php 
    function rupiah($uang){
        $setRupiah = number_format($uang,0, ',', '.');
        return 'Rp '.$setRupiah.',-';
    }

    function tanggal_indo($tgl){
        $pecahWaktu = explode(" ", $tgl);

        $getTgl = explode("-", $pecahWaktu[0]);
        $tgl    = $getTgl[2];
        $bulan  = bulan_indonesia($getTgl[1]);
        $tahun  = $getTgl[0];
        
        return $tgl ." ". $bulan ." ". $tahun; 
    }
    
    function bulan_indonesia($bulan){

        $bulanArray = [
            '01'  => "Januari",
            '02'  => "Febuari",
            '03'  => "Maret",
            '04'  => "April",
            '05'  => "Mei",
            '06'  => "Juni",
            '07'  => "Juli",
            '08'  => "Agustus",
            '09'  => "September",
            '10' => "Oktober",
            '11' => "November",
            '12' => "Desember"
        ];

        $setBulan = $bulanArray[$bulan];  

        return $setBulan;
    }

    function nama_hari($hari){

        $hariArray = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $setHari = $hariArray[$hari];  

        return $setHari;
    }

?>
