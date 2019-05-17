<?php

namespace App\Http\Controllers;

use App\Models\Ponda;
use Illuminate\Http\Request;

class PondaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pondas = Ponda::all();

        return view('ponda.index', compact('pondas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1',
            'introduction' => 'required|string|min:1'
        ]);
        $ponda = new Ponda;
        $ponda->name = $request->name;
        $ponda->introduction = $request->introduction;
        $ponda->score = $request->score;

        $ponda->save();

        return redirect()->route('ponda.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function show(Ponda $ponda)
    {
        $ponda->score = $ponda->score + 1;

        $ponda->save();

        return redirect('/ponda');
        // dd($ponda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function edit(Ponda $ponda)
    {
        return view('ponda.edit', compact('ponda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ponda $ponda)
    {
        $ponda->name = request('name');

        $ponda->introduction = request('introduction');

        $ponda->save();

        return redirect('/ponda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ponda $ponda)
    {
        $ponda->delete();
    }

    public function vote(Ponda $ponda)
    {
        return view('ponda.vote', compact('ponda'));
    }

    public function sub(Request $request, Ponda $ponda)
    {
        function id_card($cardid)
        {
            $err = '';
            //先將字母數字存成陣列
            $alphabet = [
                'A' => '10', 'B' => '11', 'C' => '12', 'D' => '13', 'E' => '14', 'F' => '15', 'G' => '16', 'H' => '17', 'I' => '34',
                'J' => '18', 'K' => '19', 'L' => '20', 'M' => '21', 'N' => '22', 'O' => '35', 'P' => '23', 'Q' => '24', 'R' => '25',
                'S' => '26', 'T' => '27', 'U' => '28', 'V' => '29', 'W' => '32', 'X' => '30', 'Y' => '31', 'Z' => '33'
            ];
            //檢查字元長度
            if (strlen($cardid) != 10) {
                $err = '1';
            } //長度不對
    
            //驗證英文字母正確性
            $alpha = substr($cardid, 0, 1); //英文字母
            $alpha = strtoupper($alpha); //若輸入英文字母為小寫則轉大寫
            if (!preg_match("/[A-Za-z]/", $alpha)) {
                $err = '2';
            } else {
                //計算字母總和
                $nx = $alphabet[$alpha];
                $ns = $nx[0] + $nx[1] * 9; //十位數+個位數x9
            }
    
            //驗證男女性別
            $gender = substr($cardid, 1, 1); //取性別位置
            if ($gender != '1' && $gender != '2') {
                $err = '3';
            } //驗證性別
    
            //N2x8+N3x7+N4x6+N5x5+N6x4+N7x3+N8x2+N9+N10
            if ($err == '') {
                $i = 8;
                $j = 1;
                $ms = 0;
                //先算 N2x8 + N3x7 + N4x6 + N5x5 + N6x4 + N7x3 + N8x2
                while ($i >= 2) {
                    $mx = substr($cardid, $j, 1); //由第j筆每次取一個數字
                    $my = $mx * $i; //N*$i
                    $ms = $ms + $my; //ms為加總
                    $j += 1;
                    $i--;
                }
                //最後再加上 N9 及 N10
                $ms = $ms + substr($cardid, 8, 1) + substr($cardid, 9, 1);
                //最後驗證除10
                $total = $ns + $ms; //上方的英文數字總和 + N2~N10總和
                if (($total % 10) != 0) {
                    $err = '4';
                }
            }
            //錯誤訊息返回
            switch ($err) {
                case '1':
                    $msg = '字元數錯誤';
                    break;
                case '2':
                    $msg = '英文字母錯誤';
                    break;
                case '3':
                    $msg = '性別錯誤';
                    break;
                case '4':
                    $msg = '驗證失敗';
                    break;
                default:
                    $msg = '驗證通過';
                    break;
            }
            return $cardid;
        }

        $request->validate([
            'UID' => 'required|string|between:10,10',
        ]);

        $nowuid = id_card($request->UID);

        $uids = \DB::table('uids')->select('uid')->get();

        $AA = [];

        foreach ($uids as $uid) {
            $AA[] = $uid->uid;
        }

        if (in_array($nowuid, $AA)) {
            return back()->withErrors('此身分證已登入投票！');
        } else {
            \DB::insert('insert into uids (uid) values (?)', array($nowuid));

            $ponda->score = $ponda->score + 1;

            $ponda->save();

            return redirect('/ponda');
        }
    }

    

}
