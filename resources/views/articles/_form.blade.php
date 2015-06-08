<!-- Temporary -->

<?php
// Used to pass hidden variables
/*
{!! Form::hidden('user_id', 1) !!}
*/
?>

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body', 'Body') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Use an HTML 5 date picker -->
<div class="form-group">
    {!! Form::label('published_at', 'Published On') !!}
    {!! Form::input('date', 'published_at', $article->published_at->format('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!-- Multiple select box - the preselected mutli-select box is defined by the Articles model's tag_list function by Form-Model-Binding -->
<div class="form-group">
    {!! Form::label('tag_list', 'Tags') !!}
    {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
</div>


<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@include('errors.list')

@section('footer')

    <script>
        $(function()
        {
            $('#tag_list').select2( {
                placeholder: 'Choose a tag',
                tags: true, // Enable the user to add to the selection list,
                data:[
                    { id: 'one', text:'One' },
                    { id: 'two', text:'Two' },
                ],
            } );
        });
    </script>

@endsection
