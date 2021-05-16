<?php include TEMPLATE . "/includes/header.tpl.php"; ?>

<div class="main_content_wrapper">

    <div class="gymlog_container">

        <div class="main_content">

            <div class='content'>
                <div class='' style='width:600px; margin: auto;'>
                    <form id="composition">
                        <h1>Beräkna kroppsfett procent</h1>
                        <div class='row'>
                            <div class="form-group col-12">
                                <label for="gender">Kön</label>
                                <select class="form-control" name='gender'>
                                    <option value='male'>Man</option>
                                    <option value='female'>Kvinna</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="height">Längd</label>
                                <input type="text" class="form-control" name='height' placeholder="Längd CM">
                            </div>
                            <div class="form-group col-12">
                                <label for="neck">Omkrets hals</label>
                                <input type="text" class="form-control" name='neck' placeholder="omkrets CM">
                            </div>
                            <div class="form-group col-12">
                                <label for="waist">Omkrets midja</label>
                                <input type="text" class="form-control" name='waist' placeholder="omkrets CM">
                            </div>
                            <div class="form-group col-12 hips_wrapper">
                                <label for="hips">Omkrets höfter</label>
                                <input type="text" class="form-control" name='hips' placeholder="omkrets CM">
                            </div>
                            <div class="form-group col-12">
                                <button type='submit' class='btn btn-primary'>Beräkna</button>
                            </div>
                        </div>

                        Standardavvikelse på ca 3 % kroppsfett
                    </form>

                    <div class='result' style='font-weight:bold;'></div>
                </div>
            </div>

        </div>

    </div>
</div>


<?php include TEMPLATE . "/includes/js.tpl.php"; ?>


<script>
    $('.hips_wrapper').slideUp(0);
    $('[name=gender]').on('change', function() {
        if ($(this).val() == 'male') {
            $('.hips_wrapper').slideUp(200);
        } else {
            $('.hips_wrapper').slideDown(200);
        }
    });


    $('#composition').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= SITE_URL ?>/composition/calculate',
            type: 'get',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                $('.result').html(data.fat_percentage + '% kroppsfett');
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });
</script>

<?php include TEMPLATE . "/includes/footer.tpl.php"; ?>