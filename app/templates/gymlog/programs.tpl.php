<?php include TEMPLATE . "/includes/header.tpl.php"; ?>


<div class="main_content_wrapper">

    <div class="gymlog_container">

        <?php include __DIR__ . "/includes/subnav.tpl.php"; ?>

        <div class="main_content">
            <h1>Gör ett program</h1>

            <div class='content'>

                <div class='program_container_wrapper'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Programnamn</label>
                        <input type='text' name='name' class="form-control">
                        <small id="name" class="form-text text-muted"> Programmets namn</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Beskrivning av programmet</label>
                        <textarea name='description' class="form-control"></textarea>
                    </div>


                    <div class="form-group">
                        <button class='btn btn-info pull-right' type='submit'>Spara</button>
                    </div>



                    <!-- <div class='program_container'>
                            <div class='session'>
                                <div class='exercise'>
                                    Bänkpress
                                    <a href='' class='btn'><i class='fa fa-edit'></i></a>
                                    <a href='' class='btn'><i class='fa fa-trash'></i></a>
                                </div>
                            </div>

                        </div>

                        <button class='btn btn-info'><i class='fa fa-plus'></i> Lägg till en övning</button>
                        <button class='btn btn-info'><i class='fa fa-plus'></i> Lägg till session</button> -->

                </div>
            </div>

    
        </div>

        <div class="sidebar">
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
    $('.updateView').on('click', function(e) {
        e.preventDefault();
        var page = $(this).data('page');

        $('.dynamic_content').html(page);
    });

    $(".addExercise").on('click', function(e) {
        e.preventDefault();
        $("#exerciseModal").modal('show');
    });
</script>

<?php include TEMPLATE . "/includes/footer.tpl.php"; ?>