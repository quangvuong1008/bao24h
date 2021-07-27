
<div class="modal fade" id="modal_post_meta" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật thông tin
                    url</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <a href="<?= $url = $model->getUrl() ?>" style="padding: 8px;"
               target="_blank"><?=$url?></a>
            <form action=" <?php echo base_url() . '/quantri/posts/meta/' . $model->id;?> " method="post" >
                <div class="modal-body">
                    <div class="form-group">
                        <label class="bmd-label-floating">Meta Title</label>
                        <input type="text" name="meta_title" autocomplete="off"
                               class="form-control"
                               value="<?php echo $model->meta_title; ?>">
                    </div>
                    <div class="form-intro">
                        <label class="bmd-label no-margin">Meta Keywords</label>
                        <textarea name="meta_keywords" autocomplete="off"
                                  class="form-control"><?php echo $model->meta_keywords; ?></textarea>
                    </div>
                    <div class="form-intro">
                        <label class="bmd-label no-margin">Meta Description</label>
                        <textarea name="meta_description" autocomplete="off"
                                  class="form-control"><?php echo $model->meta_description; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng
                    </button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>