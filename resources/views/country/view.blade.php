
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{ $country->officialName}} </a>
        </div>
    </nav>


    <div class="container">
        <div class="row justify-content-center mt-3">
       
        <div class="col-sm-6">
            <h2> Country details </h2>
            <table class="table table-bordered mt-3">
               
               <tbody>
                
                   <tr>
                       <td><b>Common name</b></td>
                       <td>{{ $country->commonName }}</td>
                   </tr>
                   <tr>
                       <td><b>Official name</b></td>
                       <td>{{ $country->officialName }}</td>
                   </tr>
                   <tr>
                       <td><b>Capital</b></td>
                       <td>{{ $country->capital }}</td>
                   </tr>
                   <tr>
                       <td><b>Population</b></td>
                       <td>{{ $country->population }}</td>
                   </tr>
                   <tr>
                       <td><b>Timezone</b></td>
                       <td>{{ $country->timezone }}</td>
                   </tr>
                   <tr>
                       <td><b>Flag</b></td>
                       <td><img src='{{$country->flagUrl}}' width="100px"></td>
                   </tr>
 
                   </tr>
               </tbody>
           </table>

        </div>
        <div class="col-sm-6">
            <h2>Euro foreign exchange reference rates</h2>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Rate</th>
                    </tr>
                </thead>
                <tbody>
                   

                    @foreach($rates as $rate)
                    <tr>
                        <td>{{ $rate->date }}</td>
                        <td>{{ $rate->rateDecimal() }} {{ $rate->currency }}</td>
                    </tr>
                    @endforeach

                   
                </tbody>
            </table>

            @if (count($rates) == 0)
                         No data available 
            @else
            @endif
           
        </div>
        
       
        </div>
        <a href="{{ route('countries') }}" class="btn btn-primary">Back</a>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>