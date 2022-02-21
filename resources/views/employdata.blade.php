@extends('layouts.app')

@section('content')
<div class="">
    <h3 class="text-blue-500 text-4xl text-center m-4">Employment Date Distribution</h3>
    <div class="grid grid-cols-3 mx-5 px-5">
      <div class="ml-5">
          <div class="m-5 p-3">

                <form id="check_data_form" class="my-3 p-3 border rounded-lg border-blue-500">
                    @csrf
                    <p class="justify-center text-center m-4">
                        <a href="/employment_date" class="justify-center text-center font-medium rounded-md shadow px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Reload for original graph</a>
                    </p>
                    <p class="text-xl p-2 pb-3 text-center">Analyse data per year</p>
                    <div class="justify-center text-center m-2">
                        <label class="text-blue-500 text-md p-2" for="year">Year: </label>
                        <select onchange="emp_year()" id='year' class="px-2 py-1 border rounded-md border-blue-500" name="year">
                                <option value="" disabled selected>Select Year</option>
                            @foreach ($emp_year as $e)
                                <option value="{{$e->EmploymentYear}}" {{ $e->EmploymentYear == 'Unregistered' ? 'disabled': '' }} >{{$e->EmploymentYear}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <h2 id="year_title" class="font-semibold text-blue-600 text-2xl text-center"></h2>
                {{-- <table class="mt-3 table-auto border-separate border border-blue-800">
                    <thead class="bg-blue-100 text-blue-600">
                        <th id="emp_date" class="border border-blue-600 w-1/2 p-4">Employment Year</th>
                        <th class="border border-blue-600 w-1/4 p-4">Count</th>
                    </thead>
                    <tbody id="tablebody">
                    @foreach ($emp_year as $e)
                        <tr>
                            <td class="border border-blue-600 p-3">{{$e->EmploymentYear}}</td>
                            <td class="border border-blue-600 p-3">{{$e->count}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> --}}
          </div>
      </div>
      <div class="col-span-2 m-5">
          <div id="employdiv" style="width: 800px; height: 500px;"></div>
    </div>
    </div>
</div>
@endsection

@section('scriptt')
    <!-- Employment Year Chart code -->
    <script>
        am4core.ready(function() 
        {
            am4core.useTheme(am4themes_animated);
       
            // Create chart instance
            var chart = am4core.create("employdiv", am4charts.XYChart3D);
            
            // Add data
            chart.data = JSON.parse({!!json_encode($emp)!!});
            
            // Create axes
            let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "EmploymentYear";
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
            series.dataFields.categoryX = "EmploymentYear";
            series.name = "Year";
            series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
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
    </script>
    <script>
        function emp_year()
        {
            var year = $('#year').val();
            $.get('/check_year/'+year, function(data) 
            {
                $("#year_title").html('');
                $("#tablebody").html('');
                $("#emp_date").html('');
                $("#year_title").html(year);
                $("#emp_date").html('Employment Date');
                $.each(data.emp_date, function(index, val) {
                    $('#tablebody').append(`
                        <tr>
                            <td class="border border-blue-600 p-3">${val.EmploymentDate}</td>
                            <td class="border border-blue-600 p-3">${val.count}</td>
                        </tr>
                    `);
                });
                emp_dates(data.emp);
            });
        }
        function emp_dates(data)
        {
            am4core.ready(function() 
            {
                am4core.useTheme(am4themes_animated);
        
                // Create chart instance
                var chart = am4core.create("employdiv", am4charts.XYChart3D);
                
                // Add data
                chart.data = JSON.parse(data);
                
                // Create axes
                let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "EmploymentDate";
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
                series.dataFields.categoryX = "EmploymentDate";
                series.name = "Dates";
                series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
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
                
            });
        }
    </script>
@endsection