<div class="row">
    <div class="col-sm-9 placeholder">
        <div class="panel panel-success">
            <div class="panel-heading">Client Basic Information</div>
            <div class="panel-body">
                <div class="list-group">
                    @if (isset($client))
                        <h4> <span>Client ID      :</span>{{ $client->client_id }}</h4>
                        <h4> <span>Name           :</span> {{ $client->client_name }}</h4>
                        <h4> <span>Address        :</span> {{ $client->client_address }}</h4>
                        <h4> <span>Email          :</span> {{ $client->client_emailaddress }}</h4>
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
                @if (isset($client))

                    <div class="row text-center">
                        <div class="col-sm-4 utilisation_chart">
                            <div class="chart" data-percent={{ $client->space_usage_percentage }} data-scale-color="#ffb400"></div>
                            <span class="label label-info">{{ $client->space_usage_percentage }}%</span>
                            <p class="label label-info">Space Utilisation</p>
                        </div>
                        <div class="col-sm-4 utilisation_chart">
                            <div class="chart" data-percent={{ $client->memory_usage_percentage }} data-scale-color="#ffb400"></div>
                            <span class="label label-info">{{ $client->memory_usage_percentage }}%</span>
                            <p class="label label-info">Memory Utilisation</p>
                        </div>
                        <div class="col-sm-4 utilisation_chart">
                            <div class="chart" data-percent={{ $client->client_cpu_usage }} data-scale-color="#ffb400"></div>
                            <span class="label label-info">{{ $client->client_cpu_usage }}%</span>
                            <p class="label label-info">CPU Utilisation</p>
                        </div>
                    </div>

                    @endif

            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easypiechart.js"></script>
    <script>
        $(function() {
            $('.chart').easyPieChart({
                size: 200,
                lineWidth: 10
            });
        });
    </script>
</div>

