<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Send New SMS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        {{ Form::open(array('url' => 'sendSMS',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                        {{ csrf_field() }}
                        <div class="card-body row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" id="number" name="number" placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea type="text" class="form-control" id="sms" name="sms" rows="4" placeholder="Enter Message" required></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                        <!-- /.card-footer -->
                        {{ Form::close() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</section>
