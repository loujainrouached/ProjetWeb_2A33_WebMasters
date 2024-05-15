<?php
function censorComment($comment, $censoredWords) {
    foreach ($censoredWords as $word) {
        $replacement = str_repeat('*', strlen($word));
        $comment = str_ireplace($word, $replacement, $comment);
    }
    return $comment;
}
