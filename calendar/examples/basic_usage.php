<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- jQuery CDN -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Example style -->
    <link rel="stylesheet" type="text/css" href="//zabuto.com/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Zabuto Calendar -->
    <script src="../zabuto_calendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../zabuto_calendar.min.css">

</head>
<body>

<!-- container -->
<div class="container example">

   

    <div class="row">
        <div class="col-xs-5">

            <div id="my-calendar"></div>

            <script type="application/javascript">
                $(document).ready(function () {
                    $("#my-calendar").zabuto_calendar();
                });
            </script>

        </div>
        <div class="col-xs-6 col-xs-offset-1">



        </div>
    </div>

</div>
<!-- /container -->

</body>
</html>
