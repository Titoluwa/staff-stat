@extends('layouts.app')

@section('content')
<div class="">
  <h3 class="text-blue-500 text-4xl text-center m-4">Age Distribution in Years</h3>
  <div class="grid grid-cols-3 mx-5 px-5">
      <div class="ml-5">
          <div class="m-5 p-3">
              <form id="check_data_form" class="my-3 p-3 border rounded-lg border-blue-500">
                @csrf
                <p class="justify-center text-center m-4">
                    <a href="/age" class="justify-center text-center font-medium rounded-md shadow px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Refresh graph</a>
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
              {{-- <table class="table-auto border-separate border border-blue-800">
                  <thead class="bg-blue-100 text-blue-600">
                      <th class="border border-blue-600 w-1/2 p-4">Age</th>
                      <th class="border border-blue-600 w-1/4 p-4">Count</th>
                  </thead>
                  <tbody id="tablebody">
                    @foreach ($ageranges as $a)
                    <tr>
                      <td class="border border-blue-600 p-3">{{$a->Age}}</td>
                      <td class="border border-blue-600 p-3">{{$a->count}}</td>
                    </tr>
                @endforeach
                  </tbody>
              </table> --}}
          </div>
      </div>
      <div class="col-span-2 m-5">
          <div id="agerangediv" style="width: 800px; height: 500px;"></div>
      </div>
      <div class="m-3">

      </div>
      <div class="col-span-2 m-5">
        <div id="agediv" style="width: 800px; height: 500px;"></div>
    </div>
  </div>
</div>
@endsection

@section('scriptt')
    <!-- AGE Chart code -->
<script>
    am4core.ready(function() 
    {
  
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end
  
      // Create chart instance
      var chart = am4core.create("agediv", am4charts.XYChart);
  
      // Add data
      chart.data = JSON.parse({!!json_encode($ages)!!});
    
  
      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "Age";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.title.text = "Age";
      categoryAxis.title.fontWeight = "bold";
  
      categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
        if (target.dataItem && target.dataItem.index & 2 == 2) {
          return dy + 25;
        }
        return dy;
      });

      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.title.text = "Count";
      valueAxis.title.fontWeight = "bold";
  
      // Create series
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = "count";
      series.dataFields.categoryX = "Age";
      series.name = "count";
      series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
      series.columns.template.fillOpacity = .9;
  
      var columnTemplate = series.columns.template;
      columnTemplate.strokeWidth = 2;
      columnTemplate.strokeOpacity = 1;

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

    am4core.ready(function() 
    {
  
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end
  
      // Create chart instance
      var chart = am4core.create("agerangediv", am4charts.XYChart);
  
      // Add data
      chart.data = JSON.parse({!!json_encode($agerange)!!});
      console.log(chart.data);
  
      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "AgeRange";
      categoryAxis.title.text = "Age Range (Intervals)";
      categoryAxis.title.fontWeight = "bold";

      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.title.text = "Count";
      valueAxis.title.fontWeight = "bold";

      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = "sum" ;
      series.dataFields.categoryX = "AgeRange";
      series.name = "sum";
      series.columns.template.tooltipText = "{AgeRange}: [bold]{sum}[/]";
      series.columns.template.fillOpacity = .8;
  
      var columnTemplate = series.columns.template;
      columnTemplate.strokeWidth = 2;
      columnTemplate.strokeOpacity = 1;
      
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
    $.post('/check_age', $('#check_data_form').serialize(), function(data) { 
      $("#tablebody").html('');
      $.each(data.age, function(index, val) {
        $('#tablebody').append(`
            <tr>
                <td class="border border-blue-600 p-3">${val.Age}</td>
                <td class="border border-blue-600 p-3">${val.count}</td>
            </tr>
        `);
      });
      age_ajax(data.ag);
      agerange_ajax(data.agerange)
    }); 
  });

  function age_ajax(data)
  {
    am4core.ready(function() 
    {
  
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end
  
      // Create chart instance
      var chart = am4core.create("agediv", am4charts.XYChart);
  
      // Add data
      chart.data = JSON.parse(data)
  
      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "Age";
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
      series.dataFields.categoryX = "Age";
      series.name = "count";
      series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
      series.columns.template.fillOpacity = .9;
  
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
  
    }); // end am4core.ready()
  }
  function agerange_ajax(data)
  {
    am4core.ready(function() 
    {
  
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end
  
      // Create chart instance
      var chart = am4core.create("agerangediv", am4charts.XYChart);
  
      // Add data
      chart.data = JSON.parse(data)
  
      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "AgeRange";
      categoryAxis.title.text = "Age Range (Intervals)";
      categoryAxis.title.fontWeight = "bold";

      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.title.text = "Count";
      valueAxis.title.fontWeight = "bold";

      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = "sum" ;
      series.dataFields.categoryX = "AgeRange";
      series.name = "sum";
      series.columns.template.tooltipText = "{AgeRange}: [bold]{sum}[/]";
      series.columns.template.fillOpacity = .8;
  
      var columnTemplate = series.columns.template;
      columnTemplate.strokeWidth = 2;
      columnTemplate.strokeOpacity = 1;
      
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