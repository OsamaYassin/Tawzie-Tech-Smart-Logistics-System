<!DOCTYPE html>
<html>
<head>

    <meta itemprop="name" content="DC.js + Leaflet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta itemprop="description" content="DC.js + Leaflet chart" />

    <meta charset="UTF-8">
  <title> Reports  </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets/report/static/lib/css//bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/report/static/lib/css/keen-dashboards.css')}}">
  <link rel="stylesheet" href="{{asset('assets/report/static/lib/css/dc.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

    <link rel="stylesheet" href="{{asset('assets/report/static/lib/css/leaflet.css')}}">
  <link rel="stylesheet" href="{{asset('assets/report/static/css/custom.css')}}">






</head>
<body class="application">

  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"> Interactive   Reports</a>
      </div>
      <div  style="display: none;" class="navbar-header">
        <h3  id="number-records-nd"> </h3>
      </div>
    </div>
  </div>

  <div class="container-fluid">

    <div class="row">

      <div class="col-md-3">
         <!-- Brand -->

            <div class="chart-wrapper">
              <div class="chart-title">
                SHOW Area
              </div>
              <div class="chart-stage">
                <div id="belediye-brand-row-chart"></div>
              </div>
            </div>

             <!-- Number of events -->

              <div class="chart-wrapper">
                <div class="chart-title" style="font-size: 22px;">
                    للبن البدرة
                 </div>
                <div class="chart-stage">
                  <div id="SPRITE-segment-row-chart"></div>
                </div>
              </div>

            <!-- Number of events -->

          <!-- Brand -->
      </div>

      <div class="col-md-4">
        <div class="col-md-12">
          <div class="chart-wrapper">
            <div class="chart-title" style="font-size: 22px;">
                    ارز
             </div>
              <div class="chart-stage">
                <div id="coca-segment-row-chart"></div>
              </div>
            </div>
      </div>

      <div class="col-md-12">
        <div class="chart-wrapper">
            <div class="chart-title" style="font-size: 22px;">
                عدس
               </div>
            <div class="chart-stage">
              <div id="coca-No-segment-row-chart"></div>
            </div>
          </div>
    </div>
      </div>


      <div class="col-md-5">
          <div class="chart-wrapper">
              <div class="chart-title">
                Map
              </div>
              <div class="chart-stage">
                <div id="map" style="width: 500px; height: 448px"></div>
              </div>
            </div>
        </div>







    </div>

  </div>

  <hr>

  <div class="itemf" style="display: flex;">
      <p class="small text-muted">Built with &#9829; by Osama Yassin  </p>
      <div style="margin: auto;">
          <span> <i class="fa fa-circle" style="font-size:18px; color: #4c92c3; margin-right: 15px;"> First</i></span>
          <span> <i class="fa fa-circle" style="font-size:18px; color: #ff993e;    margin-right: 15px;"> Second</i></span>
          <span> <i class="fa fa-circle" style="font-size:18px; color: #56b356;    margin-right: 15px;"> Third</i></span>
          <span> <i class="fa fa-circle" style="font-size:18px; color: #de5253;    margin-right: 15px;"> Fourth</i></span>
      </div>
  </div>


  <script src="{{asset('assets/report/static/lib/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/underscore-min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/crossfilter.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/d3.min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/d3.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/dc.min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/queue.js')}}"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <script src="{{asset('assets/report/static/lib/js/leaflet.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/leaflet-heat.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/keen.min.js')}}"></script>
  <script src='{{asset('assets/report/static/js/dataset.js')}}' charset="utf-8" type='text/javascript'></script>
  <script src='{{asset('assets/report/static/js/graphs.js')}}' charset="utf-8" type='text/javascript'></script>


</body>
</html>
