@extends('perfiles.header')

@section('content')
    <div class="centered-div list-profiles-container">
        <div class="list-profiles">
            <div class="profile-gate-label">
                Administrar perfiles:
            </div>
            <ul class="choose-profile">
                @foreach ($perfiles as $item)
                <li class="profile">
                    <div>
                        <a class="profile-link" tabindex="0"
                        href="{{ route('perfiles.edit', $item) }}"
                        data-uia="action-select-profile+primary">
                            <div class="avatar-wrapper">
                                <div class="profile-icon profile-edit-mode"
                                    style="background-image:url(https://occ-0-1259-1567.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABcajaPMIn6RTpZwlTX_yLKqTPZkVc7owkIoRDi-qM76YH-6SyMzI5Cf87b_JdcOGck3lqEEZITIFXklDFrCpkD44SF78.png?r=f80)">
                                </div>
                                <div class="svg-edit-overlay"><svg class="svg-icon svg-icon-edit" focusable="true">
                                        <use filter="" xlink:href="#edit"></use>
                                    </svg>
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
        <span data-uia="profile-button" class="profile-button preferred-action">
            <a
                href="{{route('seleccionar_perfil')}}">
                LISTO
            </a>
        </span>
    </div>
@endsection