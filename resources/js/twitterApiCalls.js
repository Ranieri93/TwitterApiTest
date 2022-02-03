import axios from "axios";

window.axios = axios;
/**
 * FUNCTION CALL SECTION
 */
searchById();


/**
 * FUNCTION SECTION
 */
function searchById() {
    const url = `${window.location.origin}/search_by_user_ID`;
    const btnSearchByID = document.getElementById('search_user_by_id_btn');
    const searchIDResults = document.getElementById('search_ID_results');

    btnSearchByID.addEventListener('click', e => {
        e.preventDefault();
        window.axios
            .post(url, {
                _token: document.head.querySelector("meta[name='csrf-token']").content,
                tweet_ID: document.getElementById('tweet_ID').value
            })
            .then(response => {
                const data = response.data.data;
                if (searchIDResults) {
                    console.log(searchIDResults.parentElement)
                    console.log(searchIDResults.parentElement.querySelector('ul'))
                    searchIDResults.parentElement.querySelector('ul').remove();
                    let ul = document.createElement('ul');
                    ul.classList = 'list-group';
                    ul.innerHTML = data ? `<li class="list-group-item">Testo del messaggio: ${data.text}</li>` : `<li class="list-group-item list-group-item-danger">Errore : ${response.data.errors[0].detail}</li>`
                    searchIDResults.append(ul);
                }
            })
            .catch(err => {
                console.dir(err)
                console.log(err)
            })
    })
}

