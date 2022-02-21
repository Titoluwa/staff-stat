@extends('layouts.app')

@section('content')
<div class="">
    <h3 class="text-blue-500 text-4xl text-center m-4">Salary Distribution</h3>
    <div class="grid grid-cols-3 mx-5 px-5">
      <div class="ml-5">
          <div class="m-5 p-3">
                <form id="check_data_form" class="my-3 p-3 border rounded-lg border-blue-500">
                    @csrf
                    <p class="justify-center text-center m-4">
                        <a href="/salary" class="justify-center text-center font-medium rounded-md shadow px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Refresh graph</a>
                    </p>
                    {{-- <div class="justify-center text-center m-2">
                        <p class="text-lg text-blue-500 p-2 m-2">Analyse data using date range</p>
                        <label class="text-blue-500 text-md" for="fromdate">From: </label>
                        <input class="px-2 py-1 border rounded-md border-blue-500" id="from" type="date" name="fromdate" required>
                        <br> <br>
                        <label class="text-blue-500 text-md" for="todate">To: &nbsp; &nbsp;</label>
                        <input class="px-2 py-1 border rounded-md border-blue-500" id="to" type="date" name="todate" required>
                    </div>
                    <button type="button" id="check" class="float-right px-6 py-1 mt-2 rounded-md shadow border border-transparent text-center font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Check</button>
                    <br><br> --}}
                </form>

                {{-- <table class="mt-3 table-auto border-separate border border-blue-800">
                    <thead class="bg-blue-100 text-blue-600">
                        <th class="border border-blue-600 w-1/3 p-4">Salary Group</th>
                        <th class="border border-blue-600 w-1/2 p-4">Amount (annually)</th>
                        <th class="border border-blue-600 w-1/4 p-4">Count</th>
                    </thead>
                    <tbody id="tablebody">
                    @foreach ($s_group as $s)
                        <tr>
                            <td class="border border-blue-600 p-3">{{$s->PayrollGroup}}</td>
                            <td class="border border-blue-600 p-3">{{$s->pay}}</td>
                            <td class="border border-blue-600 p-3">{{$s->count}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> --}}
          </div>
      </div>
      <div class="col-span-2 m-5">
          <div id="salarydiv" style="width: 800px; height: 500px;"></div>
    </div>
    </div>
</div>
@endsection

@section('scriptt')
    <!-- Salary Year Chart code -->
    <script>
        am4core.ready(function() 
        {
            am4core.useTheme(am4themes_animated);
       
            // Create chart instance
            var chart = am4core.create("salarydiv", am4charts.XYChart3D);
            
            // Add data
            chart.data = JSON.parse({!!json_encode($sal)!!});
            
            // Create axes
            let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "PayrollGroup";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.renderer.labels.template.hideOversized = false;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.tooltip.label.rotation = 270;
            categoryAxis.tooltip.label.horizontalCenter = "right";
            categoryAxis.tooltip.label.verticalCenter = "middle";
            
            let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = "Count";
            valueAxis.title.fontWeight = "bold";
            
            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueY = "count";
            series.dataFields.categoryX = "PayrollGroup";
            series.name = "Number";
            series.tooltipText = "{pay}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;
            
            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
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
            
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineY.strokeOpacity = 0;
            
        }); // end am4core.ready()
    // am4core.ready(function() 
    // {
  
    //   // Themes begin
    //   am4core.useTheme(am4themes_animated);
    //   // Themes end
  
    //   // Create chart instance
    //   var chart = am4core.create("salarydiv", am4charts.XYChart);
  
    //   // Add data
    //   chart.data = JSON.parse({!!json_encode($sal)!!});
  
    //   // Create axes
    //   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    //   categoryAxis.dataFields.category = "PayrollGroup";
    //   categoryAxis.renderer.grid.template.location = 0;
    //   categoryAxis.renderer.minGridDistance = 30;
  
    //   categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
    //     if (target.dataItem && target.dataItem.index & 2 == 2) {
    //       return dy + 25;
    //     }
    //     return dy;
    //   });
  
    //   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  
    //   // Create series
    //   var series = chart.series.push(new am4charts.ColumnSeries());
    //   series.dataFields.valueY = "count";
    //   series.dataFields.categoryX = "PayrollGroup";
    //   series.name = "count";
    //   series.columns.template.tooltipText = "{pay}: [bold]{valueY}[/]";
    //   series.columns.template.fillOpacity = .8;
  
    //   var columnTemplate = series.columns.template;
    //   columnTemplate.strokeWidth = 2;
    //   columnTemplate.strokeOpacity = 1;
  
    // })
    </script>
@endsection