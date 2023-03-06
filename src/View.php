<?php

    namespace src;
    class View
    {
        function generate($template_view, $data = null)
        {
            if (is_array($data)) {
                extract($data);
            }
            $head = '<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"></head><body><div class="container">';
            $footer = '</div><body></html>';
            echo $head;
            include 'view/' . $template_view;
            echo $footer;

        }
    }