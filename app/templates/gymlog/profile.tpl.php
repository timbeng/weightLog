<?php include TEMPLATE . "/includes/header.tpl.php"; ?>

<div class="main_content_wrapper">

    <div class="gymlog_container">

        <div class="main_content">

            <div class='content'>
                <div class='profile'>
                    <h1><i class='fa fa-user'></i> <?= $user->fullname(); ?></h1>

                    <ul>
                        <li><?= $user->gender ?></li>
                        <li><?= $user->calculateAge() ?> år</li>
                        <li><?= $user->weight ?> kg</li>
                        <li><?= $user->height ?> cm</li>
                        <li><?= $user->fat_percentage ?> %</li>
                        <li><?= $user->username ?></li>
                        <li><?= $user->email ?></li>
                        <li><?= $user->phone ?></li>
                    </ul>
                    <button class='btn btn-primary updateUser'>Ändra</button>
                </div>
            </div>

        </div>

    </div>
</div>



<!-- Modals -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
    <form id="userModalForm">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeReportsTitle">Ändra <?= $user->fullname(); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Användarnamn </label>
                                <input class="form-control" type="text" name='username' value='<?= $user->username ?>' placeholder="Användarnamn">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="email">Kön </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name='gender' value="Man" id="male" <?php
                                                                                                                    if ($user->gender != 'Kvinna') {
                                                                                                                        echo " checked";
                                                                                                                    } ?>>
                                <label class="form-check-label" for="male">
                                    Man
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name='gender' value="Kvinna" id="female" <?php
                                                                                                                        if ($user->gender == 'Kvinna') {
                                                                                                                            echo " checked";
                                                                                                                        } ?>>
                                <label class="form-check-label" for="female">
                                    Kvinna
                                </label>
                            </div>
                        </div> 

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Förnamn </label>
                                <input class="form-control" type="text" name='firstname' value='<?= $user->firstname ?>' placeholder="Förnamn">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Efternamn </label>
                                <input class="form-control" type="text" name='lastname' value='<?= $user->lastname ?>' placeholder="Efternamn">
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 ">
                            <div class="form-group">
                                <label for="birth_date">Födelsedatum </label>
                                <input class="form-control" type="date" name='birth_date' value='<?= $user->birth_date ?>'>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">telefon </label>
                                <input class="form-control" type="text" name='phone' value='<?= $user->phone ?>' placeholder="telefon">
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="name">epost </label>
                                <input class="form-control" type="email" name='email' value='<?= $user->email ?>' placeholder="E-post">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Notering </label>
                                <textarea class="form-control" name='notes' placeholder="Notering"><?= $user->notes ?></textarea>
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
    $('.updateUser').on('click', function(e) {
        e.preventDefault();
        $('#userModal').modal('show');
        return;
    });


    $('#userModalForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= SITE_URL ?>/profile/<?= $user->id; ?>',
            type: 'put',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                window.location.reload();
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });
</script>

<?php include TEMPLATE . "/includes/footer.tpl.php"; ?>