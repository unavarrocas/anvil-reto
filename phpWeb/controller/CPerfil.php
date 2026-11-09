<?php

class CPerfil
{
    private MPerfil $model;

    function __construct()
    {
        $this->model = new MPerfil();
    }

    function show($id)
    {
        $data = $this->model->show($id);
    }

    function  edit($id)
    {
        $data = $this->model->show($id);
    }

    function  update($id)
    {
        $nickname = $_POST["nickname"];
        $saldo = $_POST["saldo"];

        $this->model->update($nickname, $saldo, $id);
    }

}
