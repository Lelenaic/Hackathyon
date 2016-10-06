function mainCtrl($scope, mainService) {

    var self = this;

    $scope.hello = mainService.data.hello;
}

angular.module('app')
    .controller('mainCtrl', mainCtrl);
