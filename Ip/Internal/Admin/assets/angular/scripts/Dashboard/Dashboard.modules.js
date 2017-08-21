/**
 * @author k.danovsky
 * created on 15.01.2016
 */
(function () {
    'use strict';

    angular.module('Admin.modules.base.dashboard', [
        'adf',
        'adf.structures.base',
        'adf.widget.weather',
        'adf.widget.linklist',
        'adf.widget.pdfviewer',
        'adf.widget.table',
        'adf.widget.charts',
        'adf.widget.clock'
    ])
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider, dashboardProvider) {
        dashboardProvider.customWidgetTemplatePath('app/views/Directives/asd/widget.html');

        $stateProvider
            .state('parent.dashboard', {
                url: '/dashboard',
                //template : '<ui-view autoscroll="true" autoscroll-body-top></ui-view>',
                templateUrl : tplBase + 'app/views/Modules/Base/Dashboard/main.html',
                abstract: false,
                controller: 'DashboardBaseCtrl',
                authenticate: true,
            });
    }

})();