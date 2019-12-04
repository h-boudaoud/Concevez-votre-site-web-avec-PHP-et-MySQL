<form action="bddchat.php" method="post" enctype="multipart/form-data">

    <div class="col">
        <labela>Pseudo :</labela>
        <br/>
<!-- pour tester       -->
<!--        <input-->
<!--                type="text"-->
<!--                name="pseudo"-->
<!--                value="--><?php //echo $pseudo; ?><!--"-->
<!--                placeholder="pseudo"-->
<!--                title="Le pseudo doit contenire entre 6 et 50 caractère.-->
<!--Seuls les lettres sans accent, les chiffres et les symboles '-' et '_' sont accéptés"-->
<!--        />-->
        <!--    pour le deploiment      -->
                <input
                        type="text"
                        name="pseudo"
                        placeholder="pseudo"
                        title ="Le pseudo doit contenire entre 6 et 50 caractère.
        Seuls les lettres sans accent, les chiffres et les symboles '-' et '_' sont accéptés"
                        value="<?php echo $pseudo; ?>"
                        maxlength="50"
                        pattern="[A-Za-z0-9_\-]+"
                        minlength="6"
                        maxlength="50"
                        required
                />

    </div>
    <div class="col">
        <labela>message :</labela>
        <br/>
<!--   pour tester        -->
<!--        <textarea id="story" name="msg" rows="1" cols="50">--><?php //echo "$msg"; ?><!--</textarea>-->
<!--    pour le deploiment      -->
        <textarea
                id="story"
                name="msg"
                rows="1"
                cols="30"
                required>
            <?php echo "$msg"; ?>
        </textarea>
<!--        -->
    </div>
    <div class="col">
        <div style="margin-bottom: 2rem"></div>
        <input type="submit" value="Valider">
    </div>
</form>