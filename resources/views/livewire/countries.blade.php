<div>
  
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  

  
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
               
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
            <tr>
                <td>{{ $country->commonName }}</td>
                <td>{{ $country->commonName }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>