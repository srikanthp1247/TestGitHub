/*
'use strict';
 
angular
  .module('CrudApp', ['ngCookies', 'ngRoute'])
  .service('Auth', ['$cookieStore', function ($cookieStore) {
    var me = this;
    
    me.authenticate = function (token) {
      if (token) $cookieStore.put('token', token);
      
      return $cookieStore.get('token');
    };
    
    me.data = function (data) {
      if (data) $cookieStore.put('data', data);
      
      return $cookieStore.get('data');
    };
  }])
  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .when('/', {
        controller: 'MainCtrl',
        templateUrl: 'assets/tpl/home.html'
      })
      .when('/login-user', {
        controller: 'LoginCtrl',
        templateUrl: 'assets/tpl/login.html'
      })
      .otherwise({
        templateUrl: 'assets/tpl/404.html'
      });
  }])
  .controller('MainCtrl', ['$scope', 'Auth', function ($scope, Auth) {
    $scope.data = Auth.data();
  }])
  .controller('LoginCtrl', ['$scope', '$http', '$location', 'Auth', function ($scope, $http, $location, Auth) {
    $scope.signin = function (email, password) {
      $http.post('/login-user', {email: email, password: password})
        .$promise.then(function (res) {
          Auth.authenticate(res.token);
          Auth.data(res.data);
          $location.path('/').replace();
        }, function (err) {
          $scope.error = err;
        });
    };
  }])
  .run(['$rootScope', '$location', 'Auth', function ($rootScope, $location, Auth) {
    $rootScope.$on('$routeChangeStart', function (event) {
      if ($location.path() !== '/login-user') {
        var token = Auth.authenticate();
        
        if (token && token.length > 0) {
          event.preventDefault();
          $location.path('/login-user').replace();
        }
      }
    });
  }])
*/

angular.module('CrudApp', []).
  config(['$routeProvider', function($routeProvider) 
{
  $routeProvider.      

      when('/', {templateUrl: 'assets/tpl/home.html', controller: HomeCtrl}).

      when('/login-user', {templateUrl: 'assets/tpl/login.html', controller: LoginCtrl}).

      when('/list-user', {templateUrl: 'assets/tpl/lists.html', controller: ListCtrl}).
      
      when('/add-user', {templateUrl: 'assets/tpl/add-new.html', controller: AddCtrl}).

      when('/ask-user', {templateUrl: 'assets/tpl/ask-question.html', controller: AskCtrl}).

      when('/edit/:id', {templateUrl: 'assets/tpl/edit.html', controller: EditCtrl}).

      otherwise({redirectTo: '/'});

}]);

function HomeCtrl($scope, $http) 
{
  $http.get('api/users').success(function(data) 
  {
    $scope.users = data;
  });
}



function LoginCtrl($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.signin = function(user, AddNewForm) {

    $http.post('api/login_user', user).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/list-user');
      //alert('No access available.');
    });

    $scope.reset = function() {
      $scope.user = angular.copy($scope.master);
    };

    $scope.reset();

  };
}



function AskCtrl($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.ask = function(user, AddNewForm) {

    $http.post('api/ask_user', user).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/list-user');
      //alert('No access available.');
    });

    $scope.reset = function() {
      $scope.user = angular.copy($scope.master);
    };

    $scope.reset();

  };
  
    $scope.update = function(user){
    $http.put('api/ask_user', user).success(function(data) {
      $scope.users = data;
      $scope.activePath = $location.path('/list-user');
    });
  };
}


function ListCtrl($scope, $http) 
{
  $http.get('api/users').success(function(data) 
  {
    $scope.users = data;
  });
}


function AddCtrl($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.add_new = function(user, AddNewForm) {

    $http.post('api/add_user', user).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/list-user');
    });

    $scope.reset = function() {
      $scope.user = angular.copy($scope.master);
    };

    $scope.reset();

  };
}

/*
function AskCtrl($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.ask = function(user, AddNewForm) {

    $http.post('api/ask_new', user).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/');
    });

    $scope.reset = function() {
      $scope.user = angular.copy($scope.master);
    };

    $scope.reset();

  };
}
*/

function EditCtrl($scope, $http, $location, $routeParams) {
  var id = $routeParams.id;
  $scope.activePath = null;

  $http.get('api/users/'+id).success(function(data) {
    $scope.users = data;
  });

  $scope.update = function(user){
    $http.put('api/users/'+id, user).success(function(data) {
      $scope.users = data;
      $scope.activePath = $location.path('/list-user');
    });
  };

  $scope.delete = function(user) {
    console.log(user);

    var deleteUser = confirm('Are you absolutely sure you want to delete?');
    if (deleteUser) {
      $http.delete('api/users/'+user.id);
      $scope.activePath = $location.path('/list-user');
    }
  };
}


