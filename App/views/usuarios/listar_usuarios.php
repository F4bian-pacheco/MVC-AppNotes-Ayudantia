
<?php 

$data = $controller->index();
// print_r($data);

// print_r($dataView["data"][0]);


$id = $username = $email = $pass = $idrol = "";

if ($_GET["url"] == "user/editar") {
    $id = $dataView["data"][0]["ID"];
    $username = $dataView["data"][0]["USERNAME"];
    $email = $dataView["data"][0]["EMAIL"];
    $pass = $dataView["data"][0]["PASSWORD"];
    $idrol = $dataView["data"][0]["IDROL"];
}

?>





<div class="row">
    <?php if (isset($dataView["data"]["mensaje"])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $dataView["data"]["mensaje"]; ?>
        </div>
        <?php header("Refresh:2, URL = /app/user"); ?>
    <?php endif; ?>
    <div class="col-md-4 p-4">
        <div class="container">
            <form action="/app/user/guardar" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <div class="form-outline mb-4">
                    <label class="form-label" for="titleinput">Username</label>
                    <input type="text" name="username" value="<?= $username ?>" id="titleinput" class="form-control" />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="titleinput">Email</label>
                    <input type="text" name="email" value="<?= $email ?>" id="titleinput" class="form-control" />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="titleinput">Password</label>
                    <input type="password" name="pass" value="<?= $pass ?>" id="titleinput" class="form-control" />
                </div>

                <select class="form-select"  name="rol">
                    <option value="1" <?= $idrol=="1"?'selected="selected"':'' ?> >Usuario</option>
                    <option value="2" <?= $idrol=="2"?'selected="selected"':'' ?> >Admin</option>
                </select>
                <br>

                <button type="submit" name="submit_user" class="btn btn-primary mb-4">Guardar</button>
            </form>
        </div>
    </div>

    <div class="col-md-8 p-4">


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $user) : ?>
                    <tr>
                        <th scope="row"><?= $user["ID"] ?></th>
                        <td><?= $user["USERNAME"] ?></td>
                        <td><?= $user["EMAIL"] ?></td>
                        <td><p style="max-width: 150px;" class="text-truncate"><?= $user["PASSWORD"] ?></p></td>
                        <td><?= $user["NOMBREROL"] ?></td>
                        <td>
                            <a href="/app/user/editar?id=<?= $user["ID"] ?>" class="btn btn-primary">Editar</a>
                            <a href="/app/user/eliminar?id=<?= $user["ID"] ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>