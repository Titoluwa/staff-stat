@extends('layouts.app')

@section('content')
<div class="">
    <h3 class="text-blue-500 text-4xl text-center m-4">Gender Distribution</h3>
    <div class="grid grid-cols-3 mx-5 px-5">
      <div class="ml-5">
          <div class="m-5 p-3">
                <form id="check_data_form" class="my-3 p-3 border rounded-lg border-blue-500">
                    @csrf
                    <p class="justify-center text-center m-4">
                        <a href="/gender" class="justify-center text-center font-medium rounded-md shadow px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-indigo-100 hover:bg-white">Reload for original graph</a>
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
                        <th class="border border-blue-600 w-1/2 p-4">Gender</th>
                        <th class="border border-blue-600 w-1/4 p-4">Count</th>
                    </thead>
                    <tbody id="tablebody">
                    @foreach ($gender as $g)
                        <tr>
                        <td class="border border-blue-600 p-3">{{$g->Gender}}</td>
                        <td class="border border-blue-600 p-3">{{$g->count}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> --}}
          </div>
      </div>
      <div class="col-span-2 m-5">
          <div id="genderdiv" style="width: 800px; height: 500px;"></div>
    </div>
    </div>
</div>
@endsection

@section('scriptt')
    <!-- Gender Chart code -->
    <script>
        // Create chart instance
        var chart = am4core.create("genderdiv", am4charts.PieChart);
        // Create pie series
        var series = chart.series.push(new am4charts.PieSeries());
        series.dataFields.value = "count";
        series.dataFields.category = "Gender";
        
        // Add data
        chart.data = JSON.parse({!!json_encode($gen)!!});
       
        // And, for a good measure, let's add a legend
        chart.legend = new am4charts.Legend();
    </script>
    <script>
        $('#check').click(function(event) {
            $.post('/check_gender', $('#check_data_form').serialize(), function(data) { 
                $("#tablebody").html('');
                $.each(data.gender, function(index, val) {
                    $('#tablebody').append(`
                        <tr>
                            <td class="border border-blue-600 p-3">${val.Gender}</td>
                            <td class="border border-blue-600 p-3">${val.count}</td>
                        </tr>
                    `);
                });
                gender_ajax(data.gen);
            }); 
        });

        function gender_ajax(data)
        {
            // Create chart instance
            var chart = am4core.create("genderdiv", am4charts.PieChart);

            // Create pie series
            var series = chart.series.push(new am4charts.PieSeries());
            series.dataFields.value = "count";
            series.dataFields.category = "Gender";
            
            // Add data
            chart.data = JSON.parse(data);

            // And, for a good measure, let's add a legend
            chart.legend = new am4charts.Legend();
        }
    </script>
@endsection