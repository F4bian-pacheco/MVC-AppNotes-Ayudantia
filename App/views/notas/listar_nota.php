<?php

if(!isset($_SESSION["user"]) && !$_SESSION["user"] == "admin"){
    header("Location: /app/auth");
}


$data = $controller->index();
// print_r($data);

$id = $titulo = $content = "";

if($_GET["url"] == "notes/editar"){
    $id = $dataView["data"][0]["ID"];
    $titulo = $dataView["data"][0]["TITLE"];
    $content = $dataView["data"][0]["CONTENT"];
}

?>


<div class="row">
    <?php if(isset($dataView["data"]["mensaje"])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $dataView["data"]["mensaje"]?>
        </div>
    <?php endif; ?>

    <div class="col-md-4 p-4">
        <div class="container">
            <form action="/app/notes/guardar" method="POST">
                <input type="hidden" name="id" value="<?=$id ?>">
                <div class="form-outline mb-4">
                    <label class="form-label" for="titleinput">Titulo</label>
                    <input type="text" name="title" value="<?=$titulo ?>" id="titleinput" class="form-control" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="contentinput">Contenido</label>
                    <textarea class="form-control" name="content" id="contentinput" rows="4"> <?=$content ?></textarea>
                </div>

                <button type="submit" name="submit_note" class="btn btn-primary mb-4">Guardar</button>
            </form>
        </div>
    </div>

    <div class="col-md-8 p-4">
        <div class="row">
            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $note) : ?>
                    <div class="col-lg-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h2 class="card-title"><?= $note["TITLE"]  ?> </h2>
                                <?php if($_SESSION["user"] == "admin"): ?>
                                    <h5>Usuario: <?= $note["USERNAME"] ?></h5>
                                <?php endif; ?>
                                <p class="card-text"><?= $note["CONTENT"] ?></p>
                                <a href="/app/notes/editar?id=<?=$note["ID"]?>" class="btn btn-primary">Editar</a>
                                <a href="/app/notes/borrar?id=<?=$note["ID"]?>" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>


            <?php endif; ?>
        </div>
    </div>
</div>