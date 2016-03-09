'use strict';

angular.module('chatApp', ['ngRoute'])

	.config(function($routeProvider) {
		
		$routeProvider
		
		.when('/drugs', {
			templateUrl: 'partials/newShow.html',
			controller: 'DrugsController'
		})
	});