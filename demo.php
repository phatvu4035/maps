<?php
    $result_count = 3;
    $data_source_list = "[['20000200', '', '21.042455', '105.824538'], ['20000201', '', '21.042590', '105.824752'], ['20000202', '', '21.042919', '105.824979'], ['20000203', '', '21.064406', '105.830914'], ['20000204', '', '21.064508', '105.834458'], ['20000203', '', '21.066222', '105.836829'], ['20000203', '', '21.067934', '105.836561']]";
    if(!empty($_POST)) {

    }
    if(!empty($_POST['rent_price_1'])) {
        $data_source_list = "[['20000200', '', '21.042455', '105.824538']]";
    }

    if(!empty($_POST['rent_price_2'])) {
        $data_source_list = "[['20000200', '', '21.042455', '105.824538'], ['20000203', '', '21.067934', '105.836561']]";
    }

    if(!empty($_POST['yearago'])) {

        $data_source_list = "[['20000201', '', '21.042590', '105.824752'], ['20000202', '', '21.042919', '105.824979']]";
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>茨城県つくば・土浦の賃貸物件を地図から検索｜上総屋不動産</title>
    <meta name="keywords" content='地図検索,賃貸マンション,賃貸アパート,テナント,茨城県,つくば,土浦,賃貸,賃貸情報,住宅,住まい,上総屋,かずさや'/>
    <meta name="description"
          content='茨城県つくば・土浦の賃貸物件を地図から探す｜【上総屋不動産】茨城県つくば・土浦エリアで賃貸物件（アパート・賃貸マンション他）を借りるなら地域密着の上総屋不動産へ。茨城県内の物件情報からさまざまな条件を指定して豊富な賃貸物件情報からあなたにピッタリの住まい情報を見つけてください。'/>
    <script src="site_conf_js.php" type="text/javascript"></script>

    <!--------------------------->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-------------------------->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/hover-min.css">


    <link rel="stylesheet" href="assets/css/dotcom.css">
    <link rel="stylesheet" href="assets/css/dotcom_style.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina|Fjalla+One" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-------------------------->
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=vn&region=jp&key=AIzaSyAp74vTnoq1evX8zDSTFnvvRt6s4FgO6V8"></script>

    <script src="assets/js/markerclusterer.js"></script>
    <script src="assets/js/jquery.geocomplete.js"></script>
    <script src="assets/js/pvlib_addFavorite.js"></script>

    <script type="text/javascript">
        const CFG_ICON_PATH = 'http://localhost/maps-api/assets/images/icons';
        var j$ = jQuery;

        //map表示変数定義
        var map;
        var mapOptions;
        var infoWindow;
        var buildLatlng;

        var g_nelat = 0;
        var g_nelng = 0;
        var g_swlat = 0;
        var g_swlng = 0;
        var g_clat = 0;
        var g_clng = 0;
        var g_z = 0;

        var mapZoom;
        var centerPos;
        var marker_clck_flg = 0;
        var marker_clck_obj = null;
        var marker_clck_brb_id = null;


        var mcs = []; // MarkerClusterer用配列

        var data_source_lst = <?php echo $data_source_list; ?>;
        //  data_source_lst[x][0] : bukken_room_build_id
        //  data_source_lst[x][1] : bukken_build_name
        //  data_source_lst[x][2] : bukken_build_latitude
        //  data_source_lst[x][3] : bukken_build_longitude
        var marker = new Array();


        //mapZoom
        if (g_z == 0) {
            mapZoom = 14;
        } else {
            mapZoom = g_z;
        }

        //centerPos
        if (g_clat == 0 && g_clng == 0) {
            centerPos = new google.maps.LatLng(21.042410, 105.824301);
        } else {
            centerPos = new google.maps.LatLng(g_clat, g_clng);
        }

        //Googlemap初期化（関数initializeMapは本HTML内に定義）
        j$(function () {
            initializeMap();
        });


        function initializeMap() {

            mapOptions = {
                map: '.map_canvas',
                componentRestrictions: {country: 'vn'},
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            //geocomplete: Google住所オート入力のための指定
            $('#geocomplete').geocomplete(mapOptions);

            $('#find').click(function () {
                $('#geocomplete').trigger('geocode');
            });

            map = $('#geocomplete').geocomplete('map');
            map.setCenter(centerPos);
            map.setZoom(mapZoom);


            //マーカー作成、詳細表示定義 -------------------
            for (i = 0; i < data_source_lst.length; i++) {

                var data_val1 = data_source_lst[i][0]; //build_id
                //var data_val2      = data_source_lst[i][1]; //build_name
                var data_latitude = data_source_lst[i][2];
                var data_longitude = data_source_lst[i][3];

                //check param
                if (!(data_latitude != '' && data_longitude != '')) {
                    continue;
                }


                buildLatlng = new google.maps.LatLng(data_latitude, data_longitude);
                //アイコン設定
                var icon = new google.maps.MarkerImage(CFG_URL_COMN + 'assets/images/icons/house9_google.png',
                    new google.maps.Size(55, 32)  //アイコンサイズ設定
                );
                //マーカー定義
                marker[i] = new google.maps.Marker({
                    position: buildLatlng,
                    map: map,
                    icon: icon,
                    //title: data_val2,
                    brb_id: data_val1
                });

                //for markercluster
                mcs.push(marker[i]);

                //maker click proc ----
                google.maps.event.addListener(marker[i], 'click', function () {

                    //flag on
                    marker_clck_flg = 1;
                    marker_clck_obj = this;
                    marker_clck_brb_id = marker_clck_obj.brb_id;


                    if (infoWindow) infoWindow.close();

                    var api_url = CFG_URL_COMN + 'get_info.php/' + "?cbcm=bukken_room&brb_id=" + marker_clck_brb_id + "&vmd=t";
                    $.get(api_url, function (data, status, xhr) {
                        if (status == "success") {
                            //disp info window
                            infoWindow = new google.maps.InfoWindow({
                                content: data
                            });
                            infoWindow.open(map, marker_clck_obj);
                        }
                    });

                });

            }

            // markerclusterのオプション
            var mcOptions = {
                gridSize: 50,
                maxZoom: 14,
                imagePath: CFG_ICON_PATH + '/m'
            };

            //markerclusterを表示
            var markerCluster = new MarkerClusterer(map, mcs, mcOptions);


            //-----------------------------------
            google.maps.event.addListener(map, 'dragend', function () {
                //flag off
                marker_clck_flg = 0;
            })
            google.maps.event.addListener(map, 'zoom_changed', function () {
                //flag off
                marker_clck_flg = 0;
            })

            google.maps.event.addListener(map, 'idle', function () {
                //地図のズーム値や角度を変更した際、動きが終わって操作を受け付ける状態(アイドル状態)になったタイミングで発生

                //check flag
                if (marker_clck_flg == 1) {	//地図上のマーカークリック時にはリダイレクト処理を避ける
                    return;
                }
                //set point
                setPointMarker();
            })
        }


        //-----------------------------------
        //価格検索実行
        function fcSearchYachin() {
            //search flag on
            //	document.form_srchbox2.form_srch_flg.value='1';
            //set point
            setPointMarker();
        }

        //間取検索実行
        function fcSearchMadori() {
            //search flag on
            //	document.form_srchbox2.form_srch_flg.value='1';
            //set point
            setPointMarker();
        }

        function fcSearchChikuDatei() {
            //search flag on
            //	document.form_srchbox2.form_srch_flg.value='1';
            //set point
            setPointMarker();
        }

        function fcSearchBuildKindi() {
            //search flag on
            //	document.form_srchbox2.form_srch_flg.value='1';
            //set point
            setPointMarker();
        }

        //------------------------------------------------------
        // 表示地図範囲、検索キーによりURLを作成、リダイレクト
        //------------------------------------------------------
        function setPointMarker() {

            //地図の範囲内を取得
            var bounds = map.getBounds();
            var map_nelat = bounds.getNorthEast().lat();
            var map_swlat = bounds.getSouthWest().lat();
            var map_nelng = bounds.getNorthEast().lng();
            var map_swlng = bounds.getSouthWest().lng();
            var map_clat = bounds.getCenter().lat();
            var map_clng = bounds.getCenter().lng();
            var map_zoom = map.getZoom();

            //検索キーワードを取得
            var sch_yachin1 = document.form_srchbox2.search_yachin1.value;
            var sch_yachin2 = document.form_srchbox2.search_yachin2.value;
            var sch_madori = document.form_srchbox2.search_madori.value;
            var form_srch_flg = document.form_srchbox2.form_srch_flg.value;
            var sch_chiku_dt = document.form_srchbox2.search_chiku_date.value;
            var sch_bld_kind = document.form_srchbox2.search_build_kind.value;

            if (form_srch_flg == '1') {
                //検索キー欄での検索ボタン押下時のみ処理させたい
                if (sch_yachin1 != "" || sch_yachin2 != "" || sch_madori != "" || sch_chiku_dt != "" || sch_bld_kind != "") {
                    location.href = "https://www.kazusaya.co.jp/chintai/map_search/?nelat=" + map_nelat + "&nelng=" + map_nelng + "&swlat=" + map_swlat + "&swlng=" + map_swlng + "&clat=" + map_clat + "&clng=" + map_clng + "&z=" + map_zoom + "&y1=" + sch_yachin1 + "&y2=" + sch_yachin2 + "&md=" + sch_madori + "&cd=" + sch_chiku_dt + "&bk=" + sch_bld_kind;
                }
            } else {
                if (map_nelat != 0 && map_swlat != 0 && map_nelng != 0 && map_swlng != 0) {
                    location.href = "https://www.kazusaya.co.jp/chintai/map_search/?nelat=" + map_nelat + "&nelng=" + map_nelng + "&swlat=" + map_swlat + "&swlng=" + map_swlng + "&clat=" + map_clat + "&clng=" + map_clng + "&z=" + map_zoom + "&y1=" + sch_yachin1 + "&y2=" + sch_yachin2 + "&md=" + sch_madori + "&cd=" + sch_chiku_dt + "&bk=" + sch_bld_kind;
                }
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            hsize = $(window).height();
            var windowSize = $(window).width();
            var mobileSize = 768;
            var adjustSize = 1;

            if (windowSize <= mobileSize) {
                adjustSize = 0.6;
            }
            $("div.map_canvas").css("height", hsize * adjustSize + "px");
        });

    </script>
</head>
<body class="theme-search-map">
<!--::::::::::::::::::::: PANKUZU ::::::::::::::::::::::::-->
<section class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__list-item"><a href="https://www.kazusaya.co.jp/">上総屋不動産</a></li>
        <li class="breadcrumbs__list-item"><a href="https://www.kazusaya.co.jp/chintai/">茨城 賃貸</a></li>
        <li class="breadcrumbs__list-item">賃貸物件を地図から探す</li>
    </ul>
</section><!-- /.breadcrumbs -->
<div class="sub-heading">
    <h2 class="heading-title">Map Search</h2>
    <p class="sub-heading__read">地図で探す</p>
</div><!-- /.sub-heading -->
<!--■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ MAIN -->
<h2 class="col-md-12 mt20 font_s80">
    賃料3万円以上の<span>賃貸物件一覧</span></h2>
<section class="search-map">
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-sm-8 col-sm-push-4">
                <div class="search-map-google">
                    <div class="map_canvas"></div>
                </div>
            </div>
            <div class="col-sm-4 col-sm-pull-8">
                <div class="search-map-sub-menu">


                    <form name="form_srchbox" action="./demo.php" method="POST">
                        <input type="hidden" name="form_srch_flg_mobile" value="">
                        <h3 class="search-map-sub-menu__title">絞り込み条件</h3>
                        <p class="search-map-sub-menu__sub-title">家賃</p>
                        <input type="hidden" name="form_srch_flg_mobile" value="">
                        <ul class="search-map-sub-menu__list-select-primary">
                            <li>
                                <div class="search-map-sub-menu__select-text">
                                    <select class="form-map_price" name="rent_price_1" id="search6">
                                        <option value="30000" selected="selected">30000円</option>
                                        <option value="">--下限なし--</option>
                                        <option value="20000">20000円</option>
                                        <option value="30000">30000円</option>
                                        <option value="40000">40000円</option>
                                        <option value="50000">50000円</option>
                                        <option value="60000">60000円</option>
                                        <option value="70000">70000円</option>
                                        <option value="80000">80000円</option>
                                        <option value="90000">90000円</option>
                                        <option value="100000">100000円</option>
                                    </select>

                                </div>
                            </li>
                            <li>
                                <div class="search-map-sub-menu__select-text">

                                    <select class="form-map_price find" name="rent_price_2" id="search7">
                                        <option value="">--上限なし--</option>
                                        <option value="20000">20000円</option>
                                        <option value="30000">30000円</option>
                                        <option value="40000">40000円</option>
                                        <option value="50000">50000円</option>
                                        <option value="60000">60000円</option>
                                        <option value="70000">70000円</option>
                                        <option value="80000">80000円</option>
                                        <option value="90000">90000円</option>
                                        <option value="100000">100000円</option>
                                    </select>

                                </div>
                            </li>
                        </ul>
                        <li style="display:none"><p>
                            </p></li>

                        <p class="search-map-sub-menu__sub-title">築年数</p>
                        <ul class="search-map-sub-menu__list-select">
                            <li>
                                <div class="search-map-sub-menu__select-text">
                                    <select name="yearago">
                                        <option value="">指定なし</option>
                                        <option value="1">新築</option>
                                        <option value="5">5年以内</option>
                                        <option value="10">10年以内</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <p class="search-map-sub-menu__sub-title">物件種別</p>
                        <ul class="search-map-sub-menu__list-btn">
                            <li><p>
                                    <input type="radio" id="chkbox2-1" name="search2" value="1000">
                                    <label for="chkbox2-1"><u>賃貸マンション</u></label>
                                </p></li>
                            <li><p>
                                    <input type="radio" id="chkbox2-2" name="search2" value="2000">
                                    <label for="chkbox2-2"><u>賃貸アパート</u></label>
                                </p></li>
                            <li><p>
                                    <input type="radio" id="chkbox2-7" name="search2" value="7000">
                                    <label for="chkbox2-7"><u>一戸建て</u></label>
                                </p></li>
                            <li><p>
                                    <input type="radio" id="chkbox2-9" name="search2" value="9000">
                                    <label for="chkbox2-9"><u>事務所向テナント</u></label>
                                </p></li>
                            <li><p>
                                    <input type="radio" id="chkbox2-10" name="search2" value="10000">
                                    <label for="chkbox2-10"><u>店舗向テナント</u></label>
                                </p></li>

                        </ul>

                    </form>
                    <script type="text/javascript">
                        $("form[name='form_srchbox']").on("change", "input, select", function (event) {
                            $("form[name='form_srchbox']").submit();
                        });
                        $("input.").on("change", "input, select", function (event) {
                            $("form[name='form_srchbox']").submit();
                        });
                    </script>


                </div>
            </div>


        </div>
    </div>
</section><!-- /.search-map -->

<div class="search-conditions-table__show">
    <ul class="row">
        <li class="col-md-4 col-sm-4 rent-tenant-office-list__show-text">該当物件<span><?php echo $result_count; ?></span>件</li>
    </ul>
</div>

<input class="form-control" type="hidden" id="geocomplete" name="search1" placeholder="住所を入力">
</body>
</html>