<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>decocms</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <?php echo ipHead();?>

    <script type="application/javascript">
        var baseUrl = '<?php echo ipHomeUrl()?>';
        var tplBase = 'src/';
    </script>

    <link rel="stylesheet" href="http://localhost.dev/dashboard/dist/angular-dashboard-framework.css">
</head>
<body id="app" data-ng-app="Admin" ng-class="{'page-container-bg-solid page-header-menu-fixed': !isLogin, 'login': isLogin}">

<div class="page-wrapper" ng-cloak="" ng-if="!isLogin">
    <div class="page-wrapper-row">
        <div class="page-wrapper-top" ng-include="tplBase + 'app/views/layout/header.html'"></div>
    </div>
    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <div class="page-head" ng-if="parentTitle != ''">
                    <div class="container-fluid">
                        <div class="page-title">
                            <h1 ng-bind-html="parentTitle |trust"></h1>
                        </div>
                    </div>
                </div>
                <div class="page-content-wrapper view-container container-fluid"
                     ng-class="admin.pageTransition.class"
                     data-ui-view>

                </div>
            </div>
        </div>
    </div>
    <div class="page-wrapper-row">
        <div class="page-wrapper-bottom">
            <!-- BEGIN INNER FOOTER -->
            <div class="page-footer">
                <div class="container">
                    {{copyYear}} &copy; &nbsp;
                    <a target="_blank" href="http://kosbit.com.br">
                        <img ng-src="{{config.logoInverse}}"
                             style="height: 50px; margin-left: -20px; margin-top: -16px;"
                             class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
            <!-- END INNER FOOTER -->
        </div>
    </div>
</div>

<div class="user-login-5"
     ng-if="isLogin"
     ng-class="admin.pageTransition.class"
     data-ui-view>

</div>

<?php echo ipJs()?>

</body>
</html>
