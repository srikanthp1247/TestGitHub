<!DOCTYPE html>
<html lang="en" ng-app="CrudApp">
  <head>
	  <meta charset='utf-8'>
          <title>TQA User Authentication</title>
          <!-- Bootstrap -->
          <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/custom.css" rel="stylesheet">
              <link href="css/toaster.css" rel="stylesheet">
                <style>
                  a {
                  color: red;
                  }
                </style>

 </head>
  <body ng-cloak="">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header col-md-8">
            <button type="button" class="navbar-toggle" toggle="collapse" target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="bg-primary" rel="home" title="TQA Authentication App">Technical Query Analyzer, For those who code</a>
				
          </div>
		   <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
        </div>
		
      </div>
    </div>
    <div >
      <div class="container" style="margin-top:20px;">

        <div data-ng-view="" id="ng-view" class="slide-animation"></div>

      </div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
	<script type="text/javascript" src ="assets/js/app.js"></script>
    </body>
</html>




