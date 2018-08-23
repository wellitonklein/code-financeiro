<?php $errorClass = $errors->first('name') ? ['class' => 'validate invalid'] : []?>
<div class="row">
    <div class="input-field col s6">
        {!! Form::text('name',null,$errorClass) !!}
        {!! Form::label('name','Nome',['data-error' => $errors->first('name')]) !!}
    </div>

</div>

<div class="row">
    <div class="input-field file-field col s6">
        <div class="file-path-wrapper col s9">
            <input type="text" class="file-path"/>
        </div>
        <div class="btn col s3">
            <span>Logo</span>
            {!! Form::file('logo') !!}
        </div>
    </div>
</div>

<div class="row">
    {!! Form::submit('Salvar',['class' => 'btn waves-effect right']) !!}
</div>