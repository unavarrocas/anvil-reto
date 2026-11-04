<?php
class CLogin {
    private MLogin $model;

    function __construct()
    {
        $this->model = new MLogin();
    }

    function index(){}
    function login(){}
    function logout(){}
}
