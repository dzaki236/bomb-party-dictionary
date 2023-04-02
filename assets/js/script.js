let search = document.getElementById('search');
let search_addon = document.getElementById('search-addon');
let card_container = document.getElementById('card_dictionary');
var [middle, inner, outter] = ['', '', ''];
const url = 'http://localhost/bombparty-dictionary/api/dictionary';
document.getElementById('card').style.display = "none"
search.addEventListener("keyup", function (e) {

    // load(null, url)
    load(search.value,url)
    if (search.value == '') {
        document.getElementById('card').style.display = "none"
    } else {
        document.getElementById('card').style.display = "block"
    }
});

function load(keyword, url) {
    axios.post(url, {
        api_key: '202cb962ac59075b964b07152d234b70',
        keywords: keyword
    })
        .then(function (response) {
            console.log(response);
            card_container.innerHTML = response.data.data.map(result => `<h4 class="mb-4">${result.word.toLowerCase()}</h4>`)
                .join("");
            if (response.data.total <= 0) {
                card_container.innerHTML = '';
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}