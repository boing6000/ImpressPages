<div class="ipsFiles"></div>
<div class="ipsUploadProgressContainer  <?php echo $allowUpload ? '' : 'hidden' ?>">
    <select class="form-control ipSelectFolder" style="margin-bottom: 0px;"></select>
    <div class="ipsCurErrors"></div>
    <div class="ipsBrowseButtonWrapper _browseButtonWrapper">
        <span class="_label _dragdropNotice"><?php _e('Drag&drop files here or click a button to upload.', 'Ip-admin'); ?></span>
        <a href="#" class="btn btn-primary" id="ipsModuleRepositoryUploadButton"><?php _e('Add new', 'Ip-admin'); ?></a>
    </div>
    <div class="_browseButtonWrapper hidden">
        <span class="_label"><?php _e('Need more images? Browse and choose from thousands of them.', 'Ip-admin'); ?></span>
        <a href="#ipsModuleRepositoryTabBuy" class="btn btn-warning"
           id="ipsModuleRepositoryBuyButton"><?php _e('Buy images', 'Ip-admin'); ?></a>
    </div>
    <form class="_form ipsBrowserCreateDir" action="">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control ipsTerm"
                   placeholder="<?php _e('Novo Diretório', 'Ip-admin'); ?>">
            <div class="input-group-btn">
                <button class="btn btn-default ipsSubmit" type="submit">
                    <i class="glyphicon glyphicon-folder-open"></i>
                </button>
            </div>
        </div>
    </form>
</div>
<div class="ipsUploadProgressItemSample hidden">
    <div class="ipModuleUploadProgressItem ipsUploadProgressItem">
        <div class="_progressbar ipsUploadProgressbar"></div>
        <p class="_title ipsUploadTitle"></p>
    </div>
</div>
<p class="ipsErrorSample alert alert-danger hidden"></p>
