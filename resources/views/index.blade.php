@extends('layout')
@section('title')
    Link Shortener
@endsection
@section('main_content')

    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <h4 class="mb-3">New short URL</h4>
                            <div class="input-group">
                                <input value="{{session()->get('success')}}" name="url" id="url" type="text"
                                       class="form-control">
                                <button onclick="copyLink()" type="button" class="btn btn-secondary">Copy</button>
                            </div>
                    @else
                        <h4 class="mb-3">Post your URL</h4>
                        <form method="post" action="{{route('links.send')}}">
                            <div class="input-group">
                                @csrf
                                <input name="url" id="url" type="text" class="form-control" placeholder="https://www.google.com/">
                                <button type="submit" class="btn btn-secondary">Convert</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </main>

    <footer class="text-muted py-4 navbar fixed-bottom bg-light">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Back to top</a>
                </p>
                <p class="mb-1">Your advertisement could be here!</p>
            </div>
    </footer>

    <script>
        function copyLink() {
            var copyText = document.getElementById("url");
            copyText.select();
            document.execCommand("copy");
        }
    </script>
@endsection
