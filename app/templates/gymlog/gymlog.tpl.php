<?php include TEMPLATE . "/includes/header.tpl.php"; ?>

<div class="main_content_wrapper">

    <div class="gymlog_container">      

        <?php // include __DIR__ . "/includes/subnav.tpl.php"; ?>

        <div class="main_content"> 
                  
            <div class='content'>
                <div class=''></div>
                <div class=''></div>
                <div class='active_programs'>
                    <?=$current_nav?>

                </div>    


                <?php print_r($user->fullname());?>

            </div>
 
            <?php if (isset($programs) && !empty($programs)) { ?>
                <!-- Created and subscribed programs -->
                <div class='subscribed_programs'>
                    <?php foreach ($programs as $program) { ?>
                        <a href='<?= SITE_URL ?>/gymlog/active-program'><?= $program['name'] ?></a>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>

    </div>
</div>



<!-- Modals -->
<div class="modal fade" id="exerciseModal" tabindex="-1" role="dialog" aria-labelledby="exerciseModalTitle" aria-hidden="true">
    <form id="exerciseModalForm">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeReportsTitle">Lägg till Övning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="muscle_group"> Muskelgrupp </label>
                                <select class="form-control " id="muscle_group" name='muscle_group'>
                                    <?php foreach ($muscle_groups as $muscle_group) { ?>
                                        <option value='<?= $muscle_group['id'] ?>'>
                                            <?= $muscle_group['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="name">Övning </label>
                                <input class="form-control" type="text" id='name' name='name' placeholder="Namn">
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="name_en"> Övning på Engelska </label>
                                <input class="form-control" type="text" id='name_en' name='name_en' placeholder="Namn">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Stäng</button>
                    <button type="submit" class="btn btn-primary">Spara</button>
                </div>
            </div>
        </div>
    </form>
</div>



<?php include TEMPLATE . "/includes/js.tpl.php"; ?>


<script>
    /*
    $('.updateView').on('click', function(e) {
        e.preventDefault();
        var page = $(this).data('page'),
            main_content_dom = $('.main_content');

        $.ajax({
            url: '<?= SITE_URL ?>/gymlog/' + page +'?json',
            type: 'get', 
            dataType: "json",
            success: function(data) {
                console.log(data);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });


        if (page == 'programs') {

            main_content_dom.html("programs");
        }


    });
*/

    $(".addExercise").on('click', function(e) {
        e.preventDefault();
        $("#exerciseModal").modal('show');
    });
</script>

<?php include TEMPLATE . "/includes/footer.tpl.php"; ?>