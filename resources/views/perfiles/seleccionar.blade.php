@extends('perfiles.header')

@section('content')
<div class="centered-div list-profiles-container">
    <div class="list-profiles">
        <div class="profile-gate-label">
            ¿Quién está leyendo ahora?
        </div>
        {{--perfiles: {{$perfiles}} --}}
        <ul class="choose-profile">
            @foreach ($perfiles as $item)
            <li class="profile">
                <div>
                    <a class="profile-link" tabindex="0"
                        href="{{ route('perfiles.setProfile', $item) }}"
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
            </li>
            @endforeach
            @if( (Auth::user()->es_premium && count($perfiles)<4) || (!(Auth::user()->es_premium) && count($perfiles)<2))
            <li class="profile">
                <div>
                    <a class="profile-link" tabindex="0"
                        href="{{route('perfiles.create')}}"
                        data-uia="action-select-profile+primary">
                        <div class="avatar-wrapper">
                            
                            <div class="profile-icon"style="background-image:url('image/plus.png')">

                            </div>
                        </div>
                        <span class="profile-name">
                            Agregar Perfil
                        </span>
                    </a>
                    <div class="profile-children"></div>
                </div>
            </li>
            @endif
        </ul>
    </div>
    {{--Exito--}}
    @if ( session('mensaje') )
        <div class="profile-name"
            style="color: #E50914;
            font-size= 23px;
            background-color: #00000000;
            padding: 6px;">
            {{session('mensaje')}}
        </div>
    @endif
    <span data-uia="profile-button" class="profile-button">
        <a aria-label="Administrar perfiles"
            href="{{route('administar_perfil')}}">
            ADMINISTRAR PERFILES
        </a>
    </span>
</div>
@endsection