<?php $errorClass = $errors->first('name') ? ['class' => 'validate invalid'] : []?>
<div class="row">
    <div class="input-field col s6">
        {!! Form::text('name',null,$errorClass) !!}
        {!! Form::label('name','Nome',['data-error' => $errors->first('name')]) !!}
    </div>

</div>

<div class="row">
    <div class="input-field file-field col s6">
        <div class="btn">
            <span>Logo</span>
            {!! Form::file('logo') !!}
        </div>
        <div class="file-path-wrapper">
            <input type="text" class="file-path"/>
        </div>
    </div>
</div>

<div class="row">
    {!! Form::submit('Salvar',['class' => 'btn waves-effect right']) !!}
</div>