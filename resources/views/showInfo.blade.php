<from method="POST" name="showform" action="{{ url('/postInfo') }}" class="w3-container" id="showInfo" enctype="multipart/form-data" >
    {{ csrf_filed() }}
    <div class="w3-padding w3-left">
        <p>
            <label>大頭貼</label>
        </p>
            @if(isset($photos))
                <img src="{{ url('../storage/app/' . $photos->path) }}" width="300px" height="200px" style="border: 5px solid; border-radius: 12px">
            @else
                <img alt="尚未上傳圖片" width="300px" height="200px" style="border: 5px solid; border-radius: 12px">
    </div>
    
        <input type="hidden" name="user_id" value="{{ $users->id }}">
        <button form="showInfo" class="w3-btn w3-white w3-border w3-round-large w3-left" style="margin-left: 30px;" onclick="alert('修改成功')">送出</button>
</from>