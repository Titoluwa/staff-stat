@extends('layouts.app')

@section('content')
<div class="">
  {{-- MARITAL --}}
    <div class="grid grid-cols-2 bg-indigo-100 m-5 p-10">
      <div><h3 class="text-blue-500 text-4xl text-center pt-10">Marital status ratio in the Company</h3></div>
      <div>
          <div id="maritaldiv" style="width: 600px; height: 400px;"></div>
      </div>
      <div>
          {{-- <table class="table-auto border-separate border border-blue-800">
              <thead class="bg-blue-100">
                  <th class="border border-blue-600 w-1/2 p-4">Status</th>
                  <th class="border border-blue-600 w-1/4 p-4">Count</th>
              </thead>
              <tbody>
                @foreach ($marital as $m)
                  <tr>
                    <td class="border border-blue-600 p-3">{{$m->MaritalStatus}}</td>
                    <td class="border border-blue-600 p-3">{{$m->count}}</td>
                  </tr>
                @endforeach
              </tbody>
              </table> --}}
          <form action="">
            <p class="text-2xl pt-10 pb-3">Check data with date range</p>
            <label class="text-blue-500 text-md" for="fromdate">From</label>
            <input class="px-2 py-1 border rounded-md border-blue-500" type="date" name="fromdate"> &nbsp;
            <label class="text-blue-500 text-md" for="todate">To</label>
            <input class="px-2 py-1 border rounded-md border-blue-500 " type="date" name="todate">
            <br><br>
            <a class="px-6 py-1 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600">Check</a>
          </form>
      </div>
    </div>
  {{-- DEPT--}}
    <div class="grid grid-cols-2">
      <div class="m-10 ">
        <div class="ml-24 pt-5">
          {{-- <table class="table-auto border-separate border border-blue-800">
            <thead class="bg-blue-100">
                <th class="border border-blue-600 w-1/2 p-4">Department</th>
                <th class="border border-blue-600 w-1/4 p-4">Count</th>
            </thead>
            <tbody>
              @foreach ($dept as $d)
                  <tr>
                    <td class="border border-blue-600 p-3">{{$d->Department}}</td>
                    <td class="border border-blue-600 p-3">{{$d->count}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table> --}}
          <form action="">
            <p class="text-2xl pt-10 pb-3">Check data with date range</p>
            <label class="text-blue-500 text-md" for="fromdate">From</label>
            <input class="px-2 py-1 border rounded-md border-blue-500" type="date" name="fromdate"> &nbsp;
            <label class="text-blue-500 text-md" for="todate">To</label>
            <input class="px-2 py-1 border rounded-md border-blue-500 " type="date" name="todate">
            <br><br>
            <a class="px-6 py-1 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600">Check</a>
          </form>
        </div>
      </div>
      <div class="ml-5">
          <h3 class="text-blue-500 text-4xl text-center pt-10">Departments in the Company</h3>
          <div id="deptdiv" style="width: 700px; height: 500px;"></div>
      </div>
    </div>
  {{-- BRANCH --}}
    <div class="grid grid-cols-2">
      <div class="ml-5">
          <h3 class="text-blue-500 text-4xl text-center pt-10">Branches in the Company</h3>
          <div id="branchdiv" style="width: 600px; height: 400px;"></div>
      </div>
      <div class="ml-5">
        <div class="ml-24 pt-5">
          {{-- <table class="table-auto border-separate border border-blue-800">
            <thead class="bg-blue-100">
                <th class="border border-blue-600 w-1/2 p-4">Branch Location</th>
                <th class="border border-blue-600 w-1/4 p-4">Count</th>
            </thead>
            <tbody>
              @foreach ($location as $l)
              <tr>
                <td class="border border-blue-600 p-3">{{$l->Location}}</td>
                <td class="border border-blue-600 p-3">{{$l->count}}</td>
              </tr>
              @endforeach
            </tbody>
          </table> --}}
          <form action="">
            <p class="text-2xl pt-10 pb-3">Check data with date range</p>
            <label class="text-blue-500 text-md" for="fromdate">From</label>
            <input class="px-2 py-1 border rounded-md border-blue-500" type="date" name="fromdate"> &nbsp;
            <label class="text-blue-500 text-md" for="todate">To</label>
            <input class="px-2 py-1 border rounded-md border-blue-500 " type="date" name="todate">
            <br><br>
            <a class="px-6 py-1 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600">Check</a>
          </form> 
        </div>
      </div> 
    </div>
  {{-- POSITION --}}
    <div class="grid grid-cols-2">
      <div class="m-10 ">
        <div class="ml-24 pt-5">
          {{-- <table class="table-auto border-separate border border-blue-800">
            <thead class="bg-blue-100">
                <th class="border border-blue-600 w-1/2 p-4">Position</th>
                <th class="border border-blue-600 w-1/4 p-4">Count</th>
            </thead>
            <tbody>
              @foreach ($position as $p)
                  <tr>
                    <td class="border border-blue-600 p-3">{{$p->Position}}</td>
                    <td class="border border-blue-600 p-3">{{$p->count}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table> --}}
          <form action="">
            <p class="text-2xl pt-10 pb-3">Check data with date range</p>
            <label class="text-blue-500 text-md" for="fromdate">From</label>
            <input class="px-2 py-1 border rounded-md border-blue-500" type="date" name="fromdate"> &nbsp;
            <label class="text-blue-500 text-md" for="todate">To</label>
            <input class="px-2 py-1 border rounded-md border-blue-500 " type="date" name="todate">
            <br><br>
            <a class="px-6 py-1 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600">Check</a>
          </form> 
        </div>
      </div>
      <div class="ml-5">
          <h3 class="text-blue-500 text-4xl text-center pt-10">Positions in the Company</h3>
          <div id="positiondiv" style="width: 700px; height: 500px;"></div>
      </div>
    </div>
  {{-- AGE --}}
    <div class="grid grid-cols-2">
      <div class="ml-5">
          <h3 class="text-blue-500 text-4xl text-center pt-10">Age Ratio in the Company</h3>
          <div id="agediv" style="width: 700px; height: 500px;"></div>
      </div>
      <div class="ml-5">
        <div class="ml-24 pt-5">
          {{-- <table class="table-auto border-separate border border-blue-800">
            <thead class="bg-blue-100">
                <th class="border border-blue-600 w-1/2 p-4">Ages</th>
                <th class="border border-blue-600 w-1/4 p-4">Count</th>
            </thead>
            <tbody>
              @foreach ($age as $a)
                  <tr>
                    <td class="border border-blue-600 p-3">{{$a->Age}}</td>
                    <td class="border border-blue-600 p-3">{{$a->count}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table> --}}
          <form action="">
            <p class="text-2xl pt-10 pb-3">Check data with date range</p>
            <label class="text-blue-500 text-md" for="fromdate">From</label>
            <input class="px-2 py-1 border rounded-md border-blue-500" type="date" name="fromdate"> &nbsp;
            <label class="text-blue-500 text-md" for="todate">To</label>
            <input class="px-2 py-1 border rounded-md border-blue-500 " type="date" name="todate">
            <br><br>
            <a class="px-6 py-1 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600">Check</a>
          </form> 

        </div>
      </div>
    </div>

</div>
@endsection

@section('scriptt')
<!-- Marital Status Chart code -->
  {{-- <script>
  am4core.ready(function() 
  {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("maritaldiv", am4charts.XYChart3D);

    // Add data
    chart.data = JSON.parse({!!json_encode($mar)!!});
    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "MaritalStatus";
    categoryAxis.numberFormatter.numberFormat = "#";
    categoryAxis.renderer.inversed = true;

    var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis()); 

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.dataFields.valueX = "count";
    series.dataFields.categoryY = "MaritalStatus";
    series.name = "count";
    series.columns.template.propertyFields.fill = "color";
    series.columns.template.tooltipText = "{valueX}";
    series.columns.template.column3D.stroke = am4core.color("#fff");
    series.columns.template.column3D.strokeOpacity = 0.2;

  });
  </script> --}}
<script>
  am4core.ready(function() 
  {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("maritaldiv", am4charts.XYChart);

    // Add data
    chart.data = JSON.parse({!!json_encode($mar)!!});

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "MaritalStatus";
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
    series.dataFields.categoryX = "MaritalStatus";
    series.name = "count";
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

  }); // end am4core.ready()
</script>

<!-- Department Chart code -->
<script>
  am4core.ready(function() 
  {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("deptdiv", am4charts.XYChart);

    // Add data
    chart.data = JSON.parse({!!json_encode($dep)!!});

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "Department";
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
    series.dataFields.categoryX = "Department";
    series.name = "count";
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

  }); // end am4core.ready()
</script>

<!-- Branch Chart code -->
<script>
 // Create chart instance
 var chart = am4core.create("branchdiv", am4charts.PieChart);
  // Create pie series
  var series = chart.series.push(new am4charts.PieSeries());
  series.dataFields.value = "count";
  series.dataFields.category = "Location";
  
  // Add data
  chart.data = JSON.parse({!!json_encode($loc)!!});

  
  // And, for a good measure, let's add a legend
  chart.legend = new am4charts.Legend();
</script>

<!-- Position Chart code -->
<script>
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
</script>

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
    chart.data = JSON.parse({!!json_encode($ag)!!});
  

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
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

  }); // end am4core.ready()
</script>

@endsection