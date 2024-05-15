<?php



function censorReclamation($reclamation, $censoredWords) {
    foreach ($censoredWords as $word) {
        $replacement = str_repeat('*', strlen($word));
        $reclamation = str_ireplace($word, $replacement, $reclamation);
    }
    return $reclamation;
}