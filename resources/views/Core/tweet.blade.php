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
                <div class="col-xl-6">
                    <div class="text-center d-flex flex-column align-items-center">
                        <h1 class="mb-5">You can Tweet directly from here!</h1>
                        <form class="form-subscribe mb-8" id="search_user_by_id">
                            <div class="row">
                                <div class="col">
                                    <label for="formGroupExampleInput">Write something!</label>
                                    <input class="form-control form-control-lg" id="tweet_text" type="number"
                                           name="tweet_text"/>
                                </div>
                                <div class="col-auto" style="display: flex;align-items: end">
                                    <button class="btn btn-primary btn-lg" id="search_user_by_id_btn" type="submit">
                                        Tweet
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="search_ID_results" class="row">
                            <ul class="col-4 child"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</x-app-layout>
