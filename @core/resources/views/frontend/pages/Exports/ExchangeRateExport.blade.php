<div class="table-responsive">
    <div>All Exchange rates</div>
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">Country</th>
            <th scope="col">Currency</th>
            <th scope="col">Selling</th>
            <th scope="col">Buying</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$exchange_rate)
            <tr>
                <th scope="col">#</th>
                <th scope="row">{{$key+1}}</th>
                <td>{{$exchange_rate->country}}</td>
                <td>{{$exchange_rate->currency}}</td>
                <td>{{$exchange_rate->selling}}</td>
                <td>{{$exchange_rate->buying}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Currency</th>
            <th scope="col">Spot</th>
            <th scope="col">Sight/OD</th>
            <th scope="col">1 Month</th>
            <th scope="col">2 Month</th>
            <th scope="col">3 Month</th>
            <th scope="col">4 Month</th>
            <th scope="col">5 Month</th>
            <th scope="col">6 Month</th>
        </tr>
        </thead>
        <tbody>
        @foreach($export as $key=>$exp)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$exp->currency}}</td>
                <td>{{$exp->spot}}</td>
                <td>{{$exp->sight_od}}</td>
                <td>{{$exp->first_month}}</td>
                <td>{{$exp->second_month}}</td>
                <td>{{$exp->thirs_month}}</td>
                <td>{{$exp->fourth_month}}</td>
                <td>{{$exp->fifth_month}}</td>
                <td>{{$exp->sixth_month}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">A Index</th>
            <th scope="col">A Index Change</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cotlook as $key=>$cot)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$cot->a_index}}</td>
                <td>{{$cot->a_index_change}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Contract</th>
            <th scope="col">Close</th>
            <th scope="col">Changes</th>
        </tr>
        </thead>
        <tbody>

        @foreach($nyc as $key=>$ny)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$ny->contract}}</td>
                <td>{{$ny->close}}</td>
                <td>{{$ny->changes}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">KCA Grafe 3 Spot</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kca as $key=>$kc)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$kc->kca_grade_3_spot}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prod</th>
            <th scope="col">Last</th>
            <th scope="col">Chg</th>
            <th scope="col">Vol</th>
            <th scope="col">Open Interest</th>
        </tr>
        </thead>
        <tbody>
        @foreach($china as $key=>$china)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$china->prod}}</td>
                <td>{{$china->last}}</td>
                <td>{{$china->chg}}</td>
                <td>{{$china->vol}}</td>
                <td>{{$china->open_interest}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
