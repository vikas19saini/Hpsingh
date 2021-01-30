<?php ?>

<?php if(empty($this->request->getQuery('import-id'))):?>
<div class="main_user">
    <div class="user_section">
        <h2><b>Step 1:</b> Please choose file and upload.</h2>
        <p>Don't forget to upload images before you start import process. Maximum upload file size: <?= ini_get('upload_max_filesize')?></p>
    </div>
    <div class="import">
        <label for="file">Choose File</label>
        <?= $this->Form->create(null, ['type' => 'file']);?>
        <?= $this->Form->control('importFile', ['label' => false, 'type' => 'file', 'id' => 'file', 'style' => 'display: none', 'onchange' => "$('#selected_file').text($(this).val())", 'required'])?>
        <?= $this->Form->control('import', ['label' => false, 'options' => ['Products' => 'Products'], 'empty' => '-Select Type-', 'required'])?>
        <button>Upload</button>
        <?= $this->Form->end()?>
    </div>
    <h3 id="selected_file"></h3>
</div>
<?php endif;?>

<?php if(!empty($this->request->getQuery('import-id'))):?>
<div class="main_user">
    <div class="user_section">
        <h2><b>Step 2:</b> Start your import process.</h2>
    </div>
    <div class="import">
        <button class="rib" onclick="runImport()">Confirm & Run Import</button>
        <div class="progress-report">
            <h1 class="log">Total: <span><?= $totalRecords?></span>, Created: <span id="created">0</span>, Updated: <span id="updated">0</span>, Errors: <span id="errors">0</span></h1>

            <div class="progress-bar">
                <div class="seek"></div>
                <span></span>
            </div>
        </div>
        <div class="logs" style="margin-top: 50px;"></div>
    </div>
</div>
<script>
    var total = <?= $totalRecords?>;
    var import_id = <?= $this->request->getQuery('import-id')?>;
    var iteration = 0;
    var processed = 0;
    var create = 0;
    var errors = 0;
    var updated = 0;

    function runImport() {
        $(".progress-report").css('display', 'block');

        if (processed !== total) {
            $.ajax({
                url: HPADMIN + `import/run/${import_id}/${total}/${processed}`,
                type: 'GET',
                beforeSend: function (xhr) {
                }, success: function (response) {
                    if (response.status === 'success') {
                        iteration++;
                        processed += response.total;
                        create += response.success;
                        errors += response.error;
                        updated += response.updated;
                        $("#created").text(create);
                        $("#errors").text(errors);
                        $("#updated").text(updated);
                        var percent = ((processed / total) * 100);
                        $(".progress-bar .seek").css('width', percent + '%');
                        $(".progress-bar .seek").next('span').text(percent.toFixed(2) + '% Completed');

                        response.summary.forEach(function (log) {
                            $(".import").children('.logs').append(`<p>${log}</p>`);
                        });

                        runImport();
                    }
                }
            });
        }
    }

</script>
<?php endif;?>
