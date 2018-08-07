@extends('master')

@section('content')

    <!-- Create code modal form component -->
    @include('components.create-code')

    <!-- Search form component -->
    @include('components.search-form')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Acronym</th>
                <th>Code</th>
                <th>Concatenated</th>
                <th>Language</th>		
                <th>Description</th>			
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="#">TARSAN</a></td>
                <td>00001</td>
                <td>TARSAN_00001</td>
                <td> es-ES</td>
                <td>El usuario no tiene permisos para ejecutar la operaci&oacuten.</td>
            </tr>
        </tbody>
    </table>
    
@stop
