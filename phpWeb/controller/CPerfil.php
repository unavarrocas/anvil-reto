<?php

class CPerfil
{
    private MPerfil $model;

    function __construct()
    {
        $this->model = new MPerfil();
    }

    function index()
    {
        $data = $this->model->index();
    }

    function show($id)
    {
        $data = $this->model->show($id);
    }

    function  create()
    {
    }

    function  store($id)
    {
        $nickname = $_POST["nickname"];
        $saldo = $_POST["saldo"];

        $this->model->store($id, $nickname, $saldo);

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

    function destroy($id)
    {
        $this->model->destroy($id);
    }
}
