@extends('layouts.app')
@section('content')

<html lang="es">

<head>
    <title>Bookflix</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" value="notranslate">
    <meta http-equiv="origin-trial" data-feature="Mute in Picture-in-Picture window" data-expires="2019-05-21"
        content="AlTswX7XZLgX4u/FK+tnvgmPsG33QKw859iCSrQXz+AJQ5MnpfL9suF1/Z5WeGFgSvYHbLQ8zYI/hMOIv7K4MQMAAABieyJvcmlnaW4iOiJodHRwczovL25ldGZsaXguY29tOjQ0MyIsImZlYXR1cmUiOiJNdXRlQnV0dG9uIiwiZXhwaXJ5IjoxNTU5MDg3OTk5LCJpc1N1YmRvbWFpbiI6dHJ1ZX0=">
    <link type="text/css" rel="stylesheet"
        href="https://codex.nflxext.com/%5E3.0.0/truthBundle/webui/0.0.1-shakti-css-v1b8c742f/css/css/less%7Ccore%7Cerror-page.less/1/0DvL3ru9CIK/none/true/none">
    <link type="text/css" rel="stylesheet"
        href="https://codex.nflxext.com/%5E3.0.0/truthBundle/webui/0.0.1-shakti-css-v1b8c742f/css/css/less%7Cpages%7CakiraClient.less/1/0DvL3ru9CIK/none/true/none">

</head>

<body style="">
    <div id="appMountPoint">
        <div class="netflix-sans-font-loaded">
            <div dir="ltr" class="">
                <div>
                    <div class="bd dark-background" lang="es-AR" data-uia="container-adult">
                        
                        <div class="mainView" role="main">
                            <div class="gallery row-with-x-columns">
                                <div></div>
                                <div class="galleryContent">
                                    <div>
                                        <div class="galleryLockups">
                                            <div class="rowContainer rowContainer_title_card" id="row-0">
                                                <div class="ptrack-container">
                                                    <div class="rowContent slider-hover-trigger-layer">
                                                        <div class="slider">
                                                            <div class="sliderMask showPeek">
                                                                <div class="sliderContent row-with-x-columns"
                                                                    style="-webkit-transform: ;-ms-transform: ;transform: ">
                                                                    <div class="slider-item slider-item-0">
                                                                        <div class="title-card-container">
                                                                            <div id="title-card-0-0"
                                                                                class="slider-refocus title-card"
                                                                                style="">
                                                                                <div class="ptrack-content"
                                                                                    data-ui-tracking-context="%7B%22list_id%22:%22unknown%22,%22location%22:%22browseTitles%22,%22rank%22:0,%22request_id%22:%221be953f0-97a8-4c21-8641-91f247f27cdc-24613852%22,%22row%22:0,%22track_id%22:1,%22video_id%22:70028883,%22image_key%22:%22sdp%7C00e92cd1-5f82-11ea-a25f-0a79fb844809%7Ces%7Cmpr%22,%22supp_video_id%22:1,%22lolomo_id%22:%22unknown%22,%22maturityMisMatchEdgy%22:false,%22maturityMisMatchNonEdgy%22:false,%22appView%22:%22boxArt%22,%22usePresentedEvent%22:true%7D"
                                                                                    data-tracking-uuid="06822a5d-aa63-46e2-a1c2-4119c7d50cbb">
                                                                                    <a href="/watch/70028883?tctx=0%2C0%2C%2C%2C%2C"
                                                                                        role="link"
                                                                                        aria-label="El increíble castillo vagabundo"
                                                                                        tabindex="0" aria-hidden="false"
                                                                                        class="slider-refocus">
                                                                                        <div
                                                                                            class="boxart-size-16x9 boxart-container">
                                                                                            <img class="boxart-image boxart-image-in-padded-container"
                                                                                                src="https://occ-0-1259-1567.1.nflxso.net/dnm/api/v6/X194eJsgWBDE2aQbaNdmCXGUP-Y/AAAABVA5lsKf-QJZni_MhTPdi7dBAajNxqMo3wVWp5wZYD618YXXISrb4GFFAtlwF9LqnfMfvpk1IUR9dsmp3G1gi0JocfA.webp?r=e27"
                                                                                                alt="">
                                                                                            <div class="fallback-text-container"
                                                                                                aria-hidden="true">
                                                                                                <p
                                                                                                    class="fallback-text"> {{ $item->titulo }}
                                                                                                    main
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="click-to-change-JAW-indicator">
                                                                                            <div
                                                                                                class="bob-jawbone-chevron">
                                                                                                <svg class="svg-icon svg-icon-chevron-down"
                                                                                                    focusable="true">
                                                                                                    <use filter=""
                                                                                                        xlink:href="#chevron-down">
                                                                                                    </use>
                                                                                                </svg></div>
                                                                                        </div>
                                                                                    </a></div>
                                                                                <div class="bob-container"><span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><span class="jawBoneContent"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="image-preloaders"><span class="jawbone-images"></span></div>
                    </div>
                    <div class="visually-hidden screenReaderMessage" role="alert" aria-live="assertive"></div>
                </div>
            </div>
        </div>
      </div>
</body>

</html>
@endsection