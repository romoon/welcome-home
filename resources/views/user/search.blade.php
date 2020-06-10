@extends('layouts.user')

@section('title', 'Welcome home 検索の結果')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>位置情報の設定</h1>
        </div>
        <div class="col-md-10 mt-5">
            <h2>位置情報の取得開始／停止</h2>
            <input type="button" class="btn btn-rmngreen" value="開始" onclick="locate()">
            <input type="button" class="btn btn-danger" value="終了" onclick="clear()">
            <pre id="position_view"></pre>
        </div>
        <div class="col-md-10 mt-5">
            <iframe id="mapiframe" src="{{ $iframeurl }}" width="80%" height="360" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>

        <div class="col-md-10 mt-5">
            <form action="{{ action('User\SendController@sendnotify') }}" method="post" id="myform" enctype="multipart/form-data">
              <div class="form-group row">
                  <h2>取得する位置情報の条件設定</h2>
              </div>
              <div class="form-group row mt-3">
                  <label class="col-md-2">緯度</label>
                  <div class="col-md-10">
                      <input type="text" id="address_lati" name="lati" value="35.85">
                  </div>
                  <label class="col-md-2">経度</label>
                  <div class="col-md-10">
                      <input type="text" id="address_long" name="long" value="139.67">
                  </div>
                  <label class="col-md-2" name="startat">開始時刻</label>
                  <div class="col-md-10">
                      <input type="text" id="check_hour_1" value="16">
                  </div>
                  <label class="col-md-2" name="stopat">終了時間</label>
                  <div class="col-md-10">
                      <input type="text" id="check_hour_2" value="21">
                  </div>
              </div>
              <div class="form-group row mt-5">
                  <h2>LINE notify 送信メッセージの設定</h2>
              </div>
              <div class="form-group row mt-3">
                  <label class="col-md-2">メッセージ</label>
                  <div class="col-md-10">
                    <input type="text" name="smessage" size="30" value="最寄り駅に着きました。">
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-md-2">
                  {{ csrf_field() }}
                  <input id="" type="submit" class="btn btn-outline-rmngreen" value="メッセージの手動送信">
                </div>
              </div>
            </form>
        </div>
        <div class="col-md-10 mt-4">
              <a href="{{ asset('/profile/edit') }}" role="button" class="btn btn-warning">ユーザー情報の設定</a>
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

    var search_area = 0.1;
    // var address_lati = 35.85,
    // address_long = 139.67;
    // var check_hour_1 = 16,
    // check_hour_2 = 21;

    var address_lati = document.getElementById("address_lati").value;
    var address_long = document.getElementById("address_long").value;
    var check_hour_1 = document.getElementById("check_hour_1").value;
    var check_hour_2 = document.getElementById("check_hour_2").value;

    var check_lati_1 = address_lati - search_area;
    var check_lati_2 = parseFloat(address_lati) + parseFloat(search_area);
    var check_long_1 = address_long - search_area;
    var check_long_2 = parseFloat(address_long) + parseFloat(search_area);

    console.log(check_lati_1 <= position.coords.latitude);
    console.log(position.coords.latitude <= check_lati_2);
    console.log(check_long_1 <= position.coords.longitude);
    console.log(position.coords.longitude <= check_long_2);

    document.getElementById("mapiframe").contentWindow.location.replace('https://maps.google.com/maps?output=embed&q='+ address_lati + ',' + address_long + '&t=m&hl=ja&z=15');

    if (check_lati_1 <= position.coords.latitude && position.coords.latitude <= check_lati_2) {
        if (check_long_1 <= position.coords.longitude && position.coords.longitude <= check_long_2) {
            console.log(check_hour_1);
            var now_hour = new Date().getHours();

            if (check_hour_1 <= now_hour && now_hour <= check_hour_2) {
              document.forms["myform"].submit()
              navigator.geolocation.clearWatch(watch_id);
              console.log('追跡を終了しました！');
            }
        }
    }
}
</script>
