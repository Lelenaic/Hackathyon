/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/www/dist";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	/**********************
	 * modules registering
	 *********************/
	__webpack_require__(2);




/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	/*********************
	 * Services injections
	 *********************/
	__webpack_require__(3);

	/************************
	 * Controllers injections
	 ************************/
	__webpack_require__(4);


/***/ },
/* 3 */
/***/ function(module, exports) {

	/***********************
	 * Service : mainService
	 ***********************/

	function mainService() {
	    var self = this;

	    self.data = {
	        hello: 'Hello my friiiiiend'
	    };

	    return self;
	}

	angular.module('app')
	    .service('mainService', mainService);


/***/ },
/* 4 */
/***/ function(module, exports) {

	/***********************
	 * Controller : mainCtrl
	 ***********************/

	function mainCtrl($scope, mainService) {

	    var self = this;

	    $scope.hello = mainService.data.hello;
	}

	angular.module('app')
	    .controller('mainCtrl', mainCtrl);


/***/ }
/******/ ]);