/***********************
 * Service : mainService
 ***********************/

function mainService() {
    var self = this;

    self.data = {
        hello: 'Hello my friiiiiiiend'
    };

    return self;
}

angular.module('app')
    .service('mainService', mainService);
