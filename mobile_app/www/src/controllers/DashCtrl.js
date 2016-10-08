/***********************
 * Controller : mainCtrl
 ***********************/

function DashCtrl($scope, mainService, $timeout) {

  var self = this;

  $scope.togglePeriod = function (event, period) {
    $scope.period = period;
  };
}

angular.module('app')
  .controller('DashCtrl', DashCtrl);
