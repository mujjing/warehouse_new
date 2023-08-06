<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>창고 데이터 맵</title>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=yke4ep29oq"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=a2983cac9e05da981b490412dd6c9dd5&libraries=services"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"> </script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/map.css">
    <link rel="stylesheet" type="text/css" href="../css/sidbar-animate.css">
</head>
@inject('SearchConst', 'App\Consts\SearchConst')
<body>
<div id="mobile_navbar">
        <ul id="mobile_navbar">
            <li><a href="/"><img src="../images/ESR.png" alt="로고" style="width:130px;height:20px;"></a></li>
            <li style="float: right;"><a class="search" href="/mobile_search">검색</a></li>
        </ul>
    </div>
    <div class="sidebar">
    <header>
        <img src="../images/ESR.png" alt="로고">
    </header>
        <ul>
            <li class="upload"><a class="active" href="/execelUpload">데이터 업로드</a></li>
        </ul>
            <br>
            <form action="{{ route('search') }}" name="form" method="POST">
            @csrf
                <div class="selected" style="margin-left:10px;">
                    <select name="search_list" class= "selected-tag" id="selected_tag">
                        @foreach ($SearchConst::searchList as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select> 
                    <input type="text" name="search" value= "{{ old('search') }}" style="width: 240px;text-align:left;">  
                    <button button type="submit" class="btn btn-primary" style="width:70px;"> 검색 </button>
                </div>
            </form>
    </div>

<section>
 
</section>

<!-- <ul id="navbar">
<li><a href="{{ route('map.list') }}">창고 데이터 </a></li>
<li style="float: right;"><a class="active" href="/execelUpload">Upload</a></li>
</ul> -->
<div class="map" id="map" style="width:100%;height:100vh;"></div>
<script type="text/javascript" src="/js/MarkerClustering.js"></script>
<script type="text/javascript" src="/js/main.js"></script>

<script>

var mapOptions = {
    center: new naver.maps.LatLng(37.3595704, 127.105399),
    zoom: 10
};

var map = new naver.maps.Map('map', mapOptions);
const data = @json($data);


    let markerList = [];
    let infowindowList = [];
    const getClickHandler = (i) => () => {
    const marker = markerList[i];
    const infowindow = infowindowList[i];
    if (infowindow.getMap()) {
        infowindow.close();
    } else {
        infowindow.open(map, marker);
    }
};

const getClickMap = (i) => () => {
    const infowindow = infowindowList[i];
    infowindow.close();
};

for (let i in data) {
    const target = data[i];
    const latlng = new naver.maps.LatLng(target.Latitude, target.Longitude);
    var target_icon;
    if (target.completion_date == null || target.completion_date == 0) {
        target_icon = `<div class="marker20thou"><img src="{{ asset('images/preparing.png') }}" class="overTheTwenty"></div>`;
    } else {
        if (target.Kendall != null) {
        target_icon = `<div class="marker20thou"><img src="{{ asset('images/red.png') }}" class="overTheTwenty"></div>`;
    } else if (target.Kendall == null) {
        if(target.GFA_Py >= 20000) {
            target_icon = `<div class="marker20thou"><img src="{{ asset('images/overTheTwenty.png') }}" class="overTheTwenty"></div>`;
        }else if (target.GFA_Py >= 10000 && target.GFA_Py < 20000) {
            target_icon = `<div class="marker10to20thou"><img src="{{ asset('images/tenToTwenty.png') }}" class="tenToTwenty"></div>`;
        }else if (target.GFA_Py >= 5000 && target.GFA_Py < 10000) {
            target_icon = `<div class="marker5to10thou"><img src="{{ asset('images/fiveToTen.png') }}" class="fiveToTen"></div>`;
        }else if (target.GFA_Py >= 3000 && target.GFA_Py < 5000) {
            target_icon = `<div class="marker3to5thou"><img src="{{ asset('images/threeToFive.png') }}" class="threeToFive"></div>`;
        }
    }
    }

    let maker = new naver.maps.Marker({
        map: map,
        position: latlng,
        icon: {
            content: target_icon,
            anchor: new naver.maps.Point(7.5, 7.5),
        },
    });

    var target_id = target.id

    var content = `<a href="detail_info/${ target_id }" style= 'text-decoration-line: none';><div class= "infowindow_wrap">
    <div class= "infowindow_title" style= 'color: black';> 「${target.Building == null ? "-" : target.Building}」 </div> 
    <div class= "infowindow_address" style= 'color: black';> 관리_허가대장_PK : ${target.Serial_number == null ? "-" : target.Serial_number} </div>
    <div class= "infowindow_address" style= 'color: black';> 대지_위치       : ${target.Address == null ? "-" : target.Address} </div>
    <div class= "infowindow_address" style= 'color: black';> 켄달여부        : ${target.Kendall == null ? "-" : target.Kendall} </div>
    <div class= "infowindow_address" style= 'color: black';> 연면적(평)      : ${target.GFA_Py == null ? "-" : target.GFA_Py} </div>
    <div class= "infowindow_address" style= 'color: black';> 건축허가월       : ${target.const_permission == null ? "-" : target.const_permission} </div>
    <div class= "infowindow_address" style= 'color: black';> 착공           : ${target.build_start_date == null ? "-" : target.build_start_date} </div>
    <div class= "infowindow_address" style= 'color: black';> 사용승인월       : ${target.completion_date == null ? "-" : target.completion_date} </div>
    <div class= "infowindow_address" style= 'color: black';> 투자자/소유주     : ${target.Investor_landlord == null ? "-" : target.Investor_landlord} </div>
    <div class= "infowindow_address" style= 'color: black';> 자산운용사       : ${target.AMC == null ? "-" : target.AMC} </div>
    <div class= "infowindow_address" style= 'color: black';> PM_LM         : ${target.PM_LM == null ? "-" : target.PM_LM} </div>
    <div class= "infowindow_address" style= 'color: black';> DRY_COLD      : ${target.DRY_COLD == null ? "-" : target.DRY_COLD} </div>
    <div class= "infowindow_address" style= 'color: black';> 위도           : ${target.Latitude == null ? "-" : target.Latitude} </div>
    <div class= "infowindow_address" style= 'color: black';> 경도           : ${target.Longitude == null ? "-" : target.Longitude} </div>
    </div></a>`;
    const infowindow = new naver.maps.InfoWindow({
        content : content,
        backgroundColor : "#00ff0000",
        borderColor : "#00ff0000",
        anchorSize: new naver.maps.Size(50.0, 50.0),
    });

    markerList.push(maker);
    infowindowList.push(infowindow);
}

for (let i = 0, ii= markerList.length; i < ii; i++) {
    naver.maps.Event.addListener(markerList[i], "click", getClickHandler(i));
    naver.maps.Event.addListener(map, "click", getClickMap(i));
}

const cluster1 = {
    content: `<div class= "cluster1"></div>`,
};
const cluster2 = {
    content: `<div class= "cluster2"></div>`,
};
const cluster3 = {
    content: `<div class= "cluster3"></div>`,
};

const markerClustering = new MarkerClustering({
    minClusterSize : 2,
    maxZoom: 12,
    map : map,
    markers : markerList,
    disableClickZoom : false,
    gridSize : 20,
    icons : [cluster1, cluster2, cluster3],
    indexGernerator : [2, 5, 11],
    stylingFunction: (clusterMarker, count)=> {
        $(clusterMarker.getElement()).find("div:first-child").text(count);
    },
});
</script>

</body>
</html>