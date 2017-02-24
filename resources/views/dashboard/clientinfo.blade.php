<div class="row">
    <div class="col-sm-9 placeholder">
        <div class="panel panel-success">
            <div class="panel-heading">Client Basic Information</div>
            <div class="panel-body">
                <div class="list-group">
                    @if (isset($client))
                        <h4><span>Client ID &emsp;:&nbsp;</span>{{ $client->client_id }}</h4>
                        <h4><span>Name &emsp;&emsp;:</span> {{ $client->client_name }}</h4>
                        <h4><span>Address &emsp;:</span> {{ $client->client_address }}</h4>
                        <h4><span>Email &emsp;&emsp; :</span> {{ $client->client_emailaddress }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 placeholder">
        <div class="panel panel-success">
            <div class="panel-heading">View Client Logs</div>
            <div class="panel-body">
                <a href="/storage/uploads/{{ $client->client_name }}/nova-api.log" target="_blank"><img
                            class="log_image"
                            src="https://static1.squarespace.com/static/53d3b6bce4b07304e90385a9/t/53d8097ae4b0046e8e340482/1406667169736/"
                            alt=""></a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 placeholder">
        <div class="panel panel-info">
            <div class="panel-heading">Client Usage Information</div>
            <div class="panel-body">
                @if(isset($client))
                    <div class="row text-center">
                        <div class="col-sm-4 utilisation_chart">
                            <div id="chart_storage"
                                 data-percent={{ $client->space_usage_percentage }} data-scale-color="#ffb400">
                            </div>
                            <span id="chart_storage_lbl" class="label lbl-percentage">{{ $client->space_usage_percentage }}
                                %</span>
                            <p class="label label-info lbl-topic">Space Utilisation</p>
                        </div>
                        <div class="col-sm-4 utilisation_chart">
                            <div id="chart_memory"
                                 data-percent={{ $client->memory_usage_percentage }} data-scale-color="#ffb400">
                            </div>
                            <span id="chart_memory_lbl" class="label lbl-percentage">{{ $client->memory_usage_percentage }}
                                %</span>
                            <p class="label label-info lbl-topic">Memory Utilisation</p>
                        </div>

                        <div class="col-sm-4 utilisation_chart">
                            <div id="chart_cpu" data-percent={{ $client->client_cpu_usage }} data-scale-color="#ffb400">
                            </div>
                            <span id="chart_cpu_lbl" class="label lbl-percentage ">{{ $client->client_cpu_usage }}
                                %</span>
                            <p class="label label-info lbl-topic">CPU Utilisation</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-12 placeholder">
        <div class="panel panel-success">
            <div class="panel-heading">Set Message</div>
            <div class="panel-body">
                <div class="bs-component">

                    <div class="col-lg-12">
                        <input type="text" class="form-control" id="inputClientMessage" placeholder="Client Message"
                               name="client_message" autocomplete="off" value="">
                    </div>

                    <div class="col-lg-12">

                        <button id="sendClientMessage" type="button" class="btn btn-primary">
                            Send
                        </button>
                    </div>


                </div>

            </div>
        </div>
    </div>


    <script>

        $('#sendClientMessage').click(function () {
            $.post("{{url('/clients/message')}}",
                    { client_message: $('#inputClientMessage').val(), _token: "{{ csrf_token() }}", client_id : "{{ $client->client_id }}"  },
                    function (data, status) {

                    })
        });

        $(function () {
            $('#chart_storage').easyPieChart({
                size: 200,
                lineWidth: 5,
                barColor: "#5253ef"
            });
            $('#chart_memory').easyPieChart({
                size: 200,
                lineWidth: 5,
                barColor: "#5253ef"
            });
            $('#chart_cpu').easyPieChart({
                size: 200,
                lineWidth: 5,
                barColor: "#5253ef"
            });

        });

        var interval = setInterval(function () {

            $.ajax({
                url: "/clients/usage/{{$client->client_id }}",
                success: function (result) {
                    $('#chart_storage').data('easyPieChart').update(result.client.space_usage_percentage);
                    $('#chart_storage_lbl').text(result.client.space_usage_percentage + "%");
                    $('#chart_memory').data('easyPieChart').update(result.client.memory_usage_percentage);
                    $('#chart_memory_lbl').text(result.client.memory_usage_percentage + "%");
                    $('#chart_cpu').data('easyPieChart').update(result.client.client_cpu_usage);
                    $('#chart_cpu_lbl').text(result.client.client_cpu_usage + "%");
                }
            });
        }, 1000);

        $(function () {
            $('#side-menu').find('ul li').eq(1).find('a').text('Back');
            $('#side-menu').find('ul li').eq(1).find('a').addClass('text-change-link');
            $('#side-menu').find('ul li').find('a').click(function () {
                clearInterval(interval);
            })

        });


    </script>
    <script>
        $('#side-menu').find('ul li').find('a').click(function () {
            $('#side-menu').find('ul li').eq(1).find('a').text('Clients');
            $('#side-menu').find('ul li').eq(1).find('a').removeClass('text-change-link');

        });
    </script>

</div>

