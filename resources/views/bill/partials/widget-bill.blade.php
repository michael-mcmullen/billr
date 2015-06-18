<div class="row">
    <div class="col-md-12">
        <div class="well well-sm">
            <div class="row">
                <div class="col-xs-3 text-center">
                    <div class="date">
                        <div class="month">
                            {{ date('F', strtotime($due)) }}
                        </div>
                        <div class="day">
                            {{ date('d, Y', strtotime($due)) }}
                        </div>
                    </div>
                </div>
                <div class="col-xs-9 bill-content">
                    <p class="company">
                        {{ $company }}
                    </p>
                    <p class="amount">
                        Transaction: $<span class="dollar">{{ number_format($amount, 2) }}</span>
                    </p>
                    <p class="account">
                        Account: {{ ($account_number) ?: 'N/A'  }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a href="#{{ $id }}" class="btn btn-fresh text-uppercase btn-block">
                        <span class="fa fa-check"></span> Mark this bill as paid
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>