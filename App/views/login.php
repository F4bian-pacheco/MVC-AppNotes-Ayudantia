<div>
    <h1>Inicio de sesión</h1>
    <?php if(isset($_GET["error"]) && $_GET["error"]): ?>
        <div class="alert alert-danger" role="alert">
            Usuario o contraseña incorrectos
        </div>
    <?php endif; ?>
    <form action="auth/login" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label
            ">UserName</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>