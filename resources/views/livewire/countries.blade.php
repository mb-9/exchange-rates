


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
                        <th>Name</th>
                        <th>Flag</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                    <tr>
                        <td>{{ $country->id }}</td>
                        <td><a href="{{ route('country', $country->id) }}">{{ $country->commonName }}</a></td>
                        <td><img src='{{$country->flagUrl}}' width="40px"></td>
                        <td><a href="{{ route('country', $country->id) }}" class="btn btn-primary">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

