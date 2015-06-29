<div class="row">
    <div class="col-md-12">
        <div class="well well-sm">
            <div class="row">
                <div class="col-sm-3 text-center">
                    <div class="date">
                        <div class="month">
                            {{ date('F', strtotime($due)) }}
                        </div>
                        <div class="day">
                            {{ date('d, Y', strtotime($due)) }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 bill-content">
                    <p class="company">
                        {{ $company }}
                    </p>
                    <p class="amount">
                        Transaction: $<span class="dollar">{{ number_format($amount, 2) }}</span>
                    </p>
                    <p class="account">
                        Nickname: {{ ($nickname) ?: 'N/A'  }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{ URL::route('bill.edit', $id) }}" class="btn btn-primary text-uppercase btn-block">
                        <span class="fa fa-check"></span> Edit this bill
                    </a>
                </div>
                <div class="col-sm-9">
                    <a href="{{ URL::route('bill.pay', $id) }}" class="btn btn-success text-uppercase btn-block">
                        <span class="fa fa-check"></span> Mark this bill as paid
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>