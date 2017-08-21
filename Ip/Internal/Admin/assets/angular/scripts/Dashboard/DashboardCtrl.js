(function () {
    'use strict';

    angular.module('Admin.modules.base.dashboard')
        .controller('DashboardBaseCtrl', DashboardCtrl);

    /** @ngInject */
    function DashboardCtrl($scope, ApiService) {
        var name = 'sample-01';
        var model = {
            "title": "Financeiro",
            "structure": "4-8",
            "rows": [
                {
                    "columns": [
                        {
                            "styleClass": "col-md-4",
                            "widgets": [
                                {
                                    "type": "weather",
                                    "portletClass": "portlet solid grey-cascade",
                                    "config": {
                                        location: 'Penha,br'
                                    },
                                    "title": "Previsão do Tempo",
                                    "titleTemplateUrl": "../src/templates/widget-title.html",
                                    "editTemplateUrl": "../src/templates/widget-edit.html",
                                },
                                {
                                    "type": "clock",
                                    "config": {
                                        datePattern: 'DD/MM/YYYY',
                                        timePattern: 'hh:mm a'
                                    },
                                    "title": "",
                                    "titleTemplateUrl": "../src/templates/widget-title.html",
                                    "editTemplateUrl": "../src/templates/widget-edit.html",
                                }
                            ],
                        },
                        {
                            "styleClass": "col-md-8",
                            "widgets": [
                                {
                                    "type": "table",
                                    "config": {
                                        table: [
                                            {
                                                title: 'Como Conheceu',
                                                url: '//impress.app/?sa=KbApi.table&table=gymConheceu',
                                                root: 'rows',
                                                columns: [
                                                    {title: '#', path: 'id'},
                                                    {title: 'Nome', path: 'name'}
                                                ]
                                            }
                                        ]
                                    },
                                    "title": "Tabela",
                                    "titleTemplateUrl": "../src/templates/widget-title.html",
                                    "editTemplateUrl": "../src/templates/widget-edit.html",
                                }
                            ]
                        }
                    ],
                }],
            "titleTemplateUrl": "../src/templates/dashboard-title.html"
        };

        $scope.name = name;
        $scope.model = model;
        $scope.collapsible = false;
        $scope.maximizable = false;
        $scope.categories = true;

        $scope.$on('adfDashboardChanged', function (event, name, model) {
            console.log(name, model)
        });
    }

})();