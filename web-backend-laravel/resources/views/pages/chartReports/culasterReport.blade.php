<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <title>Reports</title>

  <meta itemprop="name" content="Reports" />

  <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link type="text/css" href="{{asset('assets/report/lib/leaflet.css')}}" rel="stylesheet" />
  <link type="text/css" href="{{asset('assets/report/lib/leaflet.markercluster.css')}}" rel="stylesheet" />
  <link type="text/css" href="{{asset('assets/report/lib/dc.css')}}" rel="stylesheet" />
  <!---  end neat map -->
    <link rel="stylesheet" href="{{asset('assets/report/static/lib/css//bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/report/static/lib/css/keen-dashboards.css')}}">
    <link rel="stylesheet" href="{{asset('assets/report/static/css/custom.css')}}">


</head>

<body class="application">


  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"> Interactive Reports</a>
      </div>
      <div style="display: none;" class="navbar-header">
        <h3 id="number-records-nd"> </h3>
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
            <div id="pie" class="pie"></div>
          </div>
        </div>

        <!-- Number of events -->

        <div class="chart-wrapper">
          <div class="chart-title" style="font-size: 22px;">
             للبن البدرة
          </div>
          <div class="chart-stage">
            <div id="row-chart-sprite" class="row-chart-sprite"> </div>
          </div>
        </div>

        <!-- Number of events -->

        <!-- Brand -->
      </div>

      <div class="col-md-4">
        <div class="col-md-12">
          <div class="chart-wrapper">
            <div class="chart-title" style="font-size: 22px;" >
             ارز
            </div>
            <div class="chart-stage">
              <div id="barChar" class="barChar"></div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="chart-wrapper">
            <div class="chart-title" style="font-size: 22px;">
             عدس
            </div>
            <div class="chart-stage">
              <div id="chart" class="chart"></div>
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
            <div id="map" class="map" style="width: 500px; height: 448px"></div>
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




  <script type="text/javascript" src="{{asset('assets/report/lib/d3.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/report/lib/crossfilter.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/report/lib/dc.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/report/lib/leaflet.js')}}"></script>

  <script src="{{asset('assets/report/static/lib/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/underscore-min.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/queue.js')}}"></script>
  <script src="{{asset('assets/report/static/lib/js/keen.min.js')}}"></script>


  <!--Optional-->
  <script type="text/javascript" src="{{asset('assets/report/lib/leaflet.markercluster.js')}}"></script>

  <script type="text/javascript" src="{{asset('assets/report/dc.leaflet.js')}}"></script>
  <script src='{{asset('assets/report/static/js/dataset.js')}}' charset="utf-8" type='text/javascript'></script>


  <script type="text/javascript">

    /*     Markers      */

    var data = alldata;

    data.forEach(function (d) {

      d.Longitude = +d.Longitude;
      d.Latitude = +d.Latitude;
      d.COCA = +d.COCA;
      d.COCA_NOS = +d.COCA_NOS;
    });


    drawMarkerSelect(data);


    function drawMarkerSelect(data) {
      var xf = crossfilter(data);
      var groupname = "marker-select";
      var facilities = xf.dimension(function (d) { return d.Latitude + ',' + d.Longitude; });
      var facilitiesGroup = facilities.group().reduceCount();

      var typeDimension = xf.dimension(function (d) { return d.Type; });
      var groupDimention = typeDimension.group().reduceCount();

      dc.leafletMarkerChart(".map", groupname)
        .dimension(facilities)
        .group(facilitiesGroup)
        .width(300)
        .height(300)
        .center([15.5968644, 32.5222254])
        .zoom(9)
        .cluster(true);




      var total = xf.groupAll().reduceCount().value();


      var AreaDimension = xf.dimension(function (d) { return d.area; });
      var groupDimentionArea = AreaDimension.group().reduceCount();


      dc.pieChart(".pie", groupname)
        .dimension(AreaDimension)
        .group(groupDimentionArea)
        .width(200)
        .height(200)
        //.label(function (d) { return Math.round((d.value / total) * 100, 0) + '%'; })
        .legend(dc.legend().x(120).y(5).itemHeight(12).gap(5))
        .renderLabel(true)
          .colors(d3.scale.category10())
        .renderTitle(true)
        .ordering(function (p) {
          return -p.value;
        });


      var COCANoSugerDimension = xf.dimension(function (d) { return d.area; });
      var groupDimentionCocaNoSuger = COCANoSugerDimension.group().reduceSum(function (d) { return d.COCA_NOS; })

      dc.rowChart("#chart", groupname)
        .width(350)
        .height(200)
        .dimension(COCANoSugerDimension)
        .group(groupDimentionCocaNoSuger)
        .elasticX(true)
          .colors(d3.scale.category10())
        .label(function (d) { return d.key + "  " + d.value; })
        .ordering(function (d) { return -d.value })
        .xAxis().tickFormat(function (v) { return v }).ticks(3);



      var SPRITEDimension = xf.dimension(function (d) { return d.area; });
      var groupDimentionSPRITE = SPRITEDimension.group().reduceSum(function (d) { return d.SPRITE; })

      dc.rowChart("#row-chart-sprite", groupname)
        .width(350)
        .height(200)
        .dimension(SPRITEDimension)
        .group(groupDimentionSPRITE)
        .elasticX(true)
          .colors(d3.scale.category10())
        .label(function (d) { return d.key + "  " + d.value; })
        .ordering(function (d) { return -d.value })
        .xAxis().tickFormat(function (v) { return v }).ticks(3);


      var COCADimension = xf.dimension(function (d) { return d.area; });
      var groupDimentionCoca = COCADimension.group().reduceSum(function (d) { return d.COCA; })

      dc.rowChart("#barChar", groupname)
        .width(350)
        .height(200)
        .dimension(COCADimension)
        .group(groupDimentionCoca)
        .elasticX(true)
          .colors(d3.scale.category10())
        .label(function (d) { return d.key + "  " + d.value; })
        .ordering(function (d) { return -d.value })
        .xAxis().tickFormat(function (v) { return v }).ticks(3);



      dc.renderAll(groupname);


    }




  </script>


  <script>!function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (!d.getElementById(id)) { js = d.createElement(s); js.id = id; js.src = "//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs); } }(document, "script", "twitter-wjs");</script>

  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-2905006-14']);
    _gaq.push(['_trackPageview']);

    (function () {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>
</body>

</html>

<!--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  -->
