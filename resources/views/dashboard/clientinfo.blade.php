<div class="row">
    <div class="col-sm-9 placeholder">
        <div class="panel panel-success">
            <div class="panel-heading">Client Basic Information</div>
            <div class="panel-body">
                <div class="list-group">
                    @if (isset($client))
                        <h4> <span>Client ID &emsp;:&nbsp;</span>{{ $client->client_id }}</h4>
                        <h4> <span>Name &emsp;&emsp;:</span> {{ $client->client_name }}</h4>
                        <h4> <span>Address &emsp;:</span> {{ $client->client_address }}</h4>
                        <h4> <span>Email &emsp;&emsp; :</span> {{ $client->client_emailaddress }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 placeholder">
        <div class="panel panel-success">
            <div class="panel-heading">View Client Logs</div>
            <div class="panel-body">
                <a href="logs/log1.txt" target="_blank"><img class="log_image" src="https://static1.squarespace.com/static/53d3b6bce4b07304e90385a9/t/53d8097ae4b0046e8e340482/1406667169736/" alt=""></a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 placeholder">
        <div class="panel panel-info">
            <div class="panel-heading">Client Usage Information</div>
            <div class="panel-body">
                @if(isset($client))
                    <div class="row text-center">
                        @if ($client->space_usage_percentage > 75)
                            <div class="col-sm-4 utilisation_chart">
                                <div class="chart-danger" data-percent={{ $client->space_usage_percentage }} data-scale-color="#ffb400"></div>
                                <span class="label lbl-percentage">{{ $client->space_usage_percentage }}%</span>
                                <p class="label label-info lbl-topic">Space Utilisation</p>
                            </div>
                        @else
                            <div class="col-sm-4 utilisation_chart">
                                <div class="chart" data-percent={{ $client->space_usage_percentage }} data-scale-color="#ffb400"></div>
                                <span class="label lbl-percentage">{{ $client->space_usage_percentage }}%</span>
                                <p class="label label-info lbl-topic">Space Utilisation</p>
                            </div>
                        @endif
                        @if ($client->memory_usage_percentage > 75)
                            <div class="col-sm-4 utilisation_chart">
                                <div class="chart-danger" data-percent={{ $client->memory_usage_percentage }} data-scale-color="#ffb400"></div>
                                <<span class="label lbl-percentage">{{ $client->memory_usage_percentage }}%</span>
                                <p class="label label-info lbl-topic">Memory Utilisation</p>
                            </div>
                        @else
                            <div class="col-sm-4 utilisation_chart">
                                <div class="chart" data-percent={{ $client->memory_usage_percentage }} data-scale-color="#ffb400"></div>
                                <span class="label lbl-percentage">{{ $client->memory_usage_percentage }}%</span>
                                <p class="label label-info lbl-topic">Memory Utilisation</p>
                            </div>
                        @endif
                        @if ($client->client_cpu_usage > 75)
                            <div class="col-sm-4 utilisation_chart">
                                <div class="chart-danger" data-percent={{ $client->client_cpu_usage }} data-scale-color="#ffb400"></div>
                                <span class="label lbl-percentage">{{ $client->client_cpu_usage }}%</span>
                                <p class="label label-info lbl-topic">CPU Utilisation</p>
                            </div>
                        @else
                            <div class="col-sm-4 utilisation_chart">
                                <div class="chart" data-percent={{ $client->client_cpu_usage }} data-scale-color="#ffb400"></div>
                                <span class="label lbl-percentage">{{ $client->client_cpu_usage }}%</span>
                                <p class="label label-info lbl-topic">CPU Utilisation</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>


    <script>
        $(function() {
            $('.chart').easyPieChart({
                size: 200,
                lineWidth: 5,
                barColor: "#515fef"
            });
        });

        $(function() {
            $('.chart-danger').easyPieChart({
                size: 200,
                lineWidth: 5,
                barColor: "#ef1e25"
            });
        });

        $(function() {
            $('#side-menu').find('ul li').eq(1).find('a').text('Back');
            $('#side-menu').find('ul li').eq(1).find('a').addClass('text-change-link');
        });


    </script>
    <script>
        $('#side-menu').find('ul li').find('a').click(function() {
            $('#side-menu').find('ul li').eq(1).find('a').text('Clients');
            $('#side-menu').find('ul li').eq(1).find('a').removeClass('text-change-link');

        });
    </script>

</div>

