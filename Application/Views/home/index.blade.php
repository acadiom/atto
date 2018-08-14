@extends('master')

@section('content')

    <!-- Create code modal form component -->
    @include('components.create-code')

    <!-- Create error message component -->
    @include('components.error-message')

    <!-- Create success message component -->
    @include('components.success-message')    

    <!-- Search form component -->
    @include('components.search-form')

    <table id="table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="visible-sm visible-md visible-lg">Acronym</th>
                <th class="visible-sm visible-md visible-lg">Code</th>
                <th>Concatenated</th>
                <th class="visible-sm visible-md visible-lg">Language</th>		
                <th>Description</th>			
            </tr>
        </thead>
        <tbody id="table-body">
            <tr>
                <td colspan="5">There are no codes matching your search criteria.</td>
            </tr>
        </tbody>
    </table>

@stop
