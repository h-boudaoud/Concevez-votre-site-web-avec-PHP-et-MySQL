<!--<br />-->
<!--*****  miniChatView.php-->
<ul>
    <?php

    if (count(getList()) > 0):?>
        <?php
        foreach (getList() as $donnees): ?>
            <li>
                <div class="pseudo">

                    [
                    <span style='font-size:70%;color:red;'>
                                    <?php echo date_format(date_create($donnees['date']), 'd/m/Y H:i:s'); ?>
                                </span>
                    ]

                    <b> <?php echo $donnees['pseudo']; ?> </b> :
                </div>
                <div class="msg" style="background:<?php  echo ($pseudo == $donnees['pseudo'])?'rgba(0,0,155,.2)':'rgba(0,100,55,.2)'; ?>">
                    <?php echo $donnees['msg']; ?>
                </div>
            </li>
        <?php endforeach;endif; ?>
</ul>