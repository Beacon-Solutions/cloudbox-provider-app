<div class="row">
    <div class="col-sm-12 placeholder">
        <div class="panel panel-info">
            <div class="panel-heading">General Information</div>
            <div class="panel-body">
                <div class="list-group">
                    @if (isset($general_info))
                            <div class="list-group-item">
                                <h4 class="list-group-item-heading">{{ $general_info["1"] }} CloudBox Clients</h4>
                                 </div>
                            <div class="list-group-item">
                                <h4 class="list-group-item-heading">{{ $general_info["2"] }} Apps Running</h4>
                                </div>
                            <div class="list-group-item">
                                <h4 class="list-group-item-heading">{{ $general_info["3"] }} Users in CloudBox</h4>
                                <p class="list-group-item-text"></p>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 placeholder">
        <div class="panel panel-danger">
            <div class="panel-heading">Risky Clients</div>
            <div class="panel-body">
                <div class="list-group">
                    @if (isset($danger_info))
                        @foreach ($danger_info["space_risk"] as $clients)
                            @foreach ($clients as $client)
                                <div class="list-group-item">
                                    <h4 class="list-group-item-heading">{{ $client->client_name }} is running out of Storage</h4>
                                    <p class="list-group-item-text">{{ $client-> space_usage_percentage}} % Used</p>
                                    <button data-key="{{$client->client_id}}" href="/dashboard/clients/{{$client->client_id}}" class="btn btn-primary app-action-btn client_info_btn">More Info</button>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
                <div class="list-group">
                    @if (isset($danger_info))
                        @foreach ($danger_info["memory_risk"] as $clients)
                            @foreach ($clients as $client)
                                <div class="list-group-item">
                                    <h4 class="list-group-item-heading">{{ $client->client_name }} is running out of Memory</h4>
                                    <p class="list-group-item-text">{{ $client-> memory_usage_percentage}} % Used</p>
                                    <button data-key="{{$client->client_id}}" href="/dashboard/clients/{{$client->client_id}}" class="btn btn-primary app-action-btn client_info_btn">More Info</button>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
                <div class="list-group">
                    @if (isset($danger_info))
                        @foreach ($danger_info["cpu_risk"] as $clients)
                            @foreach ($clients as $client)
                                <div class="list-group-item">
                                    <h4 class="list-group-item-heading">{{ $client->client_name }} is running out of CPU</h4>
                                    <p class="list-group-item-text">{{ $client-> client_cpu_usage}} % Used</p>
                                    <button data-key="{{$client->client_id}}" href="/dashboard/clients/{{$client->client_id}}" class="btn btn-primary app-action-btn client_info_btn">More Info</button>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.client_info_btn').click(function (e) {
            e.preventDefault();
            $('#ajax-container').load($(this).attr('href'));
            $('#side-menu').find('ul li').eq(0).removeClass('active');
        });
    </script>
</div>



