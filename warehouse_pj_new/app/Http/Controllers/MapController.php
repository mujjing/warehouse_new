<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MapController extends Controller
{
    public function __construct(MapLogic $mapLogic)
    {
        $this->mapLogic = $mapLogic;
    }

    public function index()
    {
        $data = DB::table('warehouse')->orderBy('id', 'DESC')->get();
        return view('map/index', compact('data'));
    }

    public function list()
    {
        $data = DB::table('warehouse')->orderBy('id', 'DESC')->get();
        return view('map/list', compact('data'));
    }

    // public function detail($id)
    // {
    //     return view('map/detail', compact('id'));
    // }

    public function mobileSearch()
    {
        $data = DB::table('warehouse')->orderBy('id', 'DESC')->get();
        return view('map/mobile_search', compact('data'));
    }

    public function search(Request $request)
    {
        $searchData = $request->only(['search_list', 'search']);
        $searchListCode = $searchData['search_list'];
        $list = $this->mapLogic->searchCode($searchListCode);
        $keyword = $searchData['search'];

        $data = DB::table('warehouse')
            ->where($list, 'like', "%{$keyword}%")
            ->get();

            $cp_threeToFive = [];
            $cp_fiveToTen = [];
            $cp_tenToTwenty = [];
            $cp_overTwenty = [];

            $ncp_threeToFive = [];
            $ncp_fiveToTen = [];
            $ncp_tenToTwenty = [];
            $ncp_overTwenty = [];

        foreach ($data as $map) {
            if ($map->Kendall == null) {
                if ($map->completion_date == 0 || $map->completion_date == null) { //착공자산
                    if ($map->GFA_Py > 3000 && $map->GFA_Py < 5000) {
                        $ncp_threeToFive[] = $map;
                    } elseif ($map->GFA_Py > 5000 && $map->GFA_Py < 10000) {
                        $ncp_fiveToTen[] = $map;
                    } elseif ($map->GFA_Py > 10000 && $map->GFA_Py < 20000) {
                        $ncp_tenToTwenty[] = $map;
                    } elseif ($map->GFA_Py > 20000) {
                        $ncp_overTwenty[] = $map;
                    }
                } else { //준공자산
                    if ($map->GFA_Py > 3000 && $map->GFA_Py < 5000) {
                        $cp_threeToFive[] = $map;
                    } elseif ($map->GFA_Py > 5000 && $map->GFA_Py < 10000) {
                        $cp_fiveToTen[] = $map;
                    } elseif ($map->GFA_Py > 10000 && $map->GFA_Py < 20000) {
                        $cp_tenToTwenty[] = $map;
                    } elseif ($map->GFA_Py > 20000) {
                        $cp_overTwenty[] = $map;
                    }
                }
            }
        }

        $count_cp_threeToFive_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_threeToFive);
        $count_cp_fiveToTen_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_fiveToTen);
        $count_cp_tenToTwenty_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_tenToTwenty);
        $count_cp_overTwenty_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_overTwenty);

        $sum_cp_threeToFive_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_threeToFive);
        $sum_cp_fiveToTen_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_fiveToTen);
        $sum_cp_tenToTwenty_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_tenToTwenty);
        $sum_cp_overTwenty_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_overTwenty);

        $count_ncp_threeToFive_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_threeToFive);
        $count_ncp_fiveToTen_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_fiveToTen);
        $count_ncp_tenToTwenty_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_tenToTwenty);
        $count_ncp_overTwenty_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_overTwenty);

        $sum_ncp_threeToFive_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_threeToFive);
        $sum_ncp_fiveToTen_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_fiveToTen);
        $sum_ncp_tenToTwenty_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_tenToTwenty);
        $sum_ncp_overTwenty_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_overTwenty);

        $totalCount_cp_ncp_overTwenty = $count_cp_overTwenty_GFA_Py + $count_ncp_overTwenty_GFA_Py;
        $totalCount_cp_ncp_tenToTwenty = $count_cp_tenToTwenty_GFA_Py + $count_ncp_tenToTwenty_GFA_Py;
        $totalCount_cp_ncp_fiveToTen = $count_cp_fiveToTen_GFA_Py + $count_ncp_fiveToTen_GFA_Py;
        $totalCount_cp_ncp_threeToFive = $count_cp_threeToFive_GFA_Py + $count_ncp_threeToFive_GFA_Py;

        $total_overTwenty_GFA_Py = $sum_cp_overTwenty_GFA_Py + $sum_ncp_overTwenty_GFA_Py;
        $total_tenToTwenty_GFA_Py = $sum_cp_tenToTwenty_GFA_Py + $sum_ncp_tenToTwenty_GFA_Py;
        $total_fiveToTen_GFA_Py = $sum_cp_fiveToTen_GFA_Py + $sum_ncp_fiveToTen_GFA_Py;
        $total_threeToFive_GFA_Py = $sum_cp_threeToFive_GFA_Py + $sum_ncp_threeToFive_GFA_Py;

        $totalCount_ncp_GFA_Py = $count_ncp_threeToFive_GFA_Py + $count_ncp_fiveToTen_GFA_Py + $count_ncp_tenToTwenty_GFA_Py + $count_ncp_overTwenty_GFA_Py;
        $total_ncp_GFA_Py = $sum_ncp_threeToFive_GFA_Py + $sum_ncp_fiveToTen_GFA_Py + $sum_ncp_tenToTwenty_GFA_Py + $sum_ncp_overTwenty_GFA_Py;
        $totalCount_cp_GFA_Py = $count_cp_threeToFive_GFA_Py + $count_cp_fiveToTen_GFA_Py + $count_cp_tenToTwenty_GFA_Py + $count_cp_overTwenty_GFA_Py;
        $total_cp_GFA_Py = $sum_cp_threeToFive_GFA_Py + $sum_cp_fiveToTen_GFA_Py + $sum_cp_tenToTwenty_GFA_Py + $sum_cp_overTwenty_GFA_Py;
        $totalCount_GFA_Py = $totalCount_cp_ncp_threeToFive + $totalCount_cp_ncp_fiveToTen + $totalCount_cp_ncp_tenToTwenty + $totalCount_cp_ncp_overTwenty;
        $total_GFA_Py = $total_threeToFive_GFA_Py + $total_fiveToTen_GFA_Py + $total_tenToTwenty_GFA_Py + $total_overTwenty_GFA_Py;


        return view('map/search', 
                    compact(
                        'data', 
                        'searchListCode', 
                        'keyword',
                        'count_cp_threeToFive_GFA_Py',
                        'count_cp_fiveToTen_GFA_Py',
                        'count_cp_tenToTwenty_GFA_Py',
                        'count_cp_overTwenty_GFA_Py',
                        'sum_cp_threeToFive_GFA_Py',
                        'sum_cp_fiveToTen_GFA_Py',
                        'sum_cp_tenToTwenty_GFA_Py',
                        'sum_cp_overTwenty_GFA_Py',
                        'count_ncp_threeToFive_GFA_Py',
                        'count_ncp_fiveToTen_GFA_Py',
                        'count_ncp_tenToTwenty_GFA_Py',
                        'count_ncp_overTwenty_GFA_Py',
                        'sum_ncp_threeToFive_GFA_Py',
                        'sum_ncp_fiveToTen_GFA_Py',
                        'sum_ncp_tenToTwenty_GFA_Py',
                        'sum_ncp_overTwenty_GFA_Py',
                        'totalCount_cp_ncp_overTwenty',
                        'totalCount_cp_ncp_tenToTwenty',
                        'totalCount_cp_ncp_fiveToTen',
                        'totalCount_cp_ncp_threeToFive',
                        'total_overTwenty_GFA_Py',
                        'total_tenToTwenty_GFA_Py',
                        'total_fiveToTen_GFA_Py',
                        'total_threeToFive_GFA_Py',
                        'totalCount_ncp_GFA_Py',
                        'total_ncp_GFA_Py',
                        'totalCount_cp_GFA_Py',
                        'total_cp_GFA_Py',
                        'totalCount_GFA_Py',
                        'total_GFA_Py'
                    ));
    }

    public function mobileSearchResult(Request $request)
    {
        $searchData = $request->only(['search_list', 'search']);
        $searchListCode = $searchData['search_list'];
        $list = $this->mapLogic->searchCode($searchListCode);
        $keyword = $searchData['search'];

        $data = DB::table('warehouse')
            ->where($list, 'like', "%{$keyword}%")
            ->get();

            $cp_threeToFive = [];
            $cp_fiveToTen = [];
            $cp_tenToTwenty = [];
            $cp_overTwenty = [];

            $ncp_threeToFive = [];
            $ncp_fiveToTen = [];
            $ncp_tenToTwenty = [];
            $ncp_overTwenty = [];

        foreach ($data as $map) {
            if ($map->Kendall == null) {
                if ($map->completion_date == 0 || $map->completion_date == null) { //착공자산
                    if ($map->GFA_Py > 3000 && $map->GFA_Py < 5000) {
                        $ncp_threeToFive[] = $map;
                    } elseif ($map->GFA_Py > 5000 && $map->GFA_Py < 10000) {
                        $ncp_fiveToTen[] = $map;
                    } elseif ($map->GFA_Py > 10000 && $map->GFA_Py < 20000) {
                        $ncp_tenToTwenty[] = $map;
                    } elseif ($map->GFA_Py > 20000) {
                        $ncp_overTwenty[] = $map;
                    }
                } else { //준공자산
                    if ($map->GFA_Py > 3000 && $map->GFA_Py < 5000) {
                        $cp_threeToFive[] = $map;
                    } elseif ($map->GFA_Py > 5000 && $map->GFA_Py < 10000) {
                        $cp_fiveToTen[] = $map;
                    } elseif ($map->GFA_Py > 10000 && $map->GFA_Py < 20000) {
                        $cp_tenToTwenty[] = $map;
                    } elseif ($map->GFA_Py > 20000) {
                        $cp_overTwenty[] = $map;
                    }
                }
            }
        }

        $count_cp_threeToFive_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_threeToFive);
        $count_cp_fiveToTen_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_fiveToTen);
        $count_cp_tenToTwenty_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_tenToTwenty);
        $count_cp_overTwenty_GFA_Py = $this->mapLogic->countCpThreeToFive($cp_overTwenty);

        $sum_cp_threeToFive_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_threeToFive);
        $sum_cp_fiveToTen_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_fiveToTen);
        $sum_cp_tenToTwenty_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_tenToTwenty);
        $sum_cp_overTwenty_GFA_Py = $this->mapLogic->sumCpThreeToFive($cp_overTwenty);

        $count_ncp_threeToFive_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_threeToFive);
        $count_ncp_fiveToTen_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_fiveToTen);
        $count_ncp_tenToTwenty_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_tenToTwenty);
        $count_ncp_overTwenty_GFA_Py = $this->mapLogic->countNcpThreeToFive($ncp_overTwenty);

        $sum_ncp_threeToFive_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_threeToFive);
        $sum_ncp_fiveToTen_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_fiveToTen);
        $sum_ncp_tenToTwenty_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_tenToTwenty);
        $sum_ncp_overTwenty_GFA_Py = $this->mapLogic->sumNcpThreeToFive($ncp_overTwenty);

        $totalCount_cp_ncp_overTwenty = $count_cp_overTwenty_GFA_Py + $count_ncp_overTwenty_GFA_Py;
        $totalCount_cp_ncp_tenToTwenty = $count_cp_tenToTwenty_GFA_Py + $count_ncp_tenToTwenty_GFA_Py;
        $totalCount_cp_ncp_fiveToTen = $count_cp_fiveToTen_GFA_Py + $count_ncp_fiveToTen_GFA_Py;
        $totalCount_cp_ncp_threeToFive = $count_cp_threeToFive_GFA_Py + $count_ncp_threeToFive_GFA_Py;

        $total_overTwenty_GFA_Py = $sum_cp_overTwenty_GFA_Py + $sum_ncp_overTwenty_GFA_Py;
        $total_tenToTwenty_GFA_Py = $sum_cp_tenToTwenty_GFA_Py + $sum_ncp_tenToTwenty_GFA_Py;
        $total_fiveToTen_GFA_Py = $sum_cp_fiveToTen_GFA_Py + $sum_ncp_fiveToTen_GFA_Py;
        $total_threeToFive_GFA_Py = $sum_cp_threeToFive_GFA_Py + $sum_ncp_threeToFive_GFA_Py;

        $totalCount_ncp_GFA_Py = $count_ncp_threeToFive_GFA_Py + $count_ncp_fiveToTen_GFA_Py + $count_ncp_tenToTwenty_GFA_Py + $count_ncp_overTwenty_GFA_Py;
        $total_ncp_GFA_Py = $sum_ncp_threeToFive_GFA_Py + $sum_ncp_fiveToTen_GFA_Py + $sum_ncp_tenToTwenty_GFA_Py + $sum_ncp_overTwenty_GFA_Py;
        $totalCount_cp_GFA_Py = $count_cp_threeToFive_GFA_Py + $count_cp_fiveToTen_GFA_Py + $count_cp_tenToTwenty_GFA_Py + $count_cp_overTwenty_GFA_Py;
        $total_cp_GFA_Py = $sum_cp_threeToFive_GFA_Py + $sum_cp_fiveToTen_GFA_Py + $sum_cp_tenToTwenty_GFA_Py + $sum_cp_overTwenty_GFA_Py;
        $totalCount_GFA_Py = $totalCount_cp_ncp_threeToFive + $totalCount_cp_ncp_fiveToTen + $totalCount_cp_ncp_tenToTwenty + $totalCount_cp_ncp_overTwenty;
        $total_GFA_Py = $total_threeToFive_GFA_Py + $total_fiveToTen_GFA_Py + $total_tenToTwenty_GFA_Py + $total_overTwenty_GFA_Py;


        return view('map/mobile_search_result', 
                    compact(
                        'data', 
                        'searchListCode', 
                        'keyword',
                        'count_cp_threeToFive_GFA_Py',
                        'count_cp_fiveToTen_GFA_Py',
                        'count_cp_tenToTwenty_GFA_Py',
                        'count_cp_overTwenty_GFA_Py',
                        'sum_cp_threeToFive_GFA_Py',
                        'sum_cp_fiveToTen_GFA_Py',
                        'sum_cp_tenToTwenty_GFA_Py',
                        'sum_cp_overTwenty_GFA_Py',
                        'count_ncp_threeToFive_GFA_Py',
                        'count_ncp_fiveToTen_GFA_Py',
                        'count_ncp_tenToTwenty_GFA_Py',
                        'count_ncp_overTwenty_GFA_Py',
                        'sum_ncp_threeToFive_GFA_Py',
                        'sum_ncp_fiveToTen_GFA_Py',
                        'sum_ncp_tenToTwenty_GFA_Py',
                        'sum_ncp_overTwenty_GFA_Py',
                        'totalCount_cp_ncp_overTwenty',
                        'totalCount_cp_ncp_tenToTwenty',
                        'totalCount_cp_ncp_fiveToTen',
                        'totalCount_cp_ncp_threeToFive',
                        'total_overTwenty_GFA_Py',
                        'total_tenToTwenty_GFA_Py',
                        'total_fiveToTen_GFA_Py',
                        'total_threeToFive_GFA_Py',
                        'totalCount_ncp_GFA_Py',
                        'total_ncp_GFA_Py',
                        'totalCount_cp_GFA_Py',
                        'total_cp_GFA_Py',
                        'totalCount_GFA_Py',
                        'total_GFA_Py'
                    ));
    }

    function detailInfo($id) {
        $data = DB::table('warehouse')
        ->where('id' , $id)
        ->get();
        
        return view('map/detail', compact('data')); 
    }
}
