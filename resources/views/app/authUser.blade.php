@include('app.templates.header')
<div id="main-container" class="container-fluid">
    <div class="col-m-12">
        <div class="row" id="auth-row">
            <div class="col-md-4" id="login-container">
                <h2>Entrar</h2>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="login">
                    <div class="form-group mb-3">
                        <label for="email" class="mb-2">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="mb-2">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
                    </div>
                    <input type="submit" class="btn card-btn" value="Entrar">
                </form>
            </div>
            <div class="col-md-4" id="register-container">
                <h2>Criar Conta</h2>
                <form action="{{route('authcreate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="register">
                    <div class="form-group mb-3">
                        <label for="email" class="mb-2">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="mb-2">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastname" class="mb-2">Sobrenome:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu sobre nome">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="mb-2">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirmpassword" class="mb-2">Confirmação de senha:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha">
                    </div>
                    <input type="submit" class="btn card-btn" value="Registrar">
                </form>
            </div>
        </div>
    </div>
</div>
@include('app.templates.footer')