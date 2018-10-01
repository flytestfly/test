@extends('layout')

@section('content')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                	@foreach($tests as $test)
                    <div class="col-md-6">
                        <article class="post post-grid">
                            <div class="post-thumb">
                                <a href="{{route('test.blog', $test->slug)}}"><img src="{{$test->getImage()}}" alt=""></a>

                                <a href="{{route('test.blog', $test->slug)}}" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                            <div class="post-content">
                                <header class="entry-header text-center text-uppercase">
                                    <h6><a href="{{route('event.blog', $test->event->slug)}}"> {{$test->getEventTitle()}}</a></h6>

                                    <h1 class="entry-title"><a href="{{route('test.blog', $test->slug)}}">{{$test->title}}</a></h1>


                                </header>
                                <div class="entry-content">
                                    <p>
                                    	{!! $test->description !!}
                                    </p>

                                    <div class="social-share">
                                        <span class="social-share-title pull-left text-capitalize">By Rubel On February {{ $test->getDate() }}</span>
                                    </div>
                                </div>
                            </div>

                        </article>
                    </div>
                    @endforeach
                </div>
                {{ $tests->links() }}
            </div>
			@include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection