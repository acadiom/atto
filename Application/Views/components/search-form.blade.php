
<div class="panel panel-default">

    <div class="panel-heading">
        <h2 class="panel-title"><i class="fa fa-filter" aria-hidden="true"></i> Error codes filter</h2>
    </div>

    <div class="panel-body">
        <div class="form-filter pull-left">
            <form class="form-inline" role="form">
                <!-- Acronym - Todo: Get unique acronyms from database -->
                <div class="form-group">
                    <label for="acronym">Acronym</label>
                    <select class="form-control input-sm" id="search-acronym">
                        <option value=""> Any</option>
                        @foreach ($acronyms as $acronym)
                            <option value="{{ $acronym }}">{{ $acronym }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Language - Todo: Get unique languages from database -->
                <div class="form-group">
                    <label for="language">Language</label>
                    <select class="form-control input-sm" id="search-language">
                        <option> Any</option>
                        @foreach ($languages as $language)
                            <option value="{{ $language }}">{{ $language }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control input-sm" id="search-code" placeholder="0701201">
                </div>
            </form>
        </div>

        <div class="text-right form-filter">
            <button class="btn btn-primary" type="button" id="toggleCreateCode"><i class="fa fa-pencil" aria-hidden="true"></i> Create code</button>
        </div>
    </div>
</div>
