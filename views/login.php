<div class="container text-center">
  <main class="form-signin w-100 m-auto">
    <form action="index.php?action=login_validate" method="POST">
      <img class="mb-4" src="https://www.sic.gov.co/sites/default/files/images/2021/logo-sic-footer.png" alt="" height="57">
      <h1 class="h3 mb-3 fw-normal">Please Ingresa tus datos</h1>

      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required="">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required="">
        <label for="floatingPassword">Password</label>
      </div>
      <div class="checkbox mb-3">
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
      <p class="mt-5 mb-3 text-muted">© <?= date('Y') ?></p>
    </form>
  </main>
</div>