
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
                    <select class="form-control input-sm" id="acronym">
                        <option> Any</option>
                        <option value="BAMOBI">BAMOBI</option>
                        <option value="MOEMCL">MOEMCL</option>
                        <option value="TOUCID">TOUCID</option>
                        <option>TRASAN</option>
                        <option>TARSAN</option>
                    </select>
                </div>
                <!-- Language - Todo: Get unique languages from database -->
                <div class="form-group">
                    <label for="language">Language</label>
                    <select class="form-control input-sm" id="language">
                        <option> Any</option>
                        <option> es-ES</option>
                        <option> ga-ES</option>
                        <option> ca-CA</option>
                        <option> en-US</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control input-sm" id="code" placeholder="0701201">
                </div>
            </form>
        </div>

        <div class="text-right form-filter">
            <button class="btn btn-primary" type="button" id="toggleCreateCode"><i class="fa fa-pencil" aria-hidden="true"></i> Create code</button>
        </div>
    </div>
</div>
