const books = document.querySelector('.books')

function displayChars(data) {
    data.forEach(livre => {
            let book = document.createElement('div')
            book.className = 'book'
            book.innerHTML = `<h2 class='name'>${livre.volumeInfo.title}</h2>
                            <img src='${livre.volumeInfo.imageLinks.smallThumbnail}' class='image'></img>
                            <h2 class='name'>${livre.volumeInfo.pageCount}</h2>`
                            
            books.appendChild(book)
    }) 
}

async function getChars() {
    try {
            const response = await axios.get(`https://www.googleapis.com/books/v1/volumes?q=intitle:dame&langRestrict=fr&limit=100`)
            const data = await response.data.items
             console.log(data.items)
            displayChars(data)
    }
    catch (err) {
        console.log(err)
    }
}


class App {
    init() {
        const submit = document.querySelector('.submit')
        const btnList = document.querySelector('.btn-list')
        const input = document.querySelector('input')

        submit.addEventListener('click', () => {
            API.searchMovie(input.value)
        })

        btnList.addEventListener('click', () => {
            App.displayResults(MyList.myList)
        })        
    }
    static displayResults(movies) {
        const ul = document.querySelector('ul')
        ul.innerHTML = ''
    
        movies.map(movie => {
            const newMovie = new Movie(movie, ul)
            newMovie.render()
        })
    } 
}



getChars()