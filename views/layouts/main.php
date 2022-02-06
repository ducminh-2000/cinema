<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title>Azia Responsive Bootstrap 4 Dashboard Template</title>

    <!-- vendor css -->
    <link href="assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="assets/css/azia.css">

  </head>
  <body>

   <?php require 'header.php'?>

   <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Hi, welcome back!</h2>
            </div>
          </div><!-- az-dashboard-one-title -->


          <div class="row">
            <div class="col-md-12">
              <div class="card card-table-one">
                <?php echo $this->content?>
              </div><!-- card -->
            </div><!-- col-lg -->

          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->

    <?php require 'footer.php'?>

    <style>
  .table, .card-table-one .table thead tr > th:nth-child(3), .card-table-one .table thead tr > th:nth-child(4), .card-table-one .table thead tr > th:nth-child(5), .card-table-one .table thead tr > td:nth-child(3), .card-table-one .table thead tr > td:nth-child(4), .card-table-one .table thead tr > td:nth-child(5), .card-table-one .table tbody tr > th:nth-child(3), .card-table-one .table tbody tr > th:nth-child(4), .card-table-one .table tbody tr > th:nth-child(5), .card-table-one .table tbody tr > td:nth-child(3), .card-table-one .table tbody tr > td:nth-child(4), .card-table-one .table tbody tr > td:nth-child(5){
    text-align: center !important;
  }

</style>
    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/ionicons/ionicons.js"></script>
    <script src="assets/lib/chart.js/Chart.bundle.min.js"></script>
    <script src="assets/js/azia.js"></script>
    <script src="assets/js/cookie.js"></script>
  </body>
</html>
