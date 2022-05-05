@csrf
<div class="form-group">
    <input type="text" value="{{ $user->name ?? old('name') }}" name="name" class="form-control" placeholder="Nome">
</div>
<div class="form-group">
    <input type="text" value="{{ $user->email ?? old('email') }}" name="email" class="form-control" placeholder="E-mail">
</div>
<div class="form-group">
    <input type="password" value="{{ old('password') }}" name="password" class="form-control" placeholder="Senha">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>