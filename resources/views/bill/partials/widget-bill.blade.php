<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <caption style="font-weight: bold; font-size: 40px; background-color: #FFF; color: #000; padding: 2px 5px;">
                {{ date('l F d, Y', strtotime($due)) }}
            </caption>
            <tbody>
                <tr>
                    <th width="30%" style="vertical-align: middle;">
                        {{ $company }} {{ ($nickname) ? '('. $nickname .')' : 'N/A'  }}
                    </th>
                    <td width="20%" style="font-size: 20px; vertical-align: middle;">
                        ${{ number_format($amount, 2) }}
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-justified btn-group-xs">
                            <a href="{{ URL::route('bill.edit', $id) }}" class="btn btn-primary">Edit Bill</a>
                            <a href="{{ URL::route('bill.pay', $id) }}" class="btn btn-success">Pay Bill</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>