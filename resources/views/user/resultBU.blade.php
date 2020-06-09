@extends('layouts.user')

@section('title', 'Welcome home 検索の結果')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>検索の結果</h1>
            <button onclick="locate()">Locate</button>
            <button onclick="clear()">Clear Locate</button></br>
            <button onclick="chase()">Chase</button>
            <button onclick="clear2()">Clear Chase</button>

            <pre id="position_view"></pre>
        </div>
    </div>
</div>
@endsection

<script>
var num = 0;
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
    // geo_text += "高度:" + position.coords.altitude + "\n";
    // geo_text += "位置精度:" + position.coords.accuracy + "\n";
    // geo_text += "高度精度:" + position.coords.altitudeAccuracy  + "\n";
    // geo_text += "移動方向:" + position.coords.heading + "\n";
    // geo_text += "速度:" + position.coords.speed + "\n";

    var date = new Date(position.timestamp);

    geo_text += "取得時刻:" + date.toLocaleString() + "\n";
    // geo_text += "取得回数:" + (++num) + "\n";

    document.getElementById('position_view').innerHTML = geo_text;
}

function chase() {
    watch_id2 = navigator.geolocation.watchPosition(chase2, function(e) { alert(e.message); }, {"enableHighAccuracy": true, "timeout": 20000, "maximumAge": 2000});
}

function clear2() {
    navigator.geolocation.clearWatch(watch_id2);
}

function chase2(position2) {
    var address_lati = 35.85;
    address_long = 139.67;
    search_area = 0.1;
    check_lati_1 = address_lati - search_area;
    check_lati_2 = address_lati + search_area;
    check_long_1 = address_long - search_area;
    check_long_2 = address_long + search_area;

    if (position2.coords.latitude >= check_lati_1 && position2.coords.latitude <= check_lati_2) {
        if (position2.coords.longtude >= check_long_1 && position2.coords.longtude <= check_long_2) {
            function sendmessage(){
                var smessage = "メッセージ送信！";
                var token = ["4ptoQpmb3ff5xK0lY7U9YASchL1VdZXBaRIqdHQ5Xya"];
                var options =
               {
                 "method"  : "post",
                 "payload" : "message=" + smessage,
                 "headers" : {"Authorization" : "Bearer "+ token}
               };
                UrlFetchApp.fetch("https://notify-api.line.me/api/notify", options);

                navigator.geolocation.clearWatch(watch_id2);
            }
        }
    }
}

function chase2(position2) {
    var address_lati = 35.85;
    address_long = 139.67;
    search_area = 0.1;
    check_lati_1 = address_lati - search_area;
    check_lati_2 = address_lati + search_area;
    check_long_1 = address_long - search_area;
    check_long_2 = address_long + search_area;

    if (locale.coords.latitude >= check_lati_1 && locale.coords.latitude <= check_lati_2) {
        if (locale.coords.longtude >= check_long_1 && locale.coords.longtude <= check_long_2) {
            var btn = document.getElementById('sendbtn');
            document.myform.submit();

            navigator.geolocation.clearWatch(watch_id);
        }
    }
}
</script>
