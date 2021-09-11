<?php
    header("Content-type: application/vnd-ms-excel");
 
    header("Content-Disposition: attachment; filename=Data Pekerjaan.xls");
    
    header("Pragma: no-cache");
    
    header("Expires: 0");
?>

<table>
    <thead>
        <tr>
            <th colspan="12" style="background-color: yellow;">Data Pekerjaan</th>
        </tr>
        <tr>
            <th class="text-center">Nomor</th>
            <th>Nama Pekerjaan</th>
            <th>Nomor Perjanjian</th>
            <th>Lokasi</th>
            <th>Kapasitas</th>
            <th>Anggaran</th>
            <th>Sumber Dana</th>
            <th>Direksi Pekerjaan</th>
            <th>Pelaksana</th>
            <th>Start</th>
            <th>Finish</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1; 
        foreach ($getData as $key => $value) { ?>
        <tr>
            <td><?= $i++ ?></td>
            <td class="text-dark"><?= $value->nama_pekerjaan ?></td>
            <td class="text-dark"><?= $value->no_perjanjian ?></td>
            <td class="text-dark"><?= $value->lokasi ?></td>
            <td class="text-dark"><?= $value->kapasitas ?></td>
            <td class="text-dark"><?= rupiah($value->anggaran) ?></td>
            <td class="text-dark"><?= $value->sumber_dana ?></td>
            <td class="text-dark"><?= $value->direksi_pekerjaan ?></td>
            <td class="text-dark"><?= $value->pelaksana ?></td>
            <td class="text-dark"><?= tanggal_indo($value->start_date) ?></td>
            <td class="text-dark"><?= tanggal_indo($value->finish_date) ?></td>
            <td class="text-dark">
                <?php
                    $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                    if ($progress == 100) { 
                ?>
                <div style="background-color: aqua; padding: 0.5rem;">
                    <strong>Completed</strong> (<?= $progress ?>%)
                </div>
                <?php }else{ ?>
                <div style="background-color: red; padding: 0.5rem;">
                    <strong>On Progress</strong> (<?= $progress ?>%)
                </div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>