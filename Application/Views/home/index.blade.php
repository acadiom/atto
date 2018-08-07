@extends('master')

@section('content')

    <!-- Create code modal form component -->
    @include('components.create-code')

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
            @forelse($i18nCodes['codeList'] as $i18nCode)
            <tr>
                <td class="visible-sm visible-md visible-lg"><a href="#">{{ $i18nCode->acronym }}</a></td>
                <td class="visible-sm visible-md visible-lg">{{ $i18nCode->code }}</td>
                <td>{{ $i18nCode->acronym_code }}</td>
                <td class="visible-sm visible-md visible-lg">{{ $i18nCode->language }}</td>
                <td>{{ $i18nCode->message }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">There are no codes matching your search criteria.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

@stop
