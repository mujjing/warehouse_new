<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class ExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {
            if ($key > 0) {
                DB::table('warehouse')->insert(
                    [
                    'Serial_number'                 => $value[0],
                    'Address'                       => $value[1],
                    'Kendall'                       => $value[2], 
                    'Building'                      => $value[3],
                    'GFA_Py'                        => $value[4],
                    'const_permission'              => $value[5],
                    'build_start_date'              => (int) $value[6],
                    'completion_date'               => (int) $value[7],
                    'Investor_landlord'             => $value[8],
                    'AMC'                           => $value[9],
                    'PM_LM'                         => $value[10],
                    'DRY_COLD'                      => $value[11],
                    'Latitude'                      => $value[12],
                    'Longitude'                     => $value[13],
                    'Land_code'                     => $value[14],
                    'district_code'                 => $value[15],
                    'zone_code'                     => $value[16],
                    'area_code'                     => $value[17],
                    'land_area_sqm'                 => $value[18],
                    'floor_area'                    => $value[19],
                    'building_closing_rates'        => $value[20],
                    'GFA_sqm'                       => $value[21],
                    'Floor_area_calculation_GFA'    => $value[22],
                    'floor_area_ratio'              => $value[23],
                    'number_of_buildings'           => $value[24],
                    'number_of_affiliate_buildings' => $value[25],
                    'park_lot'                      => $value[26],
                    'construction_expected_date'    => (int) $value[27],
                    'construction_delay_date'       => (int) $value[28],
                    'creating_date'                 => (int) $value[29],
                    'note'                          => $value[30],
                    ]
                );
            }
        };
    }
}
