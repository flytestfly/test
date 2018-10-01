@extends('layout')

@section('content')
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($tests as $test)
                <article class="post">
                    <div class="post-thumb">
                        <a href="{{route('test.blog', $test->slug)}}"><img src="{{$test->getImage()}}" alt=""></a>

                        <a href="{{route('test.blog', $test->slug)}}" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">Пройти тест</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            @if($test->hasEvent())
                            <h6><a href="{{route('event.blog', $test->event->slug)}}"> {{$test->getEventTitle()}}</a></h6>
                            @endif
                            <h1 class="entry-title"><a href="{{route('test.blog', $test->slug)}}">{{$test->title}}</a></h1>


                        </header>
                        <div class="entry-content">
                            <p>
                                {!!$test->description!!}
                            </p>

                            <div class="btn-continue-reading text-center text-uppercase">
                                <a href="{{route('test.blog', $test->slug)}}" class="more-link">Пройти тест</a>
                            </div>
                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">Автор <a href="#">Дорошенко М.В.</a> {{$test->getDate()}}</span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                @endforeach

                {{$tests->links()}}
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection