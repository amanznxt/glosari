@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Total Articles</div>
                                <div class="panel-body text-center">
                                    <h3>{{ $article_count }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Total Dictionaries</div>
                                <div class="panel-body text-center">
                                    <h3>{{ $dictionary_count }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Total Words</div>
                                <div class="panel-body text-center">
                                    <h3>{{ $word_count }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
