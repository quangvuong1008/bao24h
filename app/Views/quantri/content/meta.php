<?php
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\RouterUrlModel $model
 */
?>
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Cập nhật thông tin url</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<a href="<?= ($url = $model->getUrl()) ?>" style="padding: 8px;" target="_blank"><?= $url ?></a>
<form action="<?= route_to('admin_content_meta', urlencode($model->object_name), $model->object_id) ?>"
      method="post" class="ajax-form">
    <div class="modal-body">
        <div class="form-group">
            <label class="bmd-label-floating">Meta Title</label>
            <input type="text" name="meta_title" autocomplete="off" class="form-control"
                   value="<?= $model->meta_title ?>">
        </div>
        <div class="form-intro">
            <label class="bmd-label no-margin">Meta Keywords</label>
            <textarea name="meta_keywords" autocomplete="off"
                      class="form-control"><?= $model->meta_keywords ?></textarea>
        </div>
        <div class="form-intro">
            <label class="bmd-label no-margin">Meta Description</label>
            <textarea name="meta_description" autocomplete="off"
                      class="form-control"><?= $model->meta_description ?></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-info">Lưu thay đổi</button>
    </div>
</form>