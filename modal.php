<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Faça login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST">
        <div class="form-group">
            <label for="loginEmail">Email</label>
            <input type="email" name="loginEmail" class="form-control" id="loginEmail" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="loginSenha">Senha</label>
            <input type="password" name="loginSenha" class="form-control" id="loginSenha">
        </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="fazerLogin" class="btn btn-outline-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>