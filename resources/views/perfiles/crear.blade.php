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
                                        class="logo icon-logoUpdate"
                                        href="/browse">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="profiles-gate-container">
                            <div class="centered-div"
                                style="opacity: 1; transform: scale(1); transition-duration: 450ms; transition-delay: 200ms;">
                                <div class="profile-actions-container">
                                
                                    <h1>Crear perfil</h1>

                                    <form method="POST" action="{{route('perfiles.store')}}">
                                    @csrf
                                        <div class="profile-metadata profile-entry">
                                            <div class="main-profile-avatar">
                                                <div class="avatar-box">
                                                    <img
                                                        src="https://occ-0-1259-1567.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABXzsLeXLYRgDrrvM99HCFtTGST5PVo50MVlNTlINCoCsHtph6L9OjNyqpd6tqydjEN-_HIR0nvgEnka3H0eKOroCi8WJ.png?r=318"
                                                        alt=""
                                                        style="opacity: 1; transform: scale(1); transition-duration: 400ms;">
                                                    <div class="avatar-edit-icon">
                                                    <svg class="svg-icon svg-icon-edit" focusable="true">
                                                        <use filter="" xlink:href="#edit"></use>
                                                    </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-edit-parent">
                                                <div class="profile-edit-inputs">
                                                    <input type="text" class=""
                                                        name="nombre"
                                                        placeholder="Nombre">
                                                </div>
                                                {{--Errores--}}
                                                @error('nombre') 
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    El nombre es obligatorio
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <span data-uia="profile-save-button" class="profile-button preferred-action">
                                            <input type="submit"
                                                
                                                value="GUARDAR">

                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>