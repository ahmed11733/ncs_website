@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
          id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}"
          id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

@endsection
@section('content')

    <!-- start page title -->
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18" id="in-branch-text">{{$inBranch==true?__('admin.admin-is-in-branch'):__('admin.admin-is-not-in-branch')}} </h4>
                <br>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('admin.admin')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="crypto-buy-sell-nav">

                        <div class="row">
                            <h4 class="mb-sm-0 font-size-18" >({{$user->name}})</h4>

                            <div class="col-lg-12">
                                <div class="form-group">

                                    <div id="map" style="padding: 15%"></div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- end row -->
@endsection

@section('extra-js')
    <script src="{{asset('admin_assets/libs/select2/js/select2.min.js')}}"></script>
    <!-- bootstrap-datepicker js -->
    <script src="{{asset('admin_assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- init js -->

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhnmMC23noePz6DA8iEvO9_yNDGGlEaeM&callback=initAutocomplete&v=weekly&libraries=places"
        async
    ></script>

    <script>
        let directionsService;
        let directionsRenderer;
        let previousLocation = null;
        let markers = [];
        let polylines = [];

        function initAutocomplete() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: {{$user->latitude??($user->company?$user->company->latitude:$user->branch->latitude)}}, lng: {{$user->longitude??($user->company?$user->company->longitude:$user->branch->longitude)}} },
                zoom: 15,
                mapTypeId: "roadmap",
            });
            // Create the search box and link it to the UI element.
            // const input = document.getElementById("pac-input");
            // const searchBox = new google.maps.places.SearchBox(input);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{$user->latitude??($user->company?$user->company->latitude:$user->branch->latitude)}}, {{$user->longitude??($user->company?$user->company->longitude:$user->branch->longitude)}}),
                map: map,
            });
            marker2 = new google.maps.Marker({
                position: new google.maps.LatLng({{$user->company?$user->company->latitude:$user->branch->latitude}}, {{$user->company?$user->company->longitude:$user->branch->longitude}}),
                map: map,
                icon: {
                    url: 'https://aenshehana.my-staff.net/admin_assets/images/logo.png', // Use a predefined Google Maps icon
                    scaledSize: new google.maps.Size(32, 32) // Optional: Adjust the size of the icon
                }
            });
            const infoWindow = new google.maps.InfoWindow({
                content: `<p>{{__('admin.branch')}} : {{$user->company?$user->company->name:$user->branch->name}}</p>`
            });

            // Add a click listener to the marker to open the info window
            marker2.addListener('click', () => {
                infoWindow.open(map, marker2);
            });


            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                polylineOptions: {
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                }
            });


            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            // map.addListener("bounds_changed", () => {
            //     searchBox.setBounds(map.getBounds());
            // });
            Pusher.logToConsole = true;

            var pusher = new Pusher('b54d46237cfd4c82470e', {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('user-location-'+{{$user->id}});
            channel.bind('App\\Events\\LocationUpdated', function (data) {
                var latLng = new google.maps.LatLng(data.latitude, data.longitude);

                // Create marker for the new location
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: 'New Location'
                });
                markers.push(marker);

                // Draw polyline if there are previous markers
                if (markers.length > 1) {
                    var path = [];
                    markers.forEach(function(marker) {
                        path.push(marker.getPosition());
                    });

                    // Remove previous polylines
                    // polylines.forEach(function(polyline) {
                    //     polyline.setMap(null);
                    // });
                    //
                    // Create new polyline
                    var polyline = new google.maps.Polyline({
                        path: path,
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });
                    console.log(polyline);
                    polyline.setMap(map);
                    polylines.push(polyline);
                }

                // Center map on the latest marker
                map.setCenter(latLng);
                if(data.inBranch==true){
                    $('#in-branch-text').text('{{__("admin.admin-is-in-branch")}}');
                }
                else{
                    $('#in-branch-text').text('{{__("admin.admin-is-not-in-branch")}}');

                }


            });
        }

        window.initAutocomplete = initAutocomplete;
        //setup before functions

    </script>


@endsection
