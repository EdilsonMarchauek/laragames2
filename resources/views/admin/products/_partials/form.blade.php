<div class="form-group">
     {{ Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::text('code', null, ['placeholder' => 'Código', 'class' => 'form-control']) }}
</div>
{{-- <div class="form-group">
    {{ Form::text('url', null, ['placeholder' => 'URL', 'class' => 'form-control']) }}
</div> --}}
<div class="form-group">
    {{-- null ou categoria 1, 2, 3 etc.. --}}
    {{ Form::select('category_id', $categories, null, ['placeholder' => 'Selecione', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::text('price', null, ['placeholder' => 'Preço', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::textarea('description', null, ['placeholder' => 'Descrição', 'rows' => 3, 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('Capa : ') }}
    {{ Form::file('photo', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('Fotos: ') }}
    {{ Form::file('image[]', ['multiple' => true]) }}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>