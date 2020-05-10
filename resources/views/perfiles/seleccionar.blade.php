<!DOCTYPE html>
<html lang="es">

<head>
    <title>Bookflix</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" value="notranslate">
    <link type="text/css" rel="stylesheet"
        href="https://codex.nflxext.com/%5E3.0.0/truthBundle/webui/0.0.1-shakti-css-v405e4bb1/css/css/less%7Cpages%7CakiraClient.less/1/0FxN3twi9EKM/none/true/none">
</head>

<body>
    <div id="appMountPoint">
        <div class="netflix-sans-font-loaded">
            <div dir="ltr" class="">
                <div>
                    <div class="bd dark-background" lang="es-AR" data-uia="container-adult">
                        <div class="pinning-header on-profiles-gate">
                            <div class="pinning-header-container"
                                style="top: 0px; position: relative; background: transparent;">
                                <div class="main-header on-profiles-gate menu-navigation" role="navigation">
                                    <a aria-label="Netflix" 
                                        class="logo icon-logoUpdate active"
                                        href="/browse">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="profiles-gate-container">
                            <div class="centered-div list-profiles-container">
                                <div class="list-profiles">
                                    <div class="profile-gate-label">
                                        ¿Quién está leyendo ahora?
                                    </div>
                                    perfiles: {{$perfiles}}
                                    <ul class="choose-profile">
                                        @foreach ($perfiles as $item)
                                        <li class="profile">
                                            <div>
                                                <a class="profile-link" tabindex="0"
                                                    href="{{route('home')}}"
                                                    data-uia="action-select-profile+primary">
                                                    <div class="avatar-wrapper">
                                                        <div class="profile-icon"
                                                            style="background-image:url(https://occ-0-1259-1567.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABcajaPMIn6RTpZwlTX_yLKqTPZkVc7owkIoRDi-qM76YH-6SyMzI5Cf87b_JdcOGck3lqEEZITIFXklDFrCpkD44SF78.png?r=f80)">
                                                        </div>
                                                    </div>
                                                    <span class="profile-name">
                                                        {{$item->nombre}}
                                                    </span>
                                                </a>
                                                <div class="profile-children"></div>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                                <span data-uia="profile-button" class="profile-button">
                                    <a aria-label="Administrar perfiles"
                                        href="{{route('perfiles.index')}}">
                                        ADMINISTRAR PERFILES
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
