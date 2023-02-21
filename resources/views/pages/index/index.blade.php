<div>
    <div id="map"></div>
</div>

<!-- Modal Structure -->
<div id="modal-new_witel" class="modal">
    <div class="modal-content">
        <h4>STO Baru</h4>
        <p>Form input STO baru</p>
        <form class="row">
            <div class="input-field col s12 m6">
                <input id="sto-name" type="text" class="validate">
                <label for="sto-name">Nama</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="sto-abbr" type="text" class="validate">
                <label for="sto-abbr">Abbr</label>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="modal-close waves-effect waves-green btn-flat">Cancel</button>
        <button onclick="saveSTO()" class="waves-effect waves-green btn-flat green-text">Create</button>
    </div>
</div>


<!-- Modal Structure -->
<div id="modal-new_connection" class="modal">
    <div class="modal-content">
        <h4>Sambungan Baru</h4>
        <p>Form input sambungan baru</p>
        <p class="red-text right">Tidak ada validasi input <i class="material-icons right">warning</i></p>
        <form class="row">
            <div class="input-field col s12">
                <select id="new-sto-asal" onchange="enableTujuan(this)">
                    <option value="" disabled selected>Pilih STO</option>
                    <?php foreach ($data->locations as $key => $value): ?>
                    <option value="<?= $value->id ?>"><?= $value->name ?></option>
                    <?php endforeach;?>
                </select>
                <label for="form-select-2">Asal</label>
            </div>
            <div class="input-field col s12">
                <select id="new-sto-tujuan" disabled>
                    <option value="" disabled selected>Pilih STO</option>
                    <?php foreach ($data->locations as $key => $value): ?>
                    <option value="<?= $value->id ?>"><?= $value->name ?></option>
                    <?php endforeach;?>
                </select>
                <label for="form-select-2">Tujuan</label>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="modal-close waves-effect waves-green btn-flat">Cancel</button>
        <button onclick="saveConn()" class="waves-effect waves-green btn-flat green-text">Connect</button>
    </div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red modal-trigger" href="#modal-new_connection">
        <i class="large material-icons">link</i>
    </a>
</div>
