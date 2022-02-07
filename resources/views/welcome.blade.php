<x-app-layout>
    <nav class="navbar navbar-light bg-dark mb-8">
        <div class="container">
            <span class="navbar-brand mb-0 h1 text-white">Navbar</span>
        </div>
    </nav>

    <section class="pt-4">
        <header class="py-5">
            <div class="container px-lg-5">
                <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                    <div class="m-4 m-lg-5">
                        <h1 class="display-5 fw-bold">HELLO! This is a dummy app linked to Twitter APIs, choose from the
                            actions above!</h1>
                    </div>
                </div>
            </div>
        </header>
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col-lg-4 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a href="{{route('search_by_ids')}}" style="color: unset">
                                <h2 class="fs-4 fw-bold">Get a Tweet by its ID</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a href="{{route('tweet')}}" style="color: unset">
                                <h2 class="fs-4 fw-bold">Tweet something!</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a href="{{route('search')}}" style="color: unset">
                                <h2 class="fs-4 fw-bold">Search a keyword in daily tweets</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
