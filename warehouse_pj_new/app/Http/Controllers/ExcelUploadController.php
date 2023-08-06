<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ExcelUploadController extends Controller
{
    function index()
    {
        $data = DB::table('warehouse')->orderBy('id', 'DESC')->paginate(10);
        return view('excelUpload/list', compact('data'));
    }

    function excel(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);
        $file = $request->file;
        Excel::import(new ExcelImport, $file);
        return back()->with('success', 'Excel Data Imported successfully.');
    }

    public function update($id)
    {
        $data = DB::table('warehouse')->where('id', $id)->first();
        return view('excelUpload/update', compact('data'));
    }

    public function updateSubmit(Request $request)
    {
        $this->validate($request, [
            'id'                            => ['nullable', 'integer'],
            'Serial_number'                 => ['nullable', 'string'],
            'Address'                       => ['nullable', 'string'],
            'Kendall'                       => ['nullable', 'string'],
            'Building'                      => ['nullable', 'string'],
            'GFA_Py'                        => ['nullable', 'integer'],
            'const_permission'              => ['nullable', 'integer'],
            'build_start_date'              => ['nullable', 'integer'],
            'completion_date'               => ['nullable', 'integer'],
            'Investor_landlord'             => ['nullable', 'string'],
            'AMC'                           => ['nullable', 'string'],
            'PM_LM'                         => ['nullable', 'string'],
            'DRY_COLD'                      => ['nullable', 'string'],
            'Latitude'                      => ['nullable'],
            'Longitude'                     => ['nullable'],
            'Land_code'                     => ['nullable', 'string'],
            'district_code'                 => ['nullable', 'string'],
            'zone_code'                     => ['nullable', 'string'],
            'area_code'                     => ['nullable', 'string'],
            'land_area_sqm'                 => ['nullable'],
            'floor_area'                    => ['nullable'],
            'building_closing_rates'        => ['nullable'],
            'GFA_sqm'                       => ['nullable'],
            'Floor_area_calculation_GFA'    => ['nullable'],
            'floor_area_ratio'              => ['nullable'],
            'number_of_buildings'           => ['nullable', 'integer'],
            'number_of_affiliate_buildings' => ['nullable', 'integer'],
            'park_lot'                      => ['nullable', 'integer'],
            'construction_expected_date'    => ['nullable', 'integer'],
            'construction_delay_date'       => ['nullable', 'integer'],
            'creating_date'                 => ['nullable', 'integer'],
            'note'                          => ['nullable', 'note'],
        ]);

        $data = [
            'Serial_number'                 => $request->Serial_number,
            'Address'                       => $request->Address,
            'Kendall'                       => $request->Kendall,
            'Building'                      => $request->Building,
            'GFA_Py'                        => $request->GFA_Py,
            'const_permission'              => $request->const_permission,
            'build_start_date'              => $request->build_start_date,
            'completion_date'               => $request->completion_date,
            'Investor_landlord'             => $request->Investor_landlord,
            'AMC'                           => $request->AMC,
            'PM_LM'                         => $request->PM_LM,
            'DRY_COLD'                      => $request->DRY_COLD,
            'Latitude'                      => $request->Latitude,
            'Longitude'                     => $request->Longitude,
            'Land_code'                     => $request->Land_code,
            'district_code'                 => $request->district_code,
            'zone_code'                     => $request->zone_code,
            'area_code'                     => $request->area_code,
            'land_area_sqm'                 => $request->land_area_sqm,
            'floor_area'                    => $request->floor_area,
            'building_closing_rates'        => $request->building_closing_rates,
            'GFA_sqm'                       => $request->GFA_sqm,
            'Floor_area_calculation_GFA'    => $request->Floor_area_calculation_GFA,
            'floor_area_ratio'              => $request->floor_area_ratio,
            'number_of_buildings'           => $request->number_of_buildings,
            'number_of_affiliate_buildings' => $request->number_of_affiliate_buildings,
            'park_lot'                      => $request->park_lot,
            'construction_expected_date'    => $request->construction_expected_date,
            'construction_delay_date'       => $request->construction_delay_date,
            'creating_date'                 => $request->creating_date,
            'note'                          => $request->note,
        ];

        DB::table('warehouse')
            ->where('id', $request->id)
            ->update(
                [
                'Serial_number'                 => $request->Serial_number,
                'Address'                       => $request->Address,
                'Kendall'                       => $request->Kendall,
                'Building'                      => $request->Building,
                'GFA_Py'                        => $request->GFA_Py,
                'const_permission'              => $request->const_permission,
                'build_start_date'              => $request->build_start_date,
                'completion_date'               => $request->completion_date,
                'Investor_landlord'             => $request->Investor_landlord,
                'AMC'                           => $request->AMC,
                'PM_LM'                         => $request->PM_LM,
                'DRY_COLD'                      => $request->DRY_COLD,
                'Latitude'                      => $request->Latitude,
                'Longitude'                     => $request->Longitude,
                'Land_code'                     => $request->Land_code,
                'district_code'                 => $request->district_code,
                'zone_code'                     => $request->zone_code,
                'area_code'                     => $request->area_code,
                'land_area_sqm'                 => $request->land_area_sqm,
                'floor_area'                    => $request->floor_area,
                'building_closing_rates'        => $request->building_closing_rates,
                'GFA_sqm'                       => $request->GFA_sqm,
                'Floor_area_calculation_GFA'    => $request->Floor_area_calculation_GFA,
                'floor_area_ratio'              => $request->floor_area_ratio,
                'number_of_buildings'           => $request->number_of_buildings,
                'number_of_affiliate_buildings' => $request->number_of_affiliate_buildings,
                'park_lot'                      => $request->park_lot,
                'construction_expected_date'    => $request->construction_expected_date,
                'construction_delay_date'       => $request->construction_delay_date,
                'creating_date'                 => $request->creating_date,
                'note'                          => $request->note,
                ]
            );
        return redirect()->route('excel.index');
    }

    public function allDelete() {

        DB::table('warehouse')->delete();
        return redirect()->route('excel.index');
    }

    public function delete(Request $request) {
        DB::table('warehouse')
            ->where('id', $request->id)
            ->delete();
        return redirect()->route('excel.index');
    }
}
