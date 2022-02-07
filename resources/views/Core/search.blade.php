<x-app-layout>
    <nav class="navbar navbar-light bg-dark mb-8">
        <div class="container">
            <span class="navbar-brand mb-0 h1 text-white">Navbar</span>
            <button class="btn btn-info"><a href="{{route('home')}}" style="color: unset">BACK</a></button>
        </div>
    </nav>
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="text-center d-flex flex-column align-items-center">
                        <h1 class="mb-5">Search recent tweets using a keyword!</h1>

                        <form class="form-subscribe mb-8" id="search">
                            <div class="row">
                                <div class="col">
                                    <label for="query_string">Insert a query string</label>
                                    <input class="form-control form-control-lg" id="query_string" type="text"
                                           name="query_string" required/>
                                    @if($errors!== null && $errors->has('query_string') && count($errors->get('query_string')) > 0)
                                        <span class="invalid-feedback" role="alert">
                                            @foreach($errors->get('query_string') as $message)
                                                <strong>{{ $message }}</strong>
                                            @endforeach
                                        </span>
                                    @endif
                                </div>
                                <div class="col-auto" style="display: flex;align-items: end">
                                    <button class="btn btn-primary btn-lg" id="search_btn" type="submit">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="search_results" class="row">
                            <ul class="col-4 child"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</x-app-layout>
