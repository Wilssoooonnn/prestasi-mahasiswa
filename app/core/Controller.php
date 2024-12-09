<?php
class Controller
{
    public function view($view, $data = [])
    {
        // Cek apakah $view adalah path dengan folder yang benar
        $viewPath =  '../app/views/' . $view . '.php';

        // echo "<pre>";
        // var_dump($viewPath);
        // var_dump($view);
        // echo "</pre>";

        if ($viewPath) {
            require_once '../app/views/' . $view . '.php';
            // var_dump($view);
        } else {
            // Debugging untuk memastikan path yang dibentuk
            die("View tidak ditemukan: " . $viewPath);
        }
    }
}
