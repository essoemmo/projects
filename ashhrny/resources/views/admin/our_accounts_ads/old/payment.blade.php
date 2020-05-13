@if($transaction->payment_type == 'bank')
    <div class="" id="tab-data">
        <div class="col-sm-1"></div>
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{_i('Bank Details')}}</h5>
                        </div>
                        <div class="card-block">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <button data-toggle="tooltip" title="Bank"
                                                class="btn btn-primary">
                                            <i class="fa fa-bank"></i>
                                        </button>
                                    </td>
                                    <td>{{ $transaction->bank->translate(app()->getLocale())->title }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button data-toggle="tooltip"
                                                title="Bank Transaction Number"
                                                class="btn btn-primary">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </button>
                                    </td>
                                    <td>{{ $transaction->bank_transactions_num }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button data-toggle="tooltip" title="Image"
                                                class="btn btn-primary">
                                            <i class="fa fa-file-image-o"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <img class="img-responsive pad" width="150px"
                                             height="150px"
                                             src="{{ asset($transaction->image) }}" id="image">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>

@elseif($transaction->payment_type == 'online')
    <div class="" id="tab-data">
        <div class="col-sm-1"></div>
        <div class="row">
            <div class="col-6">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{_i('Payment Details')}}</h5>
                        </div>
                        <div class="card-block">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <button data-toggle="tooltip" title="Bank"
                                                class="btn btn-primary">
                                            <i class="fa fa-bank"></i>
                                        </button>
                                    </td>
                                    <td>{{ _i('Online Payment') }}</td>
                                    <td>
                                        <button data-toggle="tooltip" title="Transaction Number"
                                                class="btn btn-primary">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </button>
                                    </td>
                                    <td>{{ $transaction->bank_transactions_num }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button data-toggle="tooltip" title="Holder Name"
                                                class="btn btn-primary">
                                            <i class="fa fa-user"></i>
                                        </button>
                                    </td>
                                    <td>{{ $transaction->holder_name }}</td>
                                    <td>
                                        <button data-toggle="tooltip" title="Holder Card Number"
                                                class="btn btn-primary">
                                            <i class="fa fa-credit-card-alt"></i>
                                        </button>
                                    </td>
                                    <td>{{ $transaction->holder_card_number }}</td>
                                    <td>
                                        <button data-toggle="tooltip" title="Holder Expire"
                                                class="btn btn-primary">
                                            <i class="fa fa-credit-card-alt"></i>
                                        </button>
                                    </td>
                                    <td>{{ $transaction->holder_expire }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>
@endif
