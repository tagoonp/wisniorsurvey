<div class="modal fade" id="modalAlbum" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalCenterTitle">อัลบัมรูปภาพ</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <?php 
                $strSQL = "SELECT * FROM ecw_album WHERE album_delete = 'N' AND album_id IN (SELECT upload_album_id FROM ecw_album_media WHERE upload_album_id IS NOT NULL) ORDER BY album_id DESC LIMIT 50";
                $res = $db->fetch($strSQL, true, true);
                if(($res) && ($res['status'])){
                    foreach ($res['data'] as $row) {
                    if(($row['album_figure'] != '') && ($row['album_figure'] != 'null')){
                        ?>
                        <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;">
                            <div class="img-covering"  onclick="window.location='app-album-media?id=<?php echo $row['album_id'];?>'" style="background-image: url('<?php echo $row['upload_url_thumb']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                            <div class="pt-1">
                                <div class="form-check mt-1">
                                    <input id="default-radio-<?php echo $row['album_id'];?>" name="imageAlbum" class="form-check-input" type="radio" value="<?php echo $row['album_id'];?>" />
                                </div>
                            </div>
                        </div>
                        <?php
                    }else{

                        $strSQL = "SELECT * FROM ecw_album_media WHERE upload_album_id = '".$row['album_id']."' LIMIT 1";
                        $res = $db->fetch($strSQL, false, false);
                        if($res){
                        ?>
                        <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;" >
                            <div class="img-covering"  onclick="window.location='app-album-media?id=<?php echo $row['album_id'];?>'" style="background-image: url('<?php echo $res['upload_url_thumb']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                            <div class="pt-1">
                                <div class="form-check mt-1">
                                    <input id="default-radio-<?php echo $row['album_id'];?>" name="imageAlbum" class="form-check-input" type="radio" value="<?php echo $row['album_id'];?>" />
                                </div>
                            </div>
                        </div>
                        <?php
                        }else{
                        ?>
                        <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;">
                            <div class="img-covering"  onclick="window.location='app-album-media?id=<?php echo $row['album_id'];?>'" style="background-image: url('<?php echo $row['upload_url_thumb']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                            <div class="pt-1">
                                <div class="form-check mt-1">
                                    <input id="default-radio-<?php echo $row['album_id'];?>" name="imageAlbum" class="form-check-input" type="radio" value="<?php echo $row['album_id'];?>" />
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    }
                }
                ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    ปิด
                </button>
                <button type="button" class="btn btn-primary" onclick="selectAlbum()">เลือก</button>
            </div>
        </div>
    </div>
</div>