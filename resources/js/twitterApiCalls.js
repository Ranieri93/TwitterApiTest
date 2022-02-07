import axios from "axios";

window.axios = axios;

/**
 * CONSTANTS
 */

const btnSearchByID = document.getElementById('search_user_by_id_btn');
const searchIDResults = document.getElementById('search_ID_results');
const inputSearchByID = document.getElementById('tweet_ID');

const btnTweet = document.getElementById('create_tweet_ID');
const tweetResult = document.getElementById('search_tweet_results');
const textAreaTweet = document.getElementById('tweet_text');

const btnSearch = document.getElementById('search_btn');
const searchResults = document.getElementById('search_results');
const inputQueryString = document.getElementById('query_string');

/**
 * FUNCTION CALL SECTION
 */
if (btnSearchByID && searchIDResults) {
    searchById();
}

if (btnTweet && tweetResult) {
    showTweet();
}

if (btnSearch && searchResults) {
    search();
}


/**
 * FUNCTION SECTION
 */
function searchById() {
    const url = `${window.location.origin}/search_by_user_ID`;
    if (btnSearchByID) {
        btnSearchByID.addEventListener('click', e => {
            e.preventDefault();
            if (inputSearchByID.value === '') {
                searchIDResults.parentElement.querySelector('ul').remove();
                let ul = document.createElement('ul');
                ul.classList = 'list-group';
                ul.innerHTML = `<li class="list-group-item list-group-item-danger">You have to insert some value before searching!</li>`;
                searchIDResults.append(ul);
                return;
            }
            window.axios
                .post(url, {
                    _token: document.head.querySelector("meta[name='csrf-token']").content,
                    tweet_ID: document.getElementById('tweet_ID').value
                })
                .then(response => {
                    const data = response.data.data;
                    if (searchIDResults) {
                        searchIDResults.parentElement.querySelector('ul').remove();
                        let ul = document.createElement('ul');
                        ul.classList = 'list-group';
                        ul.innerHTML = data ? `<li class="list-group-item"><strong>Message text:</strong> ${data.text}</li>` : `<li class="list-group-item list-group-item-danger"><strong>Err :</strong> ${response.data.errors[0].detail}</li>`
                        searchIDResults.append(ul);
                    }
                    inputSearchByID.value = '';
                })
                .catch(err => {
                    console.dir(err)
                    console.log(err)
                    inputSearchByID.value = '';
                })
        })
    }
}

function showTweet() {
    const url = `${window.location.origin}/tweet_something`;

    if (btnTweet) {
        btnTweet.addEventListener('click', e => {
            e.preventDefault();
            if (textAreaTweet.value === '') {
                tweetResult.parentElement.querySelector('ul').remove();
                let ul = document.createElement('ul');
                ul.classList = 'list-group';
                ul.innerHTML = `<li class="list-group-item list-group-item-danger">You have to insert some value before searching!</li>`;
                tweetResult.append(ul);
                return;
            }
            window.axios
                .post(url, {
                    _token: document.head.querySelector("meta[name='csrf-token']").content,
                    tweet_text: document.getElementById('tweet_text').value
                })
                .then(response => {
                    const data = response.data.data;

                    if (tweetResult) {
                        tweetResult.parentElement.querySelector('ul').remove();
                        let ul = document.createElement('ul');
                        ul.classList = 'list-group';
                        ul.innerHTML = data ? `<div><h2>Here's your newly created Tweet!</h2></div> <br>
                        <li class="list-group-item"> <div><strong>Tweet text:</strong> ${data.text} </div>
                            <br> <div><strong>Tweet ID :</strong> ${data.id}</div>
                            <br> <div>Go check on <a target="_blank" href="https://twitter.com/home">Twitter Home</a> using your dev account!</div>
                            </li>` : `<li class="list-group-item list-group-item-danger">Err : ${response.data.errors[0].detail}</li>`
                        tweetResult.append(ul);
                        textAreaTweet.value = '';
                    }
                })
                .catch(err => {
                    console.dir(err)
                    console.log(err)
                    textAreaTweet.value = '';
                })
        })
    }
}

function search() {
    const url = `${window.location.origin}/search`;

    if (btnSearch) {
        btnSearch.addEventListener('click', e => {
            e.preventDefault();
            if (inputQueryString.value === '') {
                searchResults.parentElement.querySelector('ul').remove();
                let ul = document.createElement('ul');
                ul.classList = 'list-group';
                ul.innerHTML = `<li class="list-group-item list-group-item-danger">You have to insert some value before searching!</li>`;
                searchResults.append(ul);
                return;
            }
            window.axios
                .post(url, {
                    _token: document.head.querySelector("meta[name='csrf-token']").content,
                    query_string: document.getElementById('query_string').value
                })
                .then(response => {
                    const data = response.data.data;
                    if (searchResults) {
                        searchResults.parentElement.querySelector('ul').remove();
                        let ul = document.createElement('ul');
                        ul.classList = 'list-group';
                        if (data) {
                            data.forEach(el => {
                                const date = new Date(el.created_at);
                                const tweetDate = `${date.getDate()}/${date.getMonth()}/${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;
                                let li = document.createElement('li');
                                li.classList = 'list-group-item d-flex flex-column align-items-start mb-4';
                                li.innerHTML =
                                    `<div><strong>Tweet Time:</strong> ${tweetDate} </div> <br> <div><strong>Tweet ID:</strong> ${el.id} </div> <br> <div><strong>Tweet author ID :</strong> ${el.author_id}</div> <br>
                                <div><strong>Language :</strong> ${el.lang} </div> <br> <div><strong>Text :</strong> ${el.text}</div>`;
                                ul.append(li);
                            })
                            inputQueryString.value = '';
                        } else {
                            let li = document.createElement('li');
                            li.classList = 'list-group-item d-flex flex-column align-items-start mb-4';
                            li.innerHTML = `<div><strong class="text-danger">No Tweets find for this keyword! Try Again!</strong></div>`;
                            ul.append(li);
                            inputQueryString.value = '';
                        }
                        searchResults.append(ul);
                    }
                })
                .catch(err => {
                    console.dir(err)
                    console.log(err)
                })
        })
    }
}

