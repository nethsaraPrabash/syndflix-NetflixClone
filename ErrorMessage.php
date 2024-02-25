<?php

    class ErrorMessage {
        public static function show($message) {
            exit("<span class='errorBanner'>$message</span>");
        }
    }
?>