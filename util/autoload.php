<?php

// resolve a classe em models/ e, em seguida, em controllers/
spl_autoload_register(function ($classe) {
    $raiz = __DIR__ . '/..';
    foreach (["$raiz/models/$classe.php", "$raiz/controllers/$classe.php"] as $arquivo) {
        if (file_exists($arquivo)) {
            require $arquivo;
            return;
        }
    }
});
