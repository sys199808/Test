@extends('layouts.home')
@section('title','瓜子首页')
@section('content')
<div class="index-header">
    <!-- header  s -->
    <input type="hidden" id="skipKindNew" value="0">
    <!--<input type="hidden" id="firstSubLogin" value="0">-->
    <input type="hidden" id="clueData" data-puid="" data-city-id="12">

    <div id="jstop" class="header-2">
        <div class="header">
            <h1>
                <a href="/bj/" title="瓜子二手车">瓜子二手车</a>
            </h1>

            <div class="city">
                <!-- 鼠标悬停 .city添加class名active -->
                <p class="city-curr">
                    北京<i></i>
                </p>
                <div class="white-line"></div>
                <!--        class:all-city的作用是局部滚动不影响整体滚动-->
                <div class="city-box all-city">
                    <dl class="bdb-n">
                        <dt class="green-tit">周边</dt>
                        <dd>
                            <a data-gzlog="tracking_type=click&amp;eventid=0020060000000018&amp;select_city=hengshui" baidu_alog="pc_index_city&amp;click&amp;pc_index_around_city_c" href="/hengshui/" title="衡水二手车">衡水</a><a data-gzlog="tracking_type=click&amp;eventid=0020060000000018&amp;select_city=langfang" baidu_alog="pc_index_city&amp;click&amp;pc_index_around_city_c" href="/langfang/" title="廊坊二手车">廊坊</a>
                        </dd>
                    </dl>
                    <dl class="bdb-s">
                        <dt class="green-tit">热门</dt>
                        <dd>
                            <a baidu_alog="pc_index_city&amp;click&amp;pc_index_quanguo_c" data-gzlog="tracking_type=click&amp;eventid=0020060000000021" href="/www/" title="全国二手车">全国</a>
                            <a baidu_alog="pc_index_city&amp;click&amp;pc_index_hot_city_c" data-gzlog="tracking_type=click&amp;eventid=0020060000000019&amp;select_city=bj" class="on" href="/bj/" title="北京二手车">北京</a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>A</dt>
                        <dd>
                            <a data-gzlog="tracking_type=click&amp;eventid=0020060000000017&amp;select_city=anqing" baidu_alog="pc_index_city&amp;click&amp;pc_index_all_city_c" href="/anqing/" title="安庆二手车">安庆</a>
                        </dd>
                    </dl>

                </div>
            </div>

            <div class="header-phone">
                <!--电话判断，当页面处于汽车金融则显示汽车金融电话  -->
                400-057-8600</div>

            <div class="uc js-uc js-uc-new" data-gzlog="tracking_type=click&amp;eventid=1015123400000003">
                <a href="javascript:" class="uc-my" id="js-login">登录</a>
                <div class="uc-app" style="display:none">
                    <a href="/bj/userstore" class="js-loginElem1" data-gzlog="tracking_type=click&amp;eventid=1015123400000004">收藏车辆</a>
                    <a href="/bj/userreduce" class="js-loginElem2" data-gzlog="tracking_type=click&amp;eventid=1015123400000005">降价提醒</a>
                    <a href="/bj/userhistory" class="js-loginElem3" data-gzlog="tracking_type=click&amp;eventid=1015123400000006">浏览记录</a>
                    <a href="javascript:;" class="js-logout js-loginElem4" data-gzlog="tracking_type=click&amp;eventid=1015123400000007">退出</a>
                    <i></i>
                </div>
            </div>

            <div class="nav-list">
                <a class="fl " href="/ask/" data-gzlog="tracking_type=click&amp;eventid=0010000000000012" title="瓜子问答">瓜子问答</a>
                <a class="fr " baidu_alog="pc_index_top_tab&amp;click&amp;pc_index_top_tab_carfina_c" href="http://jr.guazi.com/bj/?jr_from=homehead&amp;platform=pc" data-gzlog="tracking_type=click&amp;eventid=0010000000000011">瓜子金融</a>
                <a class="fl " baidu_alog="pc_index_top_tab&amp;click&amp;pc_index_top_tab_intro_c" href="/bj/intro/" data-gzlog="tracking_type=click&amp;eventid=0010000000000010">瓜子服务</a>
                <a class="fl " baidu_alog="pc_index_top_tab&amp;click&amp;pc_index_top_tab_sell_c" href="/bj/sell/?clueS=01" data-gzlog="tracking_type=click&amp;eventid=0010050000000009">我要卖车</a>
                <a class="fl " baidu_alog="pc_index_top_tab&amp;click&amp;pc_index_top_tab_buy_c" href="/bj/buy/" data-gzlog="tracking_type=click&amp;eventid=0010000000000008">我要买车</a>
                <a class="fl active" baidu_alog="pc_index_top_tab&amp;click&amp;pc_index_top_tab_index_c" href="/bj/" data-gzlog="tracking_type=click&amp;eventid=0010000000000007">首页</a>
            </div>
        </div>
    </div>


    <!-- 登录弹层  s -->
    <!-- 登录弹框  s -->
    <div class="pop-box pop-login" id="login1">
        <div class="pop-close" id="closeLogin1"></div>
        <p class="pop-tit js-logintitle">瓜子二手车直卖网</p>
        <ul class="phone-login">
            <li>
                <p class="phone-login-tit">手机号码</p>
                <input class="phone-login-input js-phoneNum1" placeholder="请输入您的手机号码">
            </li>
            <li>
                <p class="phone-login-tit"> 验证码</p>
                <input class="phone-login-input phone-login-code js-code1" placeholder="请输入验证码">
                <button class="get-code">获取验证码</button>
            </li>
        </ul>
        <p class="p-error" id="loginError1"></p>
        <button class="sub-btn js-checkcode">登录</button>
        <p class="free-phone">免费咨询400-057-8600</p>
    </div>

    <!-- 弹框蒙层  s -->
    <div class="pop-mask"></div>
    <!-- 弹框蒙层  e --><!-- 登录弹层  e -->

    <script>
        //公用头部登陆后跳转至个人中心时url中需要用到
        var domain = "bj";
        //意见反馈所需城市id
        var cityId = "12"</script>
    <!-- header  e -->

    <!-- 买车和卖车 s -->
    <div class="index-entry-buysell w1200">
        <!-- 买车 s -->
        <div class="entry-buycar fl">
            <div class="entry-title clearfix">
                <a href="/bj/buy/" class="fl" data-gzlog="tracking_type=click&amp;eventid=1010000000000021">我要买车<i class="icon-buysell"></i></a>

                <!-- input在focus状态下，最外层div添加class名active -->
                <div class="search js-search">
                    <div class="search-box suggestion_widget" data-default-count="9">
                        <input type="text" class="search-input js_search_input_index" placeholder="搜索您想要的车" data-role="keywordInput" name="keyword" autocomplete="off" data-domain="bj">
                        <button class="search-btn" data-gzlog="tracking_type=click&amp;eventid=0020070000000022"></button>
                        <input type="hidden" value="bj" name="hiddenCity">
                    </div>
                    <ul class="search-select" style="display: none;">
                        <li class="select-tit">热门推荐</li>
                        <li>大众</li>
                    </ul>
                </div>

            </div>
            <div class="buycar-brand clearfix">
                <a href="/bj/dazhong/" class="icon-dazhong" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=dazhong">大众</a>
                <a href="/bj/bmw/" class="icon-bmw" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=bmw">宝马</a>
                <a href="/bj/benz/" class="icon-benz" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=benz">奔驰</a>
                <a href="/bj/audi/" class="icon-audi" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=audi">奥迪</a>
                <a href="/bj/ford/" class="icon-ford" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=ford">福特</a>
                <a href="/bj/hyundai/" class="icon-hyundai" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=hyundai">现代</a>
                <a href="/bj/buick/" class="icon-buick" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=buick">别克</a>
                <a href="/bj/toyota/" class="icon-toyota" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=toyota">丰田</a>
                <a href="/bj/richan/" class="icon-richan" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=richan">日产</a>
                <a href="/bj/buy/?fromindex=true" class="icon-buycar-more" data-gzlog="tracking_type=click&amp;eventid=0050080000000024&amp;brand=more"><i class="icon-buysell"></i>更多</a>
            </div>
            <div class="buycar-price">
                <a href="/bj/buy/p11/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=11">3万以下</a>
                <a href="/bj/buy/p12/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=12">3-5万</a>
                <a href="/bj/buy/p13/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=13">5-7万</a>
                <a href="/bj/buy/p14/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=14">7-9万</a>
                <a href="/bj/buy/p15/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=15">9-12万</a>
                <a href="/bj/buy/p16/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=16">12-16万</a>
                <a href="/bj/buy/p17/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=17">16-20万</a>
                <a href="/bj/buy/p18/" data-gzlog="tracking_type=click&amp;eventid=0050100000000026&amp;price_index=18">20万以上</a>
            </div>
            <div class="buycar-price">
                <a href="/bj/buy/z16/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=z16">超值</a>
                <a href="/bj/buy/a3/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=a3">急售</a>
                <a href="/bj/buy/r8/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=r8">练手车</a>
                <a href="/bj/buy/c4/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=c4">准新车</a>
                <a href="/bj/buy/r18/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=r18">保卖车</a>
                <a href="/bj/buy/k6/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=k6">可迁全国</a>
                <a href="/bj/buy/h2/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=h2">SUV</a>
                <a href="/bj/buy/h3/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=h3">MPV</a>
                <a href="/bj/buy/h5/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=h5">两厢轿车</a>
                <a href="/bj/buy/h6/" data-gzlog="tracking_type=click&amp;eventid=0050110000000027&amp;chexing_index=h6">三厢轿车</a>
            </div>
        </div>
        <!-- 买车 e -->
        <!-- 卖车 s -->
        <div class="entry-sellcar fr">
            <div class="entry-title clearfix">
                <a href="/bj/sell/" class="fl" data-gzlog="tracking_type=click&amp;eventid=1010000000000022">我要卖车<i class="icon-buysell"></i></a>
            </div>
            <div class="sellcar-box">
                <div class="sellcar-show">
                    <p class="amount">已有<span>13311038</span>人提交申请</p>
                    <p class="average">平均<span>7天</span>卖出</p>
                </div>
                <!-- 文本框输入错误时加active -->
                <div class="sellcar-phone">
                    <input class="phone-input js-phone-input js-phone1" maxlength="11" placeholder="请输入您的手机号">
                    <p class="phone-error js-phone-error"></p>
                    <button class="phone-btn-sell js-phone-btn" position="4" data-clue-entry="03" data-evenid="0210050000000013" data-gzlog="tracking_type=click&amp;eventid=0210050000000013">我要卖车</button>
                    <button class="phone-btn-eval js-subAssess" data-gzlog="tracking_type=click&amp;eventid=1010000000000012">免费估价</button>
                </div>
            </div>
        </div>
        <!-- 卖车 e -->
    </div>    <!-- 买车和卖车 e -->
</div>
@endsection