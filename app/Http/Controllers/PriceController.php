<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function price_api()
    {
        $info = '
            {
  "resultcode": "200",
  "reason": "查询成功!",
  "result": [
    {
      "city": "北京",
      "b90": "-",/*89(90)号*/
      "b93": "7.99",/*92(93)号*/
      "b97": "8.50",/*95(97)号*/
      "b0": "7.47",/*0号*/
      "92h": "7.99",/*建议取值*/
      "95h": "8.50",/*建议取值*/
      "98h": "7.47",/*建议取值*/
      "0h": "7.47"/*建议取值*/
    },
    {
      "city": "天津",
      "b90": "-",
      "b93": "7.98",
      "b97": "8.43",
      "b0": "7.40",
      "92h": "7.98",
      "95h": "8.43",
      "98h": "7.40",
      "0h": "7.40"
    },
    {
      "city": "河北",
      "b90": "-",
      "b93": "7.98",
      "b97": "8.43",
      "b0": "7.40",
      "92h": "7.98",
      "95h": "8.43",
      "98h": "7.40",
      "0h": "7.40"
    },
    {
      "city": "山西",
      "b90": "-",
      "b93": "7.93",
      "b97": "8.56",
      "b0": "5.64",
      "92h": "7.93",
      "95h": "8.56",
      "98h": "5.64",
      "0h": "5.64"
    },
    {
      "city": "内蒙古",
      "b90": "-",
      "b93": "7.94",
      "b97": "8.52",
      "b0": "0.00",
      "92h": "7.94",
      "95h": "8.52",
      "98h": "0.00",
      "0h": "0.00"
    },
    {
      "city": "辽宁",
      "b90": "-",
      "b93": "7.96",
      "b97": "8.49",
      "b0": "5.86",
      "92h": "7.96",
      "95h": "8.49",
      "98h": "5.86",
      "0h": "5.86"
    },
    {
      "city": "吉林",
      "b90": "-",
      "b93": "7.82",
      "b97": "8.43",
      "b0": "6.10",
      "92h": "7.82",
      "95h": "8.43",
      "98h": "6.10",
      "0h": "6.10"
    },
    {
      "city": "黑龙江",
      "b90": "-",
      "b93": "7.84",
      "b97": "8.36",
      "b0": "0.00",
      "92h": "7.84",
      "95h": "8.36",
      "98h": "0.00",
      "0h": "0.00"
    },
    {
      "city": "上海",
      "b90": "-",
      "b93": "7.95",
      "b97": "8.46",
      "b0": "6.62",
      "92h": "7.95",
      "95h": "8.46",
      "98h": "6.62",
      "0h": "6.62"
    },
    {
      "city": "江苏",
      "b90": "-",
      "b93": "7.95",
      "b97": "8.46",
      "b0": "6.66",
      "92h": "7.95",
      "95h": "8.46",
      "98h": "6.66",
      "0h": "6.66"
    },
    {
      "city": "浙江",
      "b90": "-",
      "b93": "7.49",
      "b97": "8.32",
      "b0": "5.99",
      "92h": "7.49",
      "95h": "8.32",
      "98h": "5.99",
      "0h": "5.99"
    },
    {
      "city": "安徽",
      "b90": "-",
      "b93": "7.93",
      "b97": "8.49",
      "b0": "7.44",
      "92h": "7.93",
      "95h": "8.49",
      "98h": "7.44",
      "0h": "7.44"
    },
    {
      "city": "福建",
      "b90": "-",
      "b93": "7.95",
      "b97": "8.48",
      "b0": "5.62",
      "92h": "7.95",
      "95h": "8.48",
      "98h": "5.62",
      "0h": "5.62"
    },
    {
      "city": "江西",
      "b90": "-",
      "b93": "7.94",
      "b97": "8.53",
      "b0": "7.38",
      "92h": "7.94",
      "95h": "8.53",
      "98h": "7.38",
      "0h": "7.38"
    },
    {
      "city": "山东",
      "b90": "-",
      "b93": "7.97",
      "b97": "8.55",
      "b0": "5.54",
      "92h": "7.97",
      "95h": "8.55",
      "98h": "5.54",
      "0h": "5.54"
    },
    {
      "city": "河南",
      "b90": "-",
      "b93": "7.99",
      "b97": "8.54",
      "b0": "5.68",
      "92h": "7.99",
      "95h": "8.54",
      "98h": "5.68",
      "0h": "5.68"
    },
    {
      "city": "湖北",
      "b90": "-",
      "b93": "7.86",
      "b97": "8.42",
      "b0": "5.40",
      "92h": "7.86",
      "95h": "8.42",
      "98h": "5.40",
      "0h": "5.40"
    },
    {
      "city": "湖南",
      "b90": "-",
      "b93": "7.80",
      "b97": "8.29",
      "b0": "6.64",
      "92h": "7.80",
      "95h": "8.29",
      "98h": "6.64",
      "0h": "6.64"
    },
    {
      "city": "广东",
      "b90": "-",
      "b93": "8.00",
      "b97": "8.67",
      "b0": "7.43",
      "92h": "8.00",
      "95h": "8.67",
      "98h": "7.43",
      "0h": "7.43"
    },
    {
      "city": "广西",
      "b90": "-",
      "b93": "8.04",
      "b97": "8.69",
      "b0": "7.49",
      "92h": "8.04",
      "95h": "8.69",
      "98h": "7.49",
      "0h": "7.49"
    },
    {
      "city": "海南",
      "b90": "-",
      "b93": "9.10",
      "b97": "9.67",
      "b0": "7.61",
      "92h": "9.10",
      "95h": "9.67",
      "98h": "7.61",
      "0h": "7.61"
    },
    {
      "city": "重庆",
      "b90": "-",
      "b93": "8.05",
      "b97": "8.50",
      "b0": "7.61",
      "92h": "8.05",
      "95h": "8.50",
      "98h": "7.61",
      "0h": "7.61"
    },
    {
      "city": "四川",
      "b90": "-",
      "b93": "8.00",
      "b97": "8.62",
      "b0": "6.12",
      "92h": "8.00",
      "95h": "8.62",
      "98h": "6.12",
      "0h": "6.12"
    },
    {
      "city": "贵州",
      "b90": "-",
      "b93": "8.11",
      "b97": "8.57",
      "b0": "6.94",
      "92h": "8.11",
      "95h": "8.57",
      "98h": "6.94",
      "0h": "6.94"
    },
    {
      "city": "云南",
      "b90": "-",
      "b93": "8.13",
      "b97": "8.73",
      "b0": "7.49",
      "92h": "8.13",
      "95h": "8.73",
      "98h": "7.49",
      "0h": "7.49"
    },
    {
      "city": "西藏",
      "b90": "-",
      "b93": "8.86",
      "b97": "9.37",
      "b0": "7.23",
      "92h": "8.86",
      "95h": "9.37",
      "98h": "7.23",
      "0h": "7.23"
    },
    {
      "city": "陕西",
      "b90": "-",
      "b93": "7.87",
      "b97": "8.31",
      "b0": "5.67",
      "92h": "7.87",
      "95h": "8.31",
      "98h": "5.67",
      "0h": "5.67"
    },
    {
      "city": "甘肃",
      "b90": "-",
      "b93": "7.87",
      "b97": "8.41",
      "b0": "5.51",
      "92h": "7.87",
      "95h": "8.41",
      "98h": "5.51",
      "0h": "5.51"
    },
    {
      "city": "青海",
      "b90": "-",
      "b93": "7.94",
      "b97": "8.51",
      "b0": "5.85",
      "92h": "7.94",
      "95h": "8.51",
      "98h": "5.85",
      "0h": "5.85"
    },
    {
      "city": "宁夏",
      "b90": "-",
      "b93": "7.88",
      "b97": "8.33",
      "b0": "5.56",
      "92h": "7.88",
      "95h": "8.33",
      "98h": "5.56",
      "0h": "5.56"
    },
    {
      "city": "新疆",
      "b90": "-",
      "b93": "7.90",
      "b97": "8.51",
      "b0": "6.06",
      "92h": "7.90",
      "95h": "8.51",
      "98h": "6.06",
      "0h": "6.06"
    }
  ],
  "error_code": 0
}
        ';
//        echo $info;
//        dd(json_decode($info,1));
    }
}
