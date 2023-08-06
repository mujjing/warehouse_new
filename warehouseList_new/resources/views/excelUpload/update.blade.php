<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/upload.css" />
    <title>창고 데이터 업데이트</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div id="navbar">
<ul id="navbar">
        <li><a href="{{ route('map.index') }}">지도화면으로</a></li>
        <li style="float: right;"><a class="active" href="/execelUpload">엑셀 데이터 화면</a></li>
      </ul>
      </div>
    <div class="container">
        <h3 align="center">엑셀 업데이트 화면</h3>
        <br />
        <form method="post" action="{{route('excel.update')}}" enctype="multipart/form-data">
            @csrf
        <br />
        <div class="panel panel-defalut">
            <div class="panel-heading">
                <h3 class="panel-title">창고 관리 대장 데이터</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>id</th>
                            <th>Serial_number</th>
                            <th>Address</th>
                            <th>Kendall</th>
                            <th>Building</th>
                            <th>GFA_Py</th>
                        </tr>
                            <tr>
                                <td>{{$data->id}}</td>
                                <input type="hidden" class="form-control" name="id" value= "{{ $data->id }}" />
                                <td><input type="text" class="form-control" name="Serial_number" value= "{{ $data->Serial_number }}" style="width: 150px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Address" value= "{{ $data->Address }}" style="width: 300px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Kendall" value= "{{ $data->Kendall }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Building" value= "{{ $data->Building }}" style="width: 200px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="GFA_Py" value= "{{ $data->GFA_Py }}" style="width: 140px;text-align:left;" /></td>
                            </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>const_permission</th>
                            <th>build_start_date</th>
                            <th>completion_date</th>
                            <th>Investor_landlord</th>
                            <th>AMC</th>
                        </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="const_permission" value= "{{ $data->const_permission }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="build_start_date" value= "{{ $data->build_start_date }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="completion_date" value= "{{ $data->completion_date }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Investor_landlord" value= "{{ $data->Investor_landlord }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="AMC" value= "{{ $data->AMC }}" style="width: 140px;text-align:left;" /></td>

                            </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>PM</th>
                            <th>LM</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Land_code</th>
                        </tr>
                            <tr>
                            <td><input type="text" class="form-control" name="PM" value= "{{ $data->PM }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="LM" value= "{{ $data->LM }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Latitude" value= "{{ $data->Latitude }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Longitude" value= "{{ $data->Longitude }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Land_code" value= "{{ $data->Land_code }}" style="width: 140px;text-align:left;" /></td>

                            </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                        <th>district_code</th>
                            <th>zone_code</th>
                            <th>area_code</th>
                            <th>land_area_sqm</th>
                            <th>floor_area</th>
                        </tr>
                            <tr>
                            <td><input type="text" class="form-control" name="district_code" value= "{{ $data->district_code }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="zone_code" value= "{{ $data->zone_code }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="area_code" value= "{{ $data->area_code }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="land_area_sqm" value= "{{ $data->land_area_sqm }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="floor_area" value= "{{ $data->floor_area }}" style="width: 140px;text-align:left;" /></td>
                            </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                        <th>building_closing_rates</th>
                            <th>GFA_sqm</th>
                            <th>Floor_area_calculation_GFA</th>
                            <th>floor_area_ratio</th>
                            <th>number_of_buildings</th>
                        </tr>
                            <tr>
                            <td><input type="text" class="form-control" name="building_closing_rates" value= "{{ $data->building_closing_rates }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="GFA_sqm" value= "{{ $data->GFA_sqm }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="Floor_area_calculation_GFA" value= "{{ $data->Floor_area_calculation_GFA }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="floor_area_ratio" value= "{{ $data->floor_area_ratio }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="number_of_buildings" value= "{{ $data->number_of_buildings }}" style="width: 140px;text-align:left;" /></td>
                            </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                        <th>number_of_affiliate_buildings</th>
                            <th>park_lot</th>
                            <th>construction_expected_date</th>
                            <th>construction_delay_date</th>
                            <th>creating_date</th>
                        </tr>
                            <tr>
                            <td><input type="text" class="form-control" name="number_of_affiliate_buildings" value= "{{ $data->number_of_affiliate_buildings }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="park_lot" value= "{{ $data->park_lot }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="construction_expected_date" value= "{{ $data->construction_expected_date }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="construction_delay_date" value= "{{ $data->construction_delay_date }}" style="width: 140px;text-align:left;" /></td>
                                <td><input type="text" class="form-control" name="creating_date" value= "{{ $data->creating_date }}" style="width: 140px;text-align:left;" /></td>
                            </tr>
                    </table>

                    <table class="table">
                    <tr>
                        <td width="80%" align="center">
                        <button type="submit" class="btn btn-primary" width= "100%">업데이트</button>
                        <a onclick="goBack()" class="btn btn-danger">취소</a>
                        </td>
                    </tr>       
                    </form>
                </table>
                </div>
            </div>
        </div>
</body>
<script>
function goBack() {
  window.history.back();
}
</script>
</html>