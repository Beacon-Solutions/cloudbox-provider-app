<div class="col-sm-12 placeholder">
    <div class="panel panel-success">
        <div class="panel-heading">Add Client</div>
        <div class="panel-body">

            <div class="bs-component">
                <form class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputUsername" class="col-lg-2 control-label">Client ID</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputId" placeholder="ID"
                                       name="username" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputFullName" class="col-lg-2 control-label">Client Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputFullName" placeholder="Name"
                                       name="full_name" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPosition" class="col-lg-2 control-label">Client Address</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputAddress" placeholder="Address"
                                       name="position" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPosition" class="col-lg-2 control-label">Client Email</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" placeholder="Email"
                                       name="position" autocomplete="off">
                            </div>
                        </div>

                        <input type="hidden" id="csrfToken" name="_token" value="{{ csrf_token() }}"/>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button id="add-client" type="button" class="btn btn-primary" name="_add">Add</button>
                            </div>
                        </div>

                    </fieldset>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $('#add-client').click(function () {
        $.post("{{url('/clients/add')}}",
            {
                client_id: $('#inputId').val(),
                client_name: $('#inputFullName').val(),
                client_address: $('#inputAddress').val(),
                client_email: $('#inputEmail').val(),
                _token: $('#csrfToken').val(),
            },
            function (data, status) {
                $('#side-menu').find('ul li').eq(1).find('a').click();
            })
    });
</script>