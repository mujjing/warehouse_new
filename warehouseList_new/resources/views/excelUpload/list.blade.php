<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upload.css" />
    <title>창고 데이터 업로드</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    tr th {
        text-align:center;
    }
    </style>
</head>

<body>
<div id="navbar">
<ul id="navbar">
    <li><a href="{{ route('map.index') }}">지도화면으로</a></li>
</ul>
</div>
    <div class="container">
        <h3 align="center">엑셀 업로드 화면</h3>
        <br />
        @if(count($errors)>0)
        <div class="alert alert-danger">
            업로드 에러<br><br>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
        @endif
        <form method="post" action="{{route('excel.upload')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <p style="text-align:center;font-size:25px;"><b>업로드 할 파일 선택<b></p>
                <table class="table">
                    <tr>
                        <td width="40%" align="right"></td>
                        <td width="30%">
                            <input type="file" name="file">
                        </td>
                        <td width="30%" align="left">
                            <button type="submit" class="btn btn-primary">업로드</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" align="right"></td>
                        <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                        <td width="30%" align="left">
                        <form method="post" action="{{route('excel.all_delete')}}" enctype="multipart/form-data" name="deleteList">
                            @csrf
                            <input type="button" class="btn btn-danger" onclick="button_event();" value="전체삭제"></input>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        <br />
        <div class="panel panel-defalut">
            <div class="panel-heading">
                <h3 class="panel-title">창고 관리 대장 데이터</h3><br>
                <p>데이터 건 수: {{ $data->count()}} / {{ $data->total() }}</p>
            </div>
            <ul>
                    {{ $data->appends(request()->input())->links() }}
                </ul>
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
                            <th>const_permission</th>
                            <th>build_start_date</th>
                            <th>completion_date</th>
                            <th>Investor_landlord</th>
                            <th>AMC</th>
                            <th>PM_LM</th>
                            <th>DRY_COLD</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Land_code</th>
                            <th>district_code</th>
                            <th>zone_code</th>
                            <th>area_code</th>
                            <th>land_area_sqm</th>
                            <th>floor_area</th>
                            <th>building_closing_rates</th>
                            <th>GFA_sqm</th>
                            <th>Floor_area_calculation_GFA</th>
                            <th>floor_area_ratio</th>
                            <th>number_of_buildings</th>
                            <th>number_of_affiliate_buildings</th>
                            <th>park_lot</th>
                            <th>construction_expected_date</th>
                            <th>construction_delay_date</th>
                            <th>creating_date</th>
                            <th>note</th>
                            <th>update</th>
                            <th>delete</th>
                        </tr>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->Serial_number}}</td>
                                <td>{{$row->Address}}</td>
                                <td>{{$row->Kendall}}</td>
                                <td>{{$row->Building}}</td>
                                <td>{{$row->GFA_Py}}</td>
                                <td>{{$row->const_permission}}</td>
                                <td>{{$row->build_start_date}}</td>
                                <td>{{$row->completion_date}}</td>
                                <td>{{$row->Investor_landlord}}</td>
                                <td>{{$row->AMC}}</td>
                                <td>{{$row->PM_LM}}</td>
                                <td>{{$row->DRY_COLD}}</td>
                                <td>{{$row->Latitude}}</td>
                                <td>{{$row->Longitude}}</td>
                                <td>{{$row->Land_code}}</td>
                                <td>{{$row->district_code}}</td>
                                <td>{{$row->zone_code}}</td>
                                <td>{{$row->area_code}}</td>
                                <td>{{$row->land_area_sqm}}</td>
                                <td>{{$row->floor_area}}</td>
                                <td>{{$row->building_closing_rates}}</td>
                                <td>{{$row->GFA_sqm}}</td>
                                <td>{{$row->Floor_area_calculation_GFA}}</td>
                                <td>{{$row->floor_area_ratio}}</td>
                                <td>{{$row->number_of_buildings}}</td>
                                <td>{{$row->number_of_affiliate_buildings}}</td>
                                <td>{{$row->park_lot}}</td>
                                <td>{{$row->construction_expected_date}}</td>
                                <td>{{$row->construction_delay_date}}</td>
                                <td>{{$row->creating_date}}</td>
                                <td>{{$row->note}}</td>
                                <!-- <td><a href="/execelUpload/update/{{ $row->id }}">데이터 수정</a></td> -->
                                <td><button type="button" class="btn btn-primary" onclick="location.href='/execelUpload/update/{{ $row->id }}'">데이터 수정</button></td>
                                <form method="post" action="{{route('excel.delete')}}" enctype="multipart/form-data" name="deleteParts">
                                @csrf
                                <input type="hidden" name="id" value="{{ $row->id }}">
                                <td><button type="submit" class="btn btn-danger" onclick="button_deleteParts_event();">데이터 삭제</button></td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
</body>
<script type="text/javascript">
        function button_event(){
            if (confirm("전체 데이터를 삭제하시겠습니까??") == true){ 
                document.deleteList.submit();
            }else{
                return;
            }
        }
    </script>
</html>

