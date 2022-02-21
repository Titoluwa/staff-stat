@extends('layouts.app')

@section('content')
<div class="">
    <h3 class="text-blue-500 text-4xl text-center m-4">Position Distribution</h3>
    <div class="grid grid-cols-3 mx-5 px-5">
      <div class="ml-5">
          <div class="m-5 p-3">  
            <form id="check_data_form" class="my-3 p-3 border rounded-lg border-blue-500">
              @csrf
              <p class="justify-center text-center m-4">
                  <a href="/position" class="justify-center text-center font-medium rounded-md shadow px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Refresh graph</a>
              </p>
              <div class="justify-center text-center m-2">
                  <p class="text-lg text-blue-500 p-2 m-2">Analyse data using date range</p>
                  <label class="text-blue-500 text-md" for="fromdate">From: </label>
                  <input class="px-2 py-1 border rounded-md border-blue-500" id="from" type="date" name="fromdate" required>
                  <br> <br>
                  <label class="text-blue-500 text-md" for="todate">To: &nbsp; &nbsp;</label>
                  <input class="px-2 py-1 border rounded-md border-blue-500" id="to" type="date" name="todate" required>
              </div>
              <button type="button" id="check" class="float-right px-6 py-1 mt-2 rounded-md shadow border border-transparent text-center font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Check</button>
              <br><br>
            </form>
            {{-- <table class="mt-5 table-auto border-separate border border-blue-800">
                <thead class="bg-blue-100 text-blue-600">
                      <th class="border border-blue-600 w-1/2 p-4">Position</th>
                      <th class="border border-blue-600 w-1/4 p-4">Count</th>
                </thead>
                <tbody id="tablebody">
                @foreach ($position as $p)
                      <tr>
                          <td class="border border-blue-600 p-3">{{$p->Position}}</td>
                          <td class="border border-blue-600 p-3">{{$p->count}}</td>
                      </tr>
                @endforeach
                </tbody>
            </table> --}}
              
          </div>
      </div>
      <div class="col-span-2 m-5">
          <div id="positiondiv" style="width: 800px; height: 700px;"></div>
      </div>
  </div>
</div>
@endsection

@section('scriptt')
    <!-- Position Chart code -->
    {{-- <script>
        am4core.ready(function() 
        {
      
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end
      
          // Create chart instance
          var chart = am4core.create("positiondiv", am4charts.XYChart);
      
          // Add data
          chart.data = JSON.parse({!!json_encode($pos)!!});
          console.log(chart.data);
      
          // Create axes
          var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
          categoryAxis.dataFields.category = "Position";
          categoryAxis.renderer.grid.template.location = 0;
          categoryAxis.renderer.minGridDistance = 30;
      
          categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
            if (target.dataItem && target.dataItem.index & 2 == 2) {
              return dy + 25;
            }
            return dy;
          });
      
          var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      
          // Create series
          var series = chart.series.push(new am4charts.ColumnSeries());
          series.dataFields.valueY = "count";
          series.dataFields.categoryX = "Position";
          series.name = "count";
          series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
          series.columns.template.fillOpacity = .8;
      
          var columnTemplate = series.columns.template;
          columnTemplate.strokeWidth = 2;
          columnTemplate.strokeOpacity = 1;
      
        }); // end am4core.ready()
    </script> --}}
<script>
    am4core.ready(function() 
    {

      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end

      // Create chart instance
      var chart = am4core.create("positiondiv", am4charts.XYChart3D);

      // Add data
      chart.data = JSON.parse({!!json_encode($pos)!!});
      // Create axes
      var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "Position";
      categoryAxis.numberFormatter.numberFormat = "#";
      categoryAxis.renderer.inversed = true;

      var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis()); 

      // Create series
      var series = chart.series.push(new am4charts.ColumnSeries3D());
      series.dataFields.valueX = "count";
    //   series.dataFields.valueY = "count";
      series.dataFields.categoryY = "Position";
      series.name = "count";
      series.columns.template.propertyFields.fill = "color";
      series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
      series.columns.template.column3D.stroke = am4core.color("#fff");
      series.columns.template.column3D.strokeOpacity = 0.2;
      
      var columnTemplate = series.columns.template;
    //   columnTemplate.strokeWidth = 2;
      columnTemplate.strokeOpacity = 2;
      columnTemplate.adapter.add("fill", function(fill, target) 
      {
          return chart.colors.getIndex(target.dataItem.index);
      })
      
      columnTemplate.adapter.add("stroke", function(stroke, target) 
      {
          return chart.colors.getIndex(target.dataItem.index);
      })

    });
</script>

<script>
    $('#check').click(function(event) {
        $.post('/check_position', $('#check_data_form').serialize(), function(data) { 
        $("#tablebody").html('');
        $.each(data.position, function(index, val) {
            $('#tablebody').append(`
                <tr>
                    <td class="border border-blue-600 p-3">${val.Position}</td>
                    <td class="border border-blue-600 p-3">${val.count}</td>
                </tr>
            `);
        });
        position_ajax(data.pos);
        }); 
    });

  function position_ajax(data)
  {
    am4core.ready(function() 
    {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("positiondiv", am4charts.XYChart3D);

    // Add data
    chart.data = JSON.parse(data);

    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "Position";
    categoryAxis.numberFormatter.numberFormat = "#";
    categoryAxis.renderer.inversed = true;

    var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis()); 

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.dataFields.valueX = "count";
    series.dataFields.categoryY = "Position";
    series.name = "count";
    series.columns.template.propertyFields.fill = "color";
    series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
    series.columns.template.column3D.stroke = am4core.color("#fff");
    series.columns.template.column3D.strokeOpacity = 0.2;

    var columnTemplate = series.columns.template;
    columnTemplate.strokeOpacity = 1;
    columnTemplate.stroke = am4core.color("#FFFFFF");
    
    columnTemplate.adapter.add("fill", function(fill, target) 
    {
        return chart.colors.getIndex(target.dataItem.index);
    })
    
    columnTemplate.adapter.add("stroke", function(stroke, target) 
    {
        return chart.colors.getIndex(target.dataItem.index);
    })

    });
  }
</script>
@endsection