<div class="row">
    <div class="col-sm-12 placeholder">
        <div class="panel panel-primary">
            <div class="panel-heading">Clients</div>
            <div class="panel-body">
                <div class="list-group" id ="clients_list">

                    @foreach ($all_clients as $clients)
                        <div class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $clients->client_name }}</h4>
                            <p class="list-group-item-text">{{ $clients->client_address }}</p>
                            <button data-key="{{$clients->client_id}}" href="/dashboard/clients/{{$clients->client_id}}" class="btn btn-primary app-action-btn client_info_btn">More Info</button>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script>
        $('.client_info_btn').click(function (e) {
            e.preventDefault();
            $('#ajax-container').load($(this).attr('href'));
        });
    </script>
</div>

