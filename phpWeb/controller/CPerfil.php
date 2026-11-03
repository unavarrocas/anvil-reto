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
        /* require __DIR__ . "/../view/VEscudoIndex.php"; */
    }

    function show($id)
    {
        $data = $this->model->show($id);
        /* require __DIR__ . "/../view/VEscudoShow.php"; */
    }

    function  create()
    {
        /* require __DIR__ . "/../view/VEscudoCreate.php"; */
    }

    function  store($id)
    {
        $nickname = $_POST["nickname"];
        $saldo = $_POST["saldo"];

        $this->model->store($id, $nickname, $saldo);

        /* header("Location: index.php?entity=escudo"); */
    }

    function  edit($id)
    {
        $data = $this->model->show($id);
        /* require __DIR__ . "/../view/VEscudoEdit.php"; */
    }

    function  update($id)
    {
        $nickname = $_POST["nickname"];
        $saldo = $_POST["saldo"];

        $this->model->update($nickname, $saldo, $id);

        /* header("Location: index.php"); */
    }

    function destroy($id)
    {
        $this->model->destroy($id);

        /* header("Location: index.php?entity=escudo"); */
    }
}
