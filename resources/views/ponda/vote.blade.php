歡迎參與本次 PONDA 選舉 <br>
您所選擇的的候選人資料_如下，也麻煩輸入身分證認證投票。 <br><br>

候選人：{{ $ponda->name }} <br>
發表政見：{{ $ponda->introduction }} <br>
目前得票數：{{ $ponda->score }} <br><br>

<form method="POST" action="{{ route('ponda.sub', $ponda->id) }}">
    {{ csrf_field() }}

    請輸入身分證字號：
    <input id="UID" type="text" class="" name="UID" value="{{ old('UID') }}" autofocus>
    <button type="submit" class="btn btn-primary">
        投票送出
    </button>
</form>
