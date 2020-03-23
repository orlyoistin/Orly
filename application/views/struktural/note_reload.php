<?
defined('SYSPATH') or die('No direct script access.');
?>
<div class="col-md-12">
    <div class="row">
        <?
        if($n==0) {
          ?>
          <div class="alert alert-success alert-dismissable">
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            Semua dokumen telah anda proses<br>
            Untuk melihat semua dokumen yang telah anda proses silakan <a href="<? echo URL::base()."struktural/note"; ?>">KLIK DISINI</a>
          </div>
          <?
          die();
        }
        ?>     
        <ul class="timeline">
        <?
        foreach($results as $note) {
            $tanggal_terima = new DateTime($note->tanggal_terima);
            $tanggal_surat = new DateTime($note->tanggal_surat);
            $masuk = ORM::factory('Masuk',$note->masuk_id);
            $rekomendasi = "";
            ?>
            <li class="time-label">
              <span class="bg-red">
                <? echo $tanggal_terima->format("d F Y"); ?>
              </span>
            </li>
            <li>
              <i class="fa fa-envelope bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <? echo $tanggal_surat->format("d F Y"); ?></span>
                <h3 class="timeline-header"><a href="#"><? echo $masuk->perihal; ?></a><br> <? echo $masuk->nomor; ?></h3>
                <h5 class="timeline-header"><? echo $masuk->name; ?></h5>
                <div class="timeline-body">
                    <? 
                    echo $masuk->isi.$rekomendasi;
                    echo "<br><br><a data-fancybox data-type='iframe' class='btn btn-warning btn-xs' data-src='".URL::base()."assets/doc/".$masuk->file."'>Attachment</a>"; 
                    echo "&nbsp;<a data-fancybox data-type='ajax' class='btn btn-info btn-xs' data-src='".URL::base()."struktural/history/index/".$masuk->id."'>History</a>"; 
                    ?></div>
                <div class="timeline-footer pull-right">
                  <a data-fancybox data-type="ajax" class="btn btn-primary btn-xs" data-src="<? echo URL::base()."struktural/disposisi/new/".$note->jenis."/".$note->data_id."/".$masuk->id; ?>">Disposisikan</a>
                  <a class="btn btn-danger btn-xs read" jenis="<? echo $note->jenis; ?>" data_id="<? echo $note->data_id; ?>" targetdata="struktural/note/reload/1" href="<? echo URL::base()."struktural/note/read/".$note->jenis."/".$note->data_id; ?>">Mark Read</a>
                </div>
                <?
                if($note->status == 2) {
                    ?>
                    <div class="timeline-footer pull-left">
                        <i class="fa fa-thumbs-up text-blue faa-vertical animated"></i> DOKUMEN INI SUDAH ANDA PROSES                                
                    </div>
                    <?
                }
                ?>
              </div>
            </li>
            <?
        }
        ?>
        <li>
          <i class="fa fa-clock-o bg-gray"></i>
        </li>
      </ul>
    </div>
</div>
