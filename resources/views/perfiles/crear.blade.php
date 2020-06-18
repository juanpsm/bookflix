@extends('perfiles.header')

@section('content')
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
                            placeholder="Nombre"
                            value="{{old('nombre')}}">
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

            </span>
        </form>
    </div>
</div>
@endsection
