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
                <div class="col-xl-12">
                    <div class="text-center d-flex flex-column align-items-center">
                        <h1 class="mb-5">Write something to create a tweet</h1>
                        <form class="form-subscribe mb-8 col-6" id="create_tweet">
                            <div class="row">
                                <div class="col">
                                    <label for="tweet_text">Write something!</label>
                                    <textarea class="form-control" id="tweet_text" rows="3"
                                              name="tweet_text"></textarea>
                                </div>
                            </div>
                            <div class="pt-4" style="display: flex;align-items: end">
                                <button class="btn btn-primary btn-lg" id="create_tweet_ID" type="submit">
                                    Tweet
                                </button>
                            </div>
                    </div>
                    </form>
                    <div id="search_tweet_results" class="row justify-content-center">
                        <ul class="col-4 child"></ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>
</x-app-layout>
