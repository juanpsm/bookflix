@extends('perfiles.header')

@section('content')
<div class="centered-div"
    style="opacity: 1; transform: scale(1); transition-duration: 450ms; transition-delay: 200ms;">
    <div class="profile-actions-container">

        <h1>Editar perfil</h1>
        
        <form method="POST" action="{{route('perfiles.update', $perfil->id)}}">
            @method('PUT') {{--HTML no permite el PUT, lo paso por adentro--}}
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
                                placeholder="Nombre" 
                                value={{$perfil->nombre}}>
                    </div>
                    {{--Errores--}}
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                    @endif
                </div>
            </div>

            <span data-uia="profile-save-button" class="profile-button preferred-action">
                <input type="submit"
                        style="color: #E50914;
                        background-color: #00000000;
                        border: 2px solid #E50914;
                        padding: 6px;"
                        
                        value="GUARDAR">
                {{-- <span>
                    GUARDAR
                </span> --}}
            </span>

            <span data-uia="profile-button" class="profile-button">
                <a aria-label="Cancel"
                    href="{{route('seleccionar_perfil')}}">
                    CANCELAR
                </a>
            </span>

            {{-- <span data-uia="profile-delete-button" class="profile-button">
                <span>
                ELIMINAR PERFIL
                </span>
            </span> --}}
        </form>
        <form action="{{route('perfiles.destroy', $perfil)}}" class="d-inline" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" 
                    style="color: #777777d3;
                    background-color: #00000000;
                    border: 1px solid #777777d3;
                    padding: 3px;">
                ELIMINAR PERFIL
            </button>
        </form>
    </div>
</div>
@endsection