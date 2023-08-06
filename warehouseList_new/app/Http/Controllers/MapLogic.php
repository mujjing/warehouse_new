<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapLogic
{
    public function searchCode($searchListCode) {

        if ($searchListCode == 1) {
            $list = "Address";
        } elseif ($searchListCode == 2) {
            $list = "Building";
        } elseif ($searchListCode == 3) {
            $list = "Investor_landlord";
        } elseif ($searchListCode == 4) {
            $list = "AMC";
        } elseif ($searchListCode == 5) {
            $list = "PM_LM";
        } elseif ($searchListCode == 6) {
            $list = "DRY_COLD";
        } elseif ($searchListCode == 7) {
            $list = "note";
        }
        return $list;
    }

    public function sumCpThreeToFive($cp_threeToFive) {
        $sum_cp_threeToFive = [];
        foreach ($cp_threeToFive as $data) {
            $sum_cp_threeToFive[] = $data->GFA_Py;
        }
        $cp_threeToFive_GFA_Py = array_sum($sum_cp_threeToFive);
        return $cp_threeToFive_GFA_Py;
    }

    public function sumCpFiveToTen($cp_fiveToTen) {
        $sum_cp_fiveToTen = [];
        foreach ($cp_fiveToTen as $data) {
            $sum_cp_fiveToTen[] = $data->GFA_Py;
        }
        $cp_fiveToTen_GFA_Py = array_sum($sum_cp_fiveToTen);
        return $cp_fiveToTen_GFA_Py;
    }

    public function sumCpTenToTwenty($cp_tenToTwenty) {
        $sum_cp_tenToTwenty = [];
        foreach ($cp_tenToTwenty as $data) {
            $sum_cp_tenToTwenty[] = $data->GFA_Py;
        }
        $cp_tenToTwenty_GFA_Py = array_sum($sum_cp_tenToTwenty);
        return $cp_tenToTwenty_GFA_Py;
    }

    public function sumCpOverTwenty($cp_overTwenty) {
        $sum_cp_overTwenty = [];
        foreach ($cp_overTwenty as $data) {
            $sum_cp_overTwenty[] = $data->GFA_Py;
        }
        $cp_overTwenty_GFA_Py = array_sum($sum_cp_overTwenty);
        return $cp_overTwenty_GFA_Py;
    }

    public function sumNcpThreeToFive($ncp_threeToFive) {
        $sum_ncp_threeToFive = [];
        foreach ($ncp_threeToFive as $data) {
            $sum_ncp_threeToFive[] = $data->GFA_Py;
        }
        $ncp_threeToFive_GFA_Py = array_sum($sum_ncp_threeToFive);
        return $ncp_threeToFive_GFA_Py;
    }

    public function sumNcpFiveToTen($ncp_fiveToTen) {
        $sum_ncp_fiveToTen = [];
        foreach ($ncp_fiveToTen as $data) {
            $sum_ncp_fiveToTen[] = $data->GFA_Py;
        }
        $ncp_fiveToTen_GFA_Py = array_sum($sum_ncp_fiveToTen);
        return $ncp_fiveToTen_GFA_Py;
    }

    public function sumNcpTenToTwenty($ncp_tenToTwenty) {
        $sum_ncp_tenToTwenty = [];
        foreach ($ncp_tenToTwenty as $data) {
            $sum_ncp_tenToTwenty[] = $data->GFA_Py;
        }
        $ncp_tenToTwenty_GFA_Py = array_sum($sum_ncp_tenToTwenty);
        return $ncp_tenToTwenty_GFA_Py;
    }

    public function sumNcpOverTwenty($ncp_overTwenty) {
        $sum_ncp_overTwenty = [];
        foreach ($ncp_overTwenty as $data) {
            $sum_ncp_overTwenty[] = $data->GFA_Py;
        }
        $ncp_overTwenty_GFA_Py = array_sum($sum_ncp_overTwenty);
        return $ncp_overTwenty_GFA_Py;
    }

    public function countCpThreeToFive($cp_threeToFive) {
        $count = count($cp_threeToFive);
        return $count;
    }
    public function countCpFiveToTen($cp_fiveToTen) {
        $count = count($cp_fiveToTen);
        return $count;
    }

    public function countCpTenToTwenty($cp_tenToTwenty) {
        $count = count($cp_tenToTwenty);
        return $count;
    }

    public function countCpOverTwenty($cp_overTwenty) {
        $count = count($cp_overTwenty);
        return $count;
    }

    public function countNcpThreeToFive($ncp_threeToFive) {
        $count = count($ncp_threeToFive);
        return $count;
    }
    public function countNcpFiveToTen($ncp_fiveToTen) {
        $count = count($ncp_fiveToTen);
        return $count;
    }

    public function countNcpTenToTwenty($ncp_tenToTwenty) {
        $count = count($ncp_tenToTwenty);
        return $count;
    }

    public function countNcpOverTwenty($ncp_overTwenty) {
        $count = count($ncp_overTwenty);
        return $count;
    }
}