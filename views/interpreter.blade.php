
        <h1>Symfony command:</h1>

        <hr/>

            {!! Form::open([ 'url' => 'blog/admin/run' ])  !!}
            {!! Form::label('command', 'Command: ') !!}
            {!! Form::text('command', null, ['class' => 'form-control']) !!}
        <br/>
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}

            {!! Form::close()  !!}
