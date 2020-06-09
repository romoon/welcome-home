@extends('layouts.user')

@section('title', 'Welcome home 検索の結果')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>検索の結果</h1>
            <button onclick="locate()">Locate</button>
            <button onclick="clear()">Clear Locate</button></br></br>
            <pre id="position_view"></pre>
        </div>
        <div class="col-md-10 mt-4">
            <h1>メッセージの新規作成</h1>
            <form action="{{ action('User\SendController@sendnotify') }}" method="post" id="myform" enctype="multipart/form-data">
                <div class="form-group row">
                    <p>URL: <input type="text" name="notifyurl" style="background-color:#ccc" value="https://notify-api.line.me/api/notify" readonly></p>
                </div>
                <div class="form-group row">
                    <p>message: <input type="text" name="smessage" size="30" value="メッセージテスト"></p></br>
                </div>
                <div class="form-group row">
                    {{ csrf_field() }}
                    <input id="" type="submit" class="btn btn-rmngreen" value="送信">
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

<script type="text/javascript">
var watch_id;

function locate() {
    watch_id = navigator.geolocation.watchPosition(locate2, function(e) { alert(e.message); }, {"enableHighAccuracy": true, "timeout": 20000, "maximumAge": 2000});
}

function clear() {
    navigator.geolocation.clearWatch(watch_id);
}

function locate2(position) {
    var geo_text = "緯度:" + position.coords.latitude + "\n";
    geo_text += "経度:" + position.coords.longitude + "\n";

    var date = new Date(position.timestamp);

    geo_text += "取得時刻:" + date.toLocaleString() + "\n";

    document.getElementById('position_view').innerHTML = geo_text;

    var address_lati = 35.85,
    address_long = 139.67,
    search_area = 0.1;

    var check_lati_1 = address_lati - search_area;
    var check_lati_2 = address_lati + search_area;
    var check_long_1 = address_long - search_area;
    var check_long_2 = address_long + search_area;

    if (check_lati_1 <= position.coords.latitude && position.coords.latitude <= check_lati_2) {
        if (check_long_1 <= position.coords.longitude && position.coords.longitude <= check_long_2) {
            document.forms["myform"].submit()
            navigator.geolocation.clearWatch(watch_id);
            console.log('追跡を終了しました！');
        }
    }
}
</script>
