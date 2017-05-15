<div class="page-header">
	<?php if ( ! empty( $icon ) ) { ?>
        <img class="_icon" src="<?php echo escAttr( $icon ) ?>" alt="Plugin icon"/>
	<?php } ?>

    <h1><?php echo esc( $plugin['title'] ) ?></h1>
</div>
<div class="_actions clearfix">
	<?php if ( $plugin['active'] ) { ?>
        <button class="ipsDeactivate btn btn-default" type="button"
                role="button"><?php _e( 'Deactivate', 'Ip-admin' ); ?></button>
	<?php } else { ?>
        <button class="ipsDelete btn btn-danger pull-right" type="button"
                role="button"><?php _e( 'Delete', 'Ip-admin' ); ?><i class="fa fa-fw fa-trash-o"></i></button>
        <button class="ipsActivate btn btn-new" type="button"
                role="button"><?php _e( 'Activate', 'Ip-admin' ); ?></button>
	<?php } ?>
</div>
<p><?php echo esc( $plugin['description'] ); ?></p>
<ul class="_details">
    <li><strong><?php _e( 'Author', 'Ip-admin' ); ?>:</strong> <?php echo esc( $plugin['author'] ); ?></li>
    <li><strong><?php _e( 'Name', 'Ip-admin' ); ?>:</strong> <?php echo esc( $plugin['name'] ); ?></li>
    <li><strong><?php _e( 'Version', 'Ip-admin' ); ?>:</strong> <?php echo esc( $plugin['version'] ); ?></li>
</ul>
<?php if ( ! empty( $form ) ) { ?>
	<?php echo $form->render(); ?>
<?php } ?>

<?php if ( ! empty( $plugin['usage'] ) ): ?>
    <h3><?php echo __( 'Usage', 'Ip-admin' ) ?></h3>
	<?php foreach ( $plugin['usage'] as $usage ): ?>
        <h4><?php echo strtoupper( $usage['type'] ) ?></h4>

		<?php if ( ! empty( $usage['info'] ) ): ?>
            <div class="col-md-12">
                <div class="alert alert-info">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    <strong><?php echo __( 'Info!', 'Ip-admin', false ) ?></strong>
                    <hr class="message-inner-separator">
                    <p>
						<?php echo $usage['info'] ?>
                    </p>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $usage['warn'] ) ): ?>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <span class="glyphicon glyphicon-record"></span>
                    <strong><?php echo __( 'Warning!', 'Ip-admin', false ) ?></strong>
                    <hr class="message-inner-separator">
                    <p>
						<?php echo $usage['warn'] ?>
                    </p>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $usage['error'] ) ): ?>
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-hand-right"></span>
                    <strong><?php echo __( 'Error!', 'Ip-admin', false ) ?></strong>
                    <hr class="message-inner-separator">
                    <p>
						<?php echo $usage['error'] ?>
                    </p>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $usage['success'] ) ): ?>
            <div class="col-md-12">
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok"></span>
                    <strong><?php echo __( 'Success!', 'Ip-admin', false ) ?></strong>
                    <hr class="message-inner-separator">
                    <p>
						<?php echo $usage['success'] ?>
                    </p>
                </div>
            </div>
		<?php endif; ?>

        <pre><code class="language-<?php echo strtolower( $usage['type'] ) ?>"><?php echo esc( $usage['code'] ); ?></code></pre>
	<?php endforeach; ?>
<?php endif; ?>

<script>
    (function($){
        $(document).ready(function (){
            $('pre').each(function (e) {
                var code = $(this).find('code');
                Prism.highlightElement(code[0], true, function (ret) {
                    console.log(ret);
                });
            });
        });
    })(jQuery);
</script>

<style>
    hr.message-inner-separator
    {
        clear: both;
        margin-top: 10px;
        margin-bottom: 13px;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
        background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    }
</style>