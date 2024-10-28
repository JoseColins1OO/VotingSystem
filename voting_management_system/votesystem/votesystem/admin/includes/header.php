<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Sistema de Votación en Línea</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- iCheck para checkboxes y radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Tema AdminLTE -->
  	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  	<!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Date range picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  	<!-- Font de Google -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  	<style type="text/css">
      /* Estilos personalizados */
      .bold {
        font-weight: bold;
        color: #006341;
      }

      body {
        font-family: 'Source Sans Pro', sans-serif;
      }
      
      #candidate_list {
        margin-top: 20px;
      }

      #candidate_list ul {
        list-style-type: none;
        padding: 0;
      }

      #candidate_list ul li { 
        margin: 0 30px 30px 0;
        vertical-align: top;
        font-size: 18px;
        color: #006341;
      }

      .clist {
        margin-left: 20px;
      }

      .cname {
        font-size: 25px;
        color: #006341;
        font-weight: bold;
      }

      .content-header h1 {
        color: #006341;
        font-weight: bold;
      }

      .breadcrumb {
        background-color: #f3f2ed;
        font-size: 16px;
        font-weight: bold;
        color: #333333;
      }

      .breadcrumb a {
        color: #006341;
      }

      /* Estilos para botones */
      .btn-primary {
        background-color: #006341;
        color: white;
        border: none;
      }

      .btn-primary:hover {
        background-color: #004f2e;
      }

      .table {
        color: #333;
        font-size: 15px;
      }

      /* Estilos de tabla */
      thead {
        background-color: #006341;
        color: white;
      }
  	</style>
</head>
<body>
